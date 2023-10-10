<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name'=>'required|min:2',
            'metakey'=>'required',
            'metadesc'=>'required'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>'Bạn chưa nhập thông tin',
            'name.min'=>'Tên ít nhất có 2 ký tự',
            'metakey.required'=>'Chưa nhập từ khóa tìm kiếm',
            'metadesc.required'=>'Chưa nhập mô tả '
        ];
    }
}
