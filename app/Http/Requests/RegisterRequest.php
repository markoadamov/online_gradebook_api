<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email:filter|unique:users',
            'password' => 'required|string|confirmed|regex:/^(?=.*\d)[A-Za-z\d\s]{8,}$/',
            'image_url' => 'required|url',
            'accepted_terms' => 'required|boolean'
            // 'password_confirmation' => 'required|same_as:password'

            //regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]{8,}$/
            //-Removed...Contains at least one uppercase or lowercase letter: (?=.*[A-Za-z])
            //-Contains at least one digit.
            //-Can include uppercase letters, lowercase letters, digits, and whitespace characters.
            //-At least 8 characters in length.
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please fill out this field (First name)',
            'first_name.max' => 'Maximum characters - 255',
            'last_name.required' => 'Please fill out this field (Last name)',
            'last_name.max' => 'Maximum characters - 255',
            'email.required' => 'Please fill out this field (Email)',
            'email.email' => 'Please insert a valid email address.',
            'email.unique' => "The email has already been taken.",
            'password.required' => 'Please fill out this field (Password)',
            'password_confirmation.required' => "Please fill out this field (Confirmed password).",
            'password_confirmation.same' => "Password confirmation doesn't match.",
            'password.regex' => 'Password must contain at least 8 characters with 1 number.',
            'accepted_terms.required' => 'The terms and conditions must be accepted (Accepted terms and conditions)',
        ];
    }
}