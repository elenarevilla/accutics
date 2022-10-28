<?php

namespace App\Repositories;

use Illuminate\Support\Str;

class UserRepository
{
    protected array $users = [
        [
            'id' => 'a42bad6c-6361-37f5-bcfe-56624074be60',
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@test.com',
        ],
        [
            'id' => '23766472-f58e-3442-8128-2ee0f973178e',
            'name' => 'Jane Doe',
            'username' => 'janedoe',
            'email' => 'janedoe@test.com',
        ],
        [
            'id' => '8d1d6f07-af91-3e90-8d29-2d8524c05ac3',
            'name' => 'Edward Elric',
            'username' => 'edwardelric',
            'email' => 'edwardelric@test.com',
        ],
        [
            'id' => 'b0c52f4a-9381-3736-98f9-b63196fa444b',
            'name' => 'Monkey D Luffy',
            'username' => 'monkeydluffy',
            'email' => 'monkeydluffy@test.com',
        ]
    ];

    public function getUsers($filters): array
    {
        $users = $this->users;

        if (array_filter($filters)) {
            $users = $this->filterUsers($filters);
        }

        return $this->appendNumberOfCampaigns($users);
    }

    private function filterUsers($filters): array
    {
        return collect($this->users)->filter(function ($user, $key) use ($filters) {
            foreach ($filters as $name => $value) {
                if(Str::contains($user[$name], $value)) {
                    return true;
                }
            }
        })->toArray();
    }

    private function appendNumberOfCampaigns(array $users): array
    {
        $usersWithNumberOfCampaigns = collect($users)->map(function ($user, $key) {
            $userCampaigns = app(CampaignRepository::class)->getCampaignsByAuthorId($user['id']);
            $user['campaigns'] = $userCampaigns;
            return $user;
        });

        return $usersWithNumberOfCampaigns->toArray();
    }
}
