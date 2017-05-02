<?php

namespace Cerebox\Http\Requests\Contest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = \Auth::user();
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => [
                'required',
                Rule::exists('users','id')
            ],
            'contest_id' => [
                'required',
                Rule::exists('contests', 'id')
            ],
        ];
    }
}
