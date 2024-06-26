<?php

namespace App\Domains\Order\Requests;

use App\Domains\Order\Enums\OrderDeliveryMethodEnum;
use App\Domains\Order\Enums\OrderTypeEnum;
use App\Domains\Payment\Enums\PaymentStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['required','integer','exists:clients,id'],
            'order_name' => ['required','string','max:255'],
            'order_type' => ['required', OrderTypeEnum::toValidationRule()],
            'quantity' => ['required', 'numeric','min:0.01'],
            'price' => ['required', 'numeric','min:0.01'],
            'deadline' => ['required', 'date'],
            'payment_status' => ['required', PaymentStatusEnum::toValidationRule()],
            'delivery_method' => ['nullable', OrderDeliveryMethodEnum::toValidationRule()],
            'package_quantity' => ['required', 'numeric', 'min:1'],
            'payment_amount' => ['nullable', 'numeric', 'min:0.01']
        ];
    }
}
