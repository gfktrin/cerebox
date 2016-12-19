<?php

namespace Cerebox\Http\Requests\Project;

use Cerebox\Project;
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

        return $user->can('create', Project::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'author_id' => [
                'required',
                Rule::exists('users','id')
            ],
            'contest_id' => [
                'required',
                Rule::exists('contests', 'id')
            ],
            'art' => 'required|max:5000|mimes:jpeg,png,gif'
        ];
    }
}
