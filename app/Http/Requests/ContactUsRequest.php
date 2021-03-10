<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class ContactUsRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
            'contact_us_name' => 'required',
			'contact_us_phone' => 'required',
			'contact_us_email' => 'nullable|email',
			'contact_us_message' => 'required',
			'contact_us_type'		=> 'required',
		];

		$data = $this->request->get('contact_us_email');
        if($data){
            $rules['contact_us_email'] = 'email';
        }
		return $rules;
	}

	/**
	 * Get the validation messages that apply to the request.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
}
