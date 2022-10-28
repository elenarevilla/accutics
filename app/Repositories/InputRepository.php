<?php

namespace App\Repositories;

use App\Models\Input;

class InputRepository
{
    public function upsert(array $data)
    {
        return Input::updateOrCreate($data);
    }
}
