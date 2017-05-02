<?php

namespace Cerebox\Http\Requests\Contest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = \Auth::user();
        $contest = $this->route('contest');

        return $user->can('update',$contest);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $contest = $this->route('contest');

        return [
            'title' => 'required',
            'themes' => 'required',
            'slug' => [
                'required',
                Rule::unique('contests')->ignore($contest->id)
            ],
            'begins_at' => 'required|date',
            'ends_at' => 'required|date',
            'registration_begins_at' => 'required|date',
        ];
    }
}
