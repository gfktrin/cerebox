<?php

namespace Cerebox\Http\Requests\Contest;

use Cerebox\Contest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = \Auth::user();
        return $user->can('create',Contest::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'themes' => 'required',
            'slug' => [
                'required',
                Rule::unique('contests')
            ],
            'begins_at' => 'required|date', //Or date_format
            'ends_at' => 'required|date', //Or date_format
        ];
    }
}
