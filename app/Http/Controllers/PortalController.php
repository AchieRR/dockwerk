<?php

namespace App\Http\Controllers;

use App\Enums\RequestStatus;
use App\Models\ServiceRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PortalController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        if ($request->user()->is_staff) {
            return redirect()->route('filament.staff.resources.meldingen.index');
        }

        Gate::authorize('viewAny', ServiceRequest::class);
        $company = $request->user()->company;
        $requests = ServiceRequest::query()
            ->whereRelation('door', 'company_id', $company->id)
            ->with('door')
            ->latest('id')
            ->paginate(10);

        return view('portal.index', ['company' => $company, 'requests' => $requests, 'doors' => $company->doors()->orderBy('name')->get()]);
    }

    public function create(Request $request): View
    {
        Gate::authorize('create', ServiceRequest::class);

        return view('portal.create', ['doors' => $request->user()->company->doors()->orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', ServiceRequest::class);
        $user = $request->user();

        $data = $request->validate([
            'door_id' => ['required', 'integer', Rule::exists('doors', 'id')->where(fn (Builder $query) => $query->where('company_id', $user->company_id))],
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'door_id.required' => 'Kies een deur.',
            'door_id.exists' => 'Kies een deur die bij jouw bedrijf hoort.',
            'title.required' => 'Geef je melding een onderwerp.',
            'title.max' => 'Gebruik maximaal 100 tekens.',
            'description.required' => 'Beschrijf de storing.',
            'description.min' => 'Beschrijf de storing in minstens 10 tekens.',
            'description.max' => 'Gebruik maximaal 2000 tekens.',
        ]);

        $serviceRequest = DB::transaction(function () use ($data, $user): ServiceRequest {
            $serviceRequest = ServiceRequest::create($data + ['reported_by' => $user->id]);
            $serviceRequest->updates()->create(['status' => RequestStatus::Reported, 'user_id' => $user->id]);

            return $serviceRequest;
        });

        return redirect()->route('portal.show', $serviceRequest)->with('notice', 'Je melding is ontvangen.');
    }

    public function show(ServiceRequest $serviceRequest): View
    {
        Gate::authorize('view', $serviceRequest);

        return view('portal.show', [
            'serviceRequest' => $serviceRequest->load(['door.company', 'updates' => fn ($query) => $query->orderBy('id')]),
        ]);
    }
}
