<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Bid;

class AuctionPlaceBidRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'amount' => 'required|numeric',
        ];
    }
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $auctionId = $this->route('auctionId');
            $currentMaxAmount = Bid::where('auction_id', $auctionId)->max('amount');
            $enteredAmount = $this->input('amount');

            if ($enteredAmount <= $currentMaxAmount) {
                $validator->errors()->add('amount', 'The bid amount must be greater than the current maximum amount.');
            }
        });
    }
}
