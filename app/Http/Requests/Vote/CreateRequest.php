<?php

namespace Cerebox\Http\Requests\Vote;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Admin::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'required|exists:projects,id|different:project_2_id',
            'project_2_id' => 'required|exists:projects,id|different:project_id',

        ];
    }
}
