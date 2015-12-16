<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MyPostRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required'
                //'min:3'
            ],
            'body'  => 'required'
        ];
    }

}