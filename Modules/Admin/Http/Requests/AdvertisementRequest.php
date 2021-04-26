<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Models\Language;


class AdvertisementRequest extends FormRequest
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
        // dd($this->request->parameters->advertisements_view_page);
       
        $rules = [
            'advertisements_name'       => 'required|min:2',
            'advertisements_status'     => 'required',
            // 'advertisements_view_page'  => 'required',
            'advertisements_url'        => 'nullable|url',
            'advertisements_img'     => 'required|image',
            'advertisements_mobile_img' => 'required|image',
        ];

      

        $data = $this->request->get('advertisements_view_page');
 
            $languages = Language::active()->get();
            foreach ($languages as $language) {
                
            }
            if ($this->isMethod('PUT')) {
                $rules['advertisements_img'] = 'nullable|image';
                $rules['advertisements_mobile_img'] = 'nullable|image';
            }
     

        return $rules;
    }
}
