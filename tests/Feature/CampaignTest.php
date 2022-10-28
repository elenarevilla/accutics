<?php

namespace Tests\Feature;

use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_campaigns_empty_data()
    {
        $response = $this->get('/api/campaigns');
        $campaigns = json_decode($response->getContent());

        $this->assertEmpty(data_get($campaigns, 'data'));
        $response->assertStatus(200);
    }

    public function test_get_campaigns_with_data()
    {
        $numberOfCampaignToCreate = 3;
        Campaign::factory()->count($numberOfCampaignToCreate)->create();

        $response = $this->get('/api/campaigns');
        $response->assertStatus(200);

        $campaigns = json_decode($response->getContent());
        $campaignData = data_get($campaigns, 'data');

        $this->assertNotEmpty($campaignData);
        $this->assertDatabaseCount('campaigns', $numberOfCampaignToCreate);
    }
}
