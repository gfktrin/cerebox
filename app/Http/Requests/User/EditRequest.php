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
        $edit_user = $this->route('user');

        $user = \Auth::user();

        return $user->admin || $user->id == $edit_user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user_id = $this->route('user')->id;

        return [
            'name' => 'required',
            'email' => "required|unique:users,email,$user_id",
            'nickname' => 'required',
            'phone' => 'required',
            'zipcode' => 'required',
            'address' => 'required',
            'number' => 'required',
            'complement' => 'required',
            'city' => 'required',
            'state' => 'required'
        ];
    }
}
