<?php

namespace App\Http\Requests\V1\Bridge;

use App\Enums\V1\Market\Platform\PlatformType;
use App\Events\Bridge\MTBridgeEvent;
use App\Rules\Bridges\MT4CommandRule;
use App\Rules\Bridges\MT5CommandRule;
use App\Services\Bridges\PlatformDetectionService;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class CheckCommandRequest
{
    public function call($request){

        (object) $commands = null ;

        $formatData = json_decode($request , true)['payload'];
        $driver     =  (new PlatformDetectionService())->driver($request);

        if($driver == PlatformType::MT4){
            $commands = new MT4CommandRule() ;
        }else if($driver == PlatformType::MT5){
            $commands = new MT5CommandRule() ;
        }

        $validator = Validator::make($formatData , [
            'trading_account'  => 'required|string',
            'arguments'        => 'nullable|array',
            'command'          => ['required' , 'string' , 'max:255' , $commands]
        ]);


        if($validator->fails()){
            return $validator->getMessageBag();
        }else{
            $redis = Redis::connection();
            $redis->set('request_client' , $request);

            event(new MTBridgeEvent($request));

           return $request ;
        }
    }
}
