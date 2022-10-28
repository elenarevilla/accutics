<?php

namespace App\Jobs;

use App\Models\Campaign;
use App\Repositories\InputRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCampaignInputs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Campaign $campaign;
    private array $inputs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Campaign $campaign, $inputs = [])
    {
        $this->campaign = $campaign;
        $this->inputs = $inputs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(InputRepository $inputRepository)
    {
        foreach ($this->inputs as $input) {
            $inputRepository->upsert([
                'campaign_id' => $this->campaign->id,
                'type' => $input['type'],
                'value' => $input['value'],
            ]);
        }
    }
}
