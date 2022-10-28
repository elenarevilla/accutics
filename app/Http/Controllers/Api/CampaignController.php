<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\CreateCampaignInputs;
use App\Listeners\CampaignCreated;
use App\Repositories\CampaignRepository;
use App\Repositories\InputRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignController extends Controller
{
    private CampaignRepository $campaignRepository;

    public function __construct(CampaignRepository $campaignRepository, InputRepository $inputRepository)
    {
        $this->campaignRepository = $campaignRepository;
        $this->inputRepository = $inputRepository;
    }

    public function getCampaigns(Request $request)
    {
        return response()->json($this->campaignRepository->getCampaigns($request->only([
            'sort_column',
            'sort_order',
            'per_page',
        ])));
    }

    public function createCampaign(Request $request): JsonResponse
    {
        $campaign = $this->campaignRepository->upsert($request->only(['name', 'author_id', 'code']));
        $inputs = $request->input('inputs') ?? [];

        CreateCampaignInputs::dispatch($campaign, $inputs);

        return response()->json(['submitted' => true], Response::HTTP_CREATED);
    }
}
