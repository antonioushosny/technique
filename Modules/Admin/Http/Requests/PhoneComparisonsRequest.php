<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Models\Language;


class PhoneComparisonsRequest extends FormRequest
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
            'phones_id'     => 'required',
            'comparisons_id.*'        => 'required',
            'phones_comparisons_text_ar.*'        => 'required',
            'phones_comparisons_text_en.*'        => 'required',
        ];
 
        return $rules;
    }
}
