<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ServiceRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->is_staff || $user->company_id !== null;
    }

    public function view(User $user, ServiceRequest $request): Response
    {
        return $user->is_staff || ($user->company_id !== null && $user->company_id === $request->door->company_id)
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function create(User $user): bool
    {
        return ! $user->is_staff && $user->company_id !== null;
    }

    public function update(User $user, ServiceRequest $request): bool
    {
        return $user->is_staff;
    }
}
