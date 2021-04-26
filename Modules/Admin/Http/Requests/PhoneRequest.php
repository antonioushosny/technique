<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Models\Language;


class PhoneRequest extends FormRequest
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
     * @return array 
     */
    public function rules() 
    {
 
       
        $rules = [
            'phones_status'     => 'required',
            'phones_image'        => 'required|image|mimes:png,jpg,jpeg,gif',
        ];


            $languages = Language::active()->get();
            foreach ($languages as $language) {
                $rules[$language->locale. '.phones_title'] = 'required|min:2|max:255';
            }

            if ($this->isMethod('PUT')) {
                $rules['phones_image'] = 'nullable|image|mimes:png,jpg,jpeg,gif';
            }
     
       
        return $rules;
    }
}
