<?php

namespace Tests\Feature\Http\Controllers\V1\FinancialEngineering\RiskManagement;

use App\Models\Trader4\V1\FinancialEngineering\RiskManagement;
use Tests\TestCase;

class RiskManagementControllerTest extends TestCase
{

    private string $uuid;
    private string $token;

    protected function verifyUser()
    {
        $OTP_response =  $this->postJson('v1/account/request-otp',[
            'identifier' => 'sandbox@werify.net'
        ]);

        $hash = $OTP_response->json('results.hash');
        $id = $OTP_response->json('results.id');
        $otp = $OTP_response->json('results.otp');
        $uuid = $OTP_response->json('results.user.uuid');

        $this->uuid = $uuid;

        $verify_response = $this->postJson('v1/account/verify-otp',[
            'hash' => $hash,
            'id' => $id,
            'otp' => $otp,
        ]);

        $token = $verify_response->json('results.access_token');
        $this->token = $token;
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_risk_management_index()
    {

         $this->verifyUser();

         RiskManagement::factory(5)->create([
             'user_id' => $this->uuid
         ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])
        ->get('v1/my/financial-engineering/risk-managements')
        ->assertStatus(200);
    }
}
