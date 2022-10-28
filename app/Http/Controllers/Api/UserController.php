<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CampaignRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private CampaignRepository $campaignRepository;
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository, CampaignRepository $campaignRepository)
    {
        $this->userRepository = $userRepository;
        $this->campaignRepository = $campaignRepository;
    }

    public function getUsers(Request $request)
    {
        $filters = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
        ];

        $users = $this->userRepository->getUsers($filters);

        return response()->json($users);
    }
}
