<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\OrganisationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\OrganisationStoreRequest;

/**
 * Class OrganisationController
 * @package App\Http\Controllers
 */
class OrganisationController extends ApiController
{
    /**
     * @var OrganisationService $service
     */
    private $service;

    /**
     * OrganisationController constructor.
     * @param Request $request
     * @param OrganisationService $organisationService
     */
    public function __construct(Request $request, OrganisationService $organisationService)
    {
        parent::__construct($request);
        $this->service = $organisationService;
    }

    /**
     * @param OrganisationStoreRequest $request
     *
     * @return JsonResponse
     */
    public function create(OrganisationStoreRequest $request): JsonResponse
    {
        $organisation = $this->service->createOrganisation($request->validated());

        return $this
            ->transformItem('organisation', $organisation, 'user')
            ->respond();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function listAll(Request $request): JsonResponse
    {
        $organisation = $this->service->filterOrganisations($request->query("filter") ?? "all");

        return $this
            ->transformCollection('organisation', $organisation)
            ->respond();
    }
}
