<?php

namespace Database\Seeders;

use App\Actions\TransitionServiceRequest;
use App\Enums\RequestStatus;
use App\Models\Company;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (! config('dockwerk.demo') || ! app()->environment(['local', 'testing'])) {
            return;
        }

        DB::transaction(function (): void {
            $north = Company::firstOrCreate(['name' => 'Noordkade Logistiek']);
            $south = Company::firstOrCreate(['name' => 'IJsselhaven Opslag']);
            $door = $north->doors()->firstOrCreate(['code' => 'NK-03'], ['name' => 'Laadpoort 3', 'location' => 'Magazijn · Sneek']);
            $secondDoor = $north->doors()->firstOrCreate(['code' => 'NK-05'], ['name' => 'Laadpoort 5', 'location' => 'Expeditie · Sneek']);
            $otherDoor = $south->doors()->firstOrCreate(['code' => 'IJ-01'], ['name' => 'Sectiedeur 1', 'location' => 'Hal A · Bolsward']);

            $customer = $this->demoUser('noordkade@dockwerk.test', 'Sam de Vries', $north);
            $otherCustomer = $this->demoUser('ijsselhaven@dockwerk.test', 'Robin Bakker', $south);
            $staff = $this->demoUser('werkplaats@dockwerk.test', 'Alex van Dijk', staff: true);

            $this->sample($customer, $door->id, 'Laadpoort 3 sluit niet', 'De deur stopt halverwege en gaat daarna automatisch weer omhoog.');
            $scheduled = $this->sample($customer, $secondDoor->id, 'Deur loopt zwaar', 'De laadpoort maakt tijdens het openen een schurend geluid.');
            if ($scheduled->wasRecentlyCreated) {
                app(TransitionServiceRequest::class)->schedule($scheduled, $staff, today()->addDays(3)->toDateString());
            }
            $this->sample($otherCustomer, $otherDoor->id, 'Bedieningsknop reageert traag', 'De sectiedeur gaat pas open nadat de knop meerdere keren is ingedrukt.');
        });
    }

    private function demoUser(string $email, string $name, ?Company $company = null, bool $staff = false): User
    {
        $user = User::firstOrNew(['email' => $email]);
        if (! $user->exists) {
            $user->forceFill(['name' => $name, 'password' => 'dockwerk-demo', 'company_id' => $company?->id, 'is_staff' => $staff])->save();
        }

        return $user;
    }

    private function sample(User $customer, int $doorId, string $title, string $description): ServiceRequest
    {
        $request = ServiceRequest::firstOrCreate(
            ['reported_by' => $customer->id, 'door_id' => $doorId, 'title' => $title],
            ['description' => $description],
        );

        if ($request->wasRecentlyCreated) {
            $request->updates()->create(['status' => RequestStatus::Reported, 'user_id' => $customer->id]);
        }

        return $request;
    }
}
