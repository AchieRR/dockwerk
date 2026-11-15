<?php

use App\Actions\TransitionServiceRequest;
use App\Enums\RequestStatus;
use App\Models\Company;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;

beforeEach(function () {
    $this->withoutVite();

    $this->company = Company::create(['name' => 'Noordkade']);
    $this->otherCompany = Company::create(['name' => 'IJsselhaven']);
    $this->door = $this->company->doors()->create(['name' => 'Laadpoort 3', 'code' => 'TEST-NK-03', 'location' => 'Sneek']);
    $this->otherDoor = $this->otherCompany->doors()->create(['name' => 'Sectiedeur 1', 'code' => 'TEST-IJ-01', 'location' => 'Bolsward']);
    $this->customer = User::factory()->create(['company_id' => $this->company->id]);
    $this->otherCustomer = User::factory()->create(['company_id' => $this->otherCompany->id]);
    $this->staff = User::factory()->create(['is_staff' => true]);
    $this->reportData = [
        'door_id' => $this->door->id,
        'title' => 'Laadpoort sluit niet',
        'description' => 'De poort opent opnieuw wanneer hij halverwege is.',
    ];
});

test('een bezoeker krijgt toegang tot het portaal via inloggen', function () {
    $this->get(route('portal.index'))->assertRedirect(route('login'));
    $this->post(route('login.store'), ['email' => $this->customer->email, 'password' => 'password'])
        ->assertRedirect(route('portal.index'));
    $this->assertAuthenticatedAs($this->customer);
    $this->post(route('logout'))->assertRedirect(route('home'));
    $this->assertGuest();
});

test('een klant meldt een storing met een eerste tijdlijngebeurtenis', function () {
    $this->actingAs($this->customer)->post(route('portal.store'), $this->reportData)
        ->assertRedirect();
    $report = ServiceRequest::sole();

    expect($report->status)->toBe(RequestStatus::Reported)
        ->and($report->reported_by)->toBe($this->customer->id)
        ->and($report->updates()->sole()->status)->toBe(RequestStatus::Reported);
    $this->get(route('portal.show', $report))->assertOk()->assertSee('Laadpoort sluit niet');
});

test('een ander bedrijf ziet de melding niet en kan de deur niet melden', function () {
    $report = ServiceRequest::create($this->reportData + ['reported_by' => $this->customer->id]);
    $this->actingAs($this->otherCustomer)->get(route('portal.index'))
        ->assertOk()->assertDontSee($report->title)->assertDontSee('Laadpoort 3');
    $this->get(route('portal.show', $report))->assertNotFound();
    $this->post(route('portal.store'), $this->reportData)->assertSessionHasErrors('door_id');
    $this->assertDatabaseCount('service_requests', 1);
    $this->get('/werkplaats/meldingen')->assertForbidden();
});

test('een te korte beschrijving levert geen melding op', function () {
    $this->actingAs($this->customer)->post(route('portal.store'), array_replace($this->reportData, ['description' => 'Kort']))
        ->assertSessionHasErrors('description');
    $this->assertDatabaseCount('service_requests', 0);
});

test('een medewerker plant een afspraak en rondt de melding met toelichting af', function () {
    $this->actingAs($this->customer)->post(route('portal.store'), $this->reportData);
    $report = ServiceRequest::sole();
    $transition = app(TransitionServiceRequest::class);
    $date = today()->addDay()->toDateString();

    $transition->schedule($report, $this->staff, $date);
    $transition->complete($report, $this->staff, 'De eindschakelaar is gecontroleerd.');
    $report->refresh();

    expect($report->scheduled_for->toDateString())->toBe($date)
        ->and($report->status)->toBe(RequestStatus::Completed)
        ->and($report->updates()->orderBy('id')->get()->pluck('status')->all())
        ->toBe([RequestStatus::Reported, RequestStatus::Scheduled, RequestStatus::Completed]);
    $this->get(route('portal.show', $report))->assertOk()->assertSee('De eindschakelaar is gecontroleerd.');
});

test('foute, dubbele en onbevoegde statusovergangen schrijven geen tijdlijnregels', function () {
    $report = ServiceRequest::create($this->reportData + ['reported_by' => $this->customer->id]);
    $transition = app(TransitionServiceRequest::class);
    $date = today()->addDay()->toDateString();

    expect(fn () => $transition->schedule($report, $this->customer, $date))->toThrow(AuthorizationException::class)
        ->and(fn () => $transition->complete($report, $this->staff, null))->toThrow(ValidationException::class)
        ->and(fn () => $transition->schedule($report, $this->staff, today()->subDay()->toDateString()))->toThrow(ValidationException::class);
    $transition->schedule($report, $this->staff, $date);

    expect(fn () => $transition->schedule($report, $this->staff, $date))->toThrow(ValidationException::class)
        ->and($report->updates()->count())->toBe(1);
});

test('opnieuw seeden voegt geen duplicaten toe', function () {
    config(['dockwerk.demo' => true]);
    $this->seed()->seed();

    expect(User::where('email', 'like', '%@dockwerk.test')->count())->toBe(3)
        ->and(ServiceRequest::count())->toBe(3);
});
