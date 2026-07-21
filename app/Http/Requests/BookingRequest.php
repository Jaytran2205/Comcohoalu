<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'booking_time' => ['required', 'string'],
            'adults' => ['required', 'integer', 'min:1', 'max:100'],
            'children' => ['nullable', 'integer', 'min:0', 'max:50'],
            'customer_name' => ['required', 'string', 'min:2', 'max:100'],
            'customer_phone' => ['required', 'regex:/^(0[35789])\d{8}$/'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'special_requests' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'booking_date.required' => 'Vui lòng chọn ngày đặt bàn.',
            'booking_date.after_or_equal' => 'Ngày đặt bàn phải từ hôm nay trở đi.',
            'booking_time.required' => 'Vui lòng chọn giờ đặt bàn.',
            'adults.required' => 'Vui lòng nhập số lượng người lớn.',
            'adults.min' => 'Số lượng người lớn tối thiểu là 1.',
            'adults.max' => 'Số lượng người lớn tối đa là 100.',
            'children.min' => 'Số lượng trẻ em không hợp lệ.',
            'customer_name.required' => 'Vui lòng nhập họ tên.',
            'customer_name.min' => 'Họ tên phải có ít nhất 2 ký tự.',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại.',
            'customer_phone.regex' => 'Số điện thoại không hợp lệ (VD: 0912345678).',
            'customer_email.email' => 'Email không hợp lệ.',
            'special_requests.max' => 'Yêu cầu thêm tối đa 500 ký tự.',
        ];
    }

    public function attributes(): array
    {
        return [
            'booking_date' => 'ngày đặt bàn',
            'booking_time' => 'giờ đặt bàn',
            'adults' => 'số người lớn',
            'children' => 'số trẻ em',
            'customer_name' => 'họ tên',
            'customer_phone' => 'số điện thoại',
            'customer_email' => 'email',
            'special_requests' => 'yêu cầu thêm',
        ];
    }
}
