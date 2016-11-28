<?php

namespace Cerebox\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->id == $this->request->get('user_id');//trocar essa merda
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user_id = $this->request->get('user_id');

        return [
            'name' => 'required',
            'email' => "required|unique:users,email,$user_id"
        ];
    }
}
