<?php

declare(strict_types=1);

namespace App\Services;

use App\Organisation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrganisationService
 * @package App\Services
 */
class OrganisationService
{
    /**
     * @param array $attributes
     *
     * @return Organisation
     */
    public function createOrganisation(array $attributes): Organisation
    {
        $organisation = new Organisation($attributes);
        $organisation->owner_user_id = Auth::user()->id;
        $organisation->trial_end = Carbon::now()->addDays(30)->toDateTimeString();
        $organisation->subscribed = empty($attributes['subscribed']) ? 0 : 1;
        $organisation->save();

        return $organisation;
    }

    /**
     * @param string $filter
     *
     * @return Collection
     */
    public function filterOrganisations(string $filter): Collection
    {
        return Organisation::filter($filter)->get();
    }
}
