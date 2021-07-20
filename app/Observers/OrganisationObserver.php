<?php

namespace App\Observers;

use App\Mail\OrganisationCreate;
use App\Organisation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class OrganisationObserver
{
    /**
     * Handle the organisation "created" event.
     *
     * @param  Organisation  $organisation
     * @return void
     */
    public function created(Organisation $organisation): void
    {
        try {
            Mail::to($organisation->owner->email)->send(new OrganisationCreate($organisation->name, $organisation->trial_end, $organisation->owner->name));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
