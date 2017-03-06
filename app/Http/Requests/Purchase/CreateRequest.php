<?php

namespace Cerebox\Http\Requests\Purchase;

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
        $check = \Auth::check();

        $user = \Auth::user();

        if(!$user->admin)
            $check = $check && ($user->id == $this->get('user_id'));

        return $check;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'products.*.id' => 'exists:products,id',
            'products.*.quantity' => 'required_with:products.*.id|numeric|min:1'
        ];
    }
}
