<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_type' => ['in:customer,merchant'],
            'phone' => ['required', Rule::unique('users')->ignore($this->user()->id)],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string','email','max:255',Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],

            'discription' => ['nullable','string','required_if:user_type,==,merchant',Rule::requiredIf($this->user()->user_type == 'merchant')],
            'commercial_register' => ['nullable',Rule::requiredIf($this->user()->user_type == 'merchant'),'numeric', Rule::unique(User::class)->ignore($this->user()->id)],
            'categories_id' =>['nullable','array',Rule::requiredIf($this->user()->user_type == 'merchant')],
            'categories_id.*' => ['exists:categories,id'],
            'website_link' => ['nullable'], 


        ];
    }
}
