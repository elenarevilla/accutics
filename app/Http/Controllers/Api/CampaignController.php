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
        $filters = [
            'sort_column' => $request->input('sort_column'),
            'sort_order' => $request->input('sort_order'),
            'per_page' => $request->input('per_page'),
        ];

        return response()->json($this->campaignRepository->getCampaigns($filters));
    }

    public function createCampaign(Request $request): JsonResponse
    {
        $campaign = $this->campaignRepository->upsert([
            'name' => $request->input('name'),
            'author_id' => $request->input('author_id'),
        ]);

        CreateCampaignInputs::dispatch($campaign, $request->input('inputs'));

        return response()->json(['submitted' => true], Response::HTTP_CREATED);
    }
}
