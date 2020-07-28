<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
        return [
            'logo' =>'required_without:id|mimes:jpg,jpeg,png',// required in storee only
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:vendors,email,'.$this->id,
            'password' => 'required_without:id',
            'phone' => 'required|max:100|unique:vendors,phone,'.$this->id,//ignore id for this user
            'category_id' => 'required|exists:maincategories,id',
            'address' => 'required|string|max:500',
        ];
    }
    public function messages(){
        return [
          'logo.required_without' => 'الصوره مطلوبه',
          'name.required' => 'الاسم مطلوب',
          'email.required_without' => 'البريد الالكترونى مطلوب',
          'password.required_without' => 'كلمه المرور مطلوبه',
          'phone.required' => 'رقم الفون مطلوب',
          'category_id.required' => 'القسم مطلوب',
          'address.required' => 'العنوان مطلوب',
          'name.string' => 'الاسم حروف او ارقام',
          'name.max' => 'الاسم لايزيد عن 100',
          'email.email' => 'الاميل لابد ان يحتوى@gmail/hotmail/yahoo',
          'phone.unique' => 'رقم الفون  موجود من قبل',
          'category_id.exists' => ' القسم غير موجود',
          'address.max' => 'العنوان لايزيد عن 500',
        ];
    }
}
