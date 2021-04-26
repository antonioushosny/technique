<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Models\Language;


class ComparisonRequest extends FormRequest
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
            'comparisons_status'     => 'required',
        ];


            $languages = Language::active()->get();
            foreach ($languages as $language) {
                $rules[$language->locale. '.comparisons_title'] = 'required|min:2|max:255';
            }

            if ($this->isMethod('PUT')) {
                
            }
     
       
        return $rules;
    }
}
