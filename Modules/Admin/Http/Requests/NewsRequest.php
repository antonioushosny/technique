<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Models\Language;


class NewsRequest extends FormRequest
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
            'news_status'     => 'required',
            'news_image'        => 'required|image|mimes:png,jpg,jpeg,gif',
        ];


            $languages = Language::active()->get();
            foreach ($languages as $language) {
                $rules[$language->locale. '.news_title'] = 'required|min:2|max:255';
                $rules[$language->locale. '.news_desc'] = 'required';
            }

            if ($this->isMethod('PUT')) {
                $rules['news_image'] = 'nullable|image|mimes:png,jpg,jpeg,gif';
            }
     
       
        return $rules;
    }
}
