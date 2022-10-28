<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'author_id' => 'required',
        ];
    }

    public static function data(): array
    {
        return [
            'name' => \request()->input('name'),
            'author_id' => \request()->input('author_id'),
        ];
    }
}
