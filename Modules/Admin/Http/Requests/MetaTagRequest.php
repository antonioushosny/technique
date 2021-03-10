<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Models\Language;

class MetaTagRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
            'metatags_page' => 'required',
		];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	$rules[$language->locale. '.metatags_title'] = 'required|max:250';
        	$rules[$language->locale. '.metatags_desc'] = 'required';
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
