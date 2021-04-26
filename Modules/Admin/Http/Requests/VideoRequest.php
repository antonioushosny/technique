<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Models\Language;


class VideoRequest extends FormRequest
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
            'videos_status'     => 'required',
            'videos_url'        => 'required|url',
        ];


            $languages = Language::active()->get();
            foreach ($languages as $language) {
                $rules[$language->locale. '.videos_title'] = 'required|min:2|max:255';
            }

            if ($this->isMethod('PUT')) {
                
            }
     
       
        return $rules;
    }
}
