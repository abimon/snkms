<?php

namespace App\Livewire\Products;

use App\Models\Mpesa;
use App\Models\Payment;
use App\Models\PesaPal;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Checkout extends Component
{
    public $redirect_url;
    
    public function generate_token()
    {
        $data = json_encode([
            'consumer_key' => env('PESAPAL_CONSUMER_KEY'),
            'consumer_secret' => env('PESAPAL_CONSUMER_SECRET')
        ]);
        $url = 'https://pay.pesapal.com/v3/api/Auth/RequestToken';
        $response = Http::withBody($data, 'application/json')->withHeaders(['Content-Type : application/json'])->post($url);
        $access_token = json_decode($response);
        return $access_token->token;
    }
    public function generate_ipn()
    {
        $data = json_encode([
            'ipn_notification_type' => 'POST',
            'url' => 'https://snkwellnesscenter.com/payment'
        ]);
        $url = 'https://pay.pesapal.com/v3/api/URLSetup/RegisterIPN';
        $response = Http::withToken($this->generate_token())->withBody($data, 'application/json')->withHeaders(['Content-Type : application/json'])->post($url);
        return json_decode($response)->ipn_id;
    }
    public function pay($amount, $reference, $id)
    {
        $user = User::findOrFail($id);
        $client = PesaPal::where('TransactionId', $reference)->first();
        if (!$client) {
            $tid = strtoupper(uniqid());
            $data = json_encode([
                "id" => $reference,
                "currency" => "KES",
                "amount" => $amount,
                "description" => "Payment description goes here",
                "callback_url" => "https://snkwellnesscenter.com/payment/update",
                "redirect_mode" => "",
                "notification_id" => $this->generate_ipn(),
                "branch" => "Main Store",
                "billing_address" => [
                    "email_address" => $user->email,
                    "phone_number" => $user->contact,
                    "country_code" => "KE",
                    "first_name" => $user->fname,
                    "last_name" => $user->sname,
                ]
            ]);
            $res = Http::withToken($this->generate_token())->withBody($data, 'application/json')->withHeaders(['Content-Type : application/json'])->post('https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest');
            $response = json_decode($res);
            $order_tracking_id = $response->order_tracking_id;
            $merchant_reference = $response->merchant_reference;
            $this->redirect_url = $response->redirect_url;
            PesaPal::create([
                'user_id' => $id,
                'TransactionId' => $reference,
                'amount' => $amount,
                'merchant_reference' => $response->merchant_reference,
                'tracking_id' => $order_tracking_id,
                'redirect_url' => $this->redirect_url,
            ]);
            // return view('dashboard.pay', compact('redirect_url'));
        } else {
            $this->redirect_url = $client->redirect_url;
            // return redirect()->route('dashboard');
        }
    }
    public function mount()
    {
        $amount = session()->get('amount');
        $reference = session()->get('reference');
        $id = session()->get('user_id');
        $this->pay($amount, $reference, $id);
    }
    
    public function render()
    {
        return view('livewire.products.checkout');
    }
}
