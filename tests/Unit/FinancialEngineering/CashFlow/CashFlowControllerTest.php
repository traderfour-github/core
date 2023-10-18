<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Werify\Laravel\Jobs\Trusted\GetUserTrustedJob;
use App\Models\Trader4\V1\FinancialEngineering\CashFlow\CashFlow;
use Tests\TestCase;
use Tests\FeatureTestCase;

class CashFlowControllerTest extends TestCase
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

    public function test_cash_flow_index()
    {

        $this->verifyUser();

        CashFlow::factory(2)->create([
            'user_id' => $this->uuid
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])
                         ->get('v1/my/financial-engineering/cash-flows')
                         ->assertStatus(200);
    }

//    public function test_cash_flow_show()
//    {
//        $this->verifyUser();
//        $cashFlow = CashFlow::factory()->make([
//            'user_id' => $this->uuid
//        ]);
//        $response = $this->withHeaders([
//            'Authorization' => 'Bearer ' . $this->token,
//        ])->get('v1/my/financial-engineering/cash-flows/' . $cashFlow->id)->assertStatus(200);
//
//    }

//    public function test_cash_flow_store()
//    {
//        $this->verifyUser();
//
//        $data = CashFlow::factory()->make([
//            'user_id' => $this->uuid
//        ])->toArray();
//
//        $response = $this->withHeaders([
//            'Authorization' => 'Bearer ' . $this->token,
//        ])->postJson('v1/my/financial-engineering/cash-flows', $data)->assertStatus(200);
//
//    }
//
//    public function test_cash_flow_update()
//    {
//        $this->verifyUser();
//
//        $cashFlow = CashFlow::factory()->create([
//            'user_id' => $this->uuid
//        ]);
//
//        $newData = [
//            'market_id' => "991bc116-6bd7-4c94-a0a7-452d32f512d3",
//            'trading_account_id' => "991bc116-eb07-4c19-b88e-be4a46452851",
//            'title' => "New Title",
//            'description' => "New Description",
//            'public' => true,
//            'from' => now(),
//            'till' => now()->addDays(14),
//            'status' => 20000,
//        ];
//
//        $response = $this->withHeaders([
//            'Authorization' => 'Bearer ' . $this->token,
//        ])->postJson('v1/my/financial-engineering/cash-flows/' . $cashFlow->uuid, $newData)->assertStatus(200);
//
//    }
//    public function test_cash_flow_delete()
//    {
//        $this->verifyUser();
//
//        $cashFlow = CashFlow::factory()->create([
//            'user_id' => $this->uuid
//        ]);
//
//        $response = $this->withHeaders([
//            'Authorization' => 'Bearer ' . $this->token,
//        ])->deleteJson('v1/my/financial-engineering/cash-flows/' . $cashFlow->uuid)->assertStatus(200);
//
//        $this->assertDeleted($cashFlow);
//    }
}
