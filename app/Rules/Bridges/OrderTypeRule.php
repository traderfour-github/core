<?php

namespace App\Rules\Bridges;

use Illuminate\Contracts\Validation\Rule;

class OrderTypeRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value)
    {
        $orderTypes = [
            //MQL5
            "ORDER_TYPE_BUY","ORDER_TYPE_SELL","ORDER_TYPE_BUY_LIMIT","ORDER_TYPE_SELL_LIMIT","ORDER_TYPE_BUY_STOP",
            "ORDER_TYPE_SELL_STOP" , "ORDER_TYPE_BUY_STOP_LIMIT" ,"ORDER_TYPE_SELL_STOP_LIMIT" ,"ORDER_TYPE_CLOSE_BY",
            //MQL4
            "OP_BUY" ,"OP_SELL","OP_BUYLIMIT","OP_BUYSTOP","OP_SELLLIMIT","OP_SELLSTOP"
        ];
        return in_array($value , $orderTypes);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute type must be valid';
    }
}
