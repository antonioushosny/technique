<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Models\Language;

class ContactRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
            'contacts_mobiles' => 'required',
            'contacts_facebook' => 'required|url',
			'contacts_twitter' => 'required|url',
			'contacts_instagram' => 'required|url',
			'contacts_snapchat' => 'required|url',
			'contacts_whatsapp' => 'required|numeric',
			 
		];
	 
        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	// $rules[$language->locale. '.contacts_address'] = 'required|max:250';
        	$rules[$language->locale. '.contacts_text'] = 'required';
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
