<?php

namespace App\Actions;

use App\Enums\RequestStatus;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TransitionServiceRequest
{
    public function schedule(ServiceRequest $request, User $staff, string $date): void
    {
        Gate::forUser($staff)->authorize('update', $request);

        Validator::make(['scheduled_for' => $date], [
            'scheduled_for' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
        ], [
            'scheduled_for.after_or_equal' => 'Kies vandaag of een datum in de toekomst.',
        ])->validate();

        $this->transition($request, $staff, RequestStatus::Reported, RequestStatus::Scheduled, [
            'scheduled_for' => $date,
        ]);
    }

    public function complete(ServiceRequest $request, User $staff, ?string $note): void
    {
        Gate::forUser($staff)->authorize('update', $request);

        Validator::make(['note' => $note], ['note' => ['nullable', 'string', 'max:500']])->validate();

        $this->transition($request, $staff, RequestStatus::Scheduled, RequestStatus::Completed, note: $note);
    }

    private function transition(
        ServiceRequest $request,
        User $staff,
        RequestStatus $from,
        RequestStatus $to,
        array $attributes = [],
        ?string $note = null,
    ): void {
        DB::transaction(function () use ($request, $staff, $from, $to, $attributes, $note): void {
            // De status in de WHERE-clausule beschermt ook bij twee gelijktijdige acties.
            $updated = ServiceRequest::query()
                ->whereKey($request->id)
                ->where('status', $from->value)
                ->update(['status' => $to->value, ...$attributes]);

            if ($updated !== 1) {
                throw ValidationException::withMessages(['status' => 'De melding is inmiddels gewijzigd. Vernieuw de pagina.']);
            }

            $request->updates()->create(['status' => $to, 'user_id' => $staff->id, 'note' => $note]);
        });
    }
}
