<?php

namespace Tests;

use Werify\Laravel\Jobs\Account\VerifyOTPJob;
use Werify\Laravel\Jobs\Account\RequestOTPJob;

trait RemoteUser
{
    protected $user;
    protected $access_token;

    public function __construct()
    {
        $data = data_get(dispatch_sync(new RequestOTPJob('sandbox@werify.net')), 'results');
        if ($data) {
            $id = data_get($data, 'id');
            $hash = data_get($data, 'hash');
            $otp = data_get($data, 'otp');
            $verify = data_get(dispatch_sync(new VerifyOTPJob($id, $hash, $otp)), 'results');

            $this->access_token = $verify['access_token'];
            $this->user = (object) $data['user'];
        }
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getToken()
    {
        return $this->access_token;
    }
}
