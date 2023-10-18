<?php

namespace App\Services\Bridges;

use App\Models\Trader4\V1\Trading\Account;
use Exception;

class PlatformDetectionService
{

    public string $driver ;


    public function __construct(){
        $this->driver = null ;
    }


    public function driver($request) : string{
        try {
            $formatData = json_decode($request , true)['payload'];

            $trading_account = Account::query()
                                      ->find($formatData['trading_account'])?? abort(404 , __('messages.respond.not_exist'));

            if(isset($trading_account)){
                $trading_platform = Account::query()->find($trading_account->id);
                foreach ($trading_platform->platforms as $platform) {
                    $this->driver = $platform->title ;
                }

                return $this->driver ;
            }

        }catch (Exception $message) {
            throw new Exception($message->getMessage());
        }
    }
}
