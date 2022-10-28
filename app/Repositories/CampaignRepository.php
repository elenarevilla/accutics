<?php

namespace App\Repositories;

use App\Models\Campaign;

class CampaignRepository
{
    const DEFAULT_PER_PAGE = 10;
    const DEFAULT_SORT_COLUMN = 'created_at';
    const DEFAULT_SORT_ORDER = 'ASC';

    private function getBaseQuery(array $filters = [])
    {
        $sortColumn = $filters['sort_column'] ?? self::DEFAULT_SORT_COLUMN;
        $sortOrder = $filters['sort_order'] ?? self::DEFAULT_SORT_ORDER;

        return Campaign::with('inputs')->orderBy($sortColumn, $sortOrder);
    }

    public function getCampaigns(array $filters)
    {
        $perPage = $filters['per_page'] ?? self::DEFAULT_PER_PAGE;

        return $this->getBaseQuery($filters)->simplePaginate($perPage);
    }

    public function getCampaignsByAuthorId($authorId)
    {
        return $this->getBaseQuery()->where('author_id', $authorId)->get();
    }

    public function upsert(array $campaignData)
    {
        $campaign = Campaign::updateOrCreate(
            [
                'name' => $campaignData['name'],
                'author_id' => $campaignData['author_id'],
            ],
            $campaignData
        );

        //$campaign->inputs()->updateOrCreateMany($campaignData['inputs']);

        return $campaign;
    }
}
