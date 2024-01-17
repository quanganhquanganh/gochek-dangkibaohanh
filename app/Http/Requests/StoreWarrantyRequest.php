<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreWarrantyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'warranty_code' => 'required|exists:warranty_codes,code',
            'name' => 'required',
            'phone' => 'required',
            'store' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'warranty_code.required' => 'Mã bảo hành không được để trống.',
            'warranty_code.exists' => 'Kích hoạt bảo hành không thành công. Quý khách vui lòng kiểm tra lại thông tin.',
            'name.required' => 'Họ và tên không được để trống.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'store.required' => 'Cửa hàng đại lý ủy quyền không được để trống.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        foreach ($errors as $error) {
            toastr()->error($error[0], 'Không hợp lệ');
        }

        throw new HttpResponseException(back()->withInput($this->input()));
    }
}
