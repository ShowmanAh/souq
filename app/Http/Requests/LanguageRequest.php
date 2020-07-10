<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;// prevent 403 forbidden make authorized for any one
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|string|max:100',
            'abbre' => 'required|string|max:10',
            'active' => 'required|in:0,1',
            'direction' => 'required|in:rtl,ltr',
        ];

    }
    public function messages(){
           return [
                'required' => 'هذ الحقل مطلوب',
                'name.string' => 'الاسم لابد ان يكون احرف',
                'name.max' => 'الاسم لابد ان يحتوى على احرف ااقل من 100 حرف',
                'abbre.string' => 'الاختصار لابد ان يكون احرف',
                'abbre.max' => 'الاختصار لابد ان يحتوى على احرف ااقل من 10 حرف',
                'in' => 'البيانات الدخله غير صحيحه',
           ] ;
    }
}
