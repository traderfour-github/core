<?php

namespace App\Http\Requests\V1\Bridge;

use App\Rules\Bridges\OrderTypeRule;
use Illuminate\Foundation\Http\FormRequest;

class WebhookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'app_key'          => 'required|string',
            'order'            => ['required','string' , new OrderTypeRule()],
            'instrument'       => 'required|string|min:3|max:255',
            'stop_loss'        => 'required|string|max:255',
            'target_price'     => 'required|string|max:255',
            'risk'             => 'required|string|max:255',
            'risk_mode'        => 'nullable|string',
            'trading_account'  => 'nullable|string|max:255', //identity
        ];
    }


    public function prepareForValidation()
    {
        if(method_exists($this , 'defaults')){
            foreach ($this->defaults() as $key => $defaultValue){
                if(!$this->has($key)) $this->merge([$key => $defaultValue]);
            }
        }
    }


    public function defaults(){
        return [
          "risk_mode"   => "balance"
        ];
    }
}
