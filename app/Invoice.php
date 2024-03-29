<?php

namespace Cerebox;

use Cerebox\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use PagSeguro\Configuration\Configure;
use PagSeguro\Domains\Requests\Payment;
use PagSeguro\Enum\PaymentMethod\Group;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $guarded = [ 'id' ];

    public static $status = [
       0 => 'Novo',
       1 => 'Aguardando Pagamento',
       2 => 'Em análise',
       3 => 'Paga',
       4 => 'Disponível',
       5 => 'Em disputa',
       6 => 'Devolvida',
       7 => 'Cancelada',
       8 => 'Debitado',
       9 => 'Retenção temporária'
    ];

    public static $payment_methods = [
        '101' => 'Cartão de crédito Visa',
        '102' => 'Cartão de crédito MasterCard',
        '103' => 'Cartão de crédito AmericanExpress',
        '104' => 'Cartão de crédito Diners',
        '105' => 'Cartão de crédito Hipercard',
        '106' => 'Cartão de crédito Aura',
        '107' => 'Cartão de crédito Elo',
        '108' => 'Cartão de crédito PLENOCard',
        '109' => 'Cartão de crédito PersonalCard',
        '110' => 'Cartão de crédito JCB',
        '111' => 'Cartão de crédito Discover',
        '112' => 'Cartão de crédito BrasilCard',
        '113' => 'Cartão de crédito FORTBRASIL',
        '114' => 'Cartão de crédito CARDBAN',
        '115' => 'Cartão de crédito VALECARD',
        '116' => 'Cartão de crédito Cabal',
        '117' => 'Cartão de crédito Mais!',
        '118' => 'Cartão de crédito Avista',
        '119' => 'Cartão de crédito GRANDCARD',
        '120' => 'Cartão de crédito Sorocred',
        '201' => 'Boleto Bradesco',
        '202' => 'Boleto Santander',
        '301' => 'Débito online Bradesco',
        '302' => 'Débito online Itaú',
        '303' => 'Débito online Unibanco',
        '304' => 'Débito online Banco do Brasil',
        '305' => 'Débito online Banco Real',
        '306' => 'Débito online Banrisul',
        '307' => 'Débito online HSBC',
        '401' => 'Saldo PagSeguro',
        '501' => 'Oi Paggo',
        '701' => 'Depósito em conta - Banco do Brasil',
        '702' => 'Depósito em conta - HSBC',
    ];

    public static $payment_methods_groups = [
        '1' => 'Cartão de crédito',
        '2' => 'Boleto',
        '3' => 'Débito Online',
        '4' => 'Saldo PagSeguro',
        '5' => 'Oi Paggo',
        '7' => 'Depósito em conta'
    ];

    //Relationships
    public function purchase()
    {
        return $this->hasOne(Purchase::class,'invoice_id');
    }


    public function user()
    {
        return $this->purchase->user;
    }

    public function getStatus()
    {
        if(is_null($this->status)) return self::$status[0];
        else return self::$status[$this->status];
    }

    public function pay()
    {

        if(is_null($this->code)){

            $payment = new Payment();

            $products = $this->purchase->products;

            foreach($products as $product){
                $payment->addItems()->withParameters($product->id,$product->name,$product->pivot->quantity,number_format($product->price));
            }

            $payment->setCurrency('BRL');

            $payment->setReference($this->id);

            $payment->setRedirectUrl($this->redirectUrl());

            //Customer information

            $user = $this->user();

            //Gambiarra Fix
            $exploded_name = explode(' ',$user->name);
            if(count($exploded_name) < 2)
                $name = $user->name.' Cerebox';
            else
                $name = $user->name;

            $payment->setSender()->setName($name);
            $payment->setSender()->setEmail($user->email);

            $payment->acceptPaymentMethod()->groups(
                \PagSeguro\Enum\PaymentMethod\Group::CREDIT_CARD,
                \PagSeguro\Enum\PaymentMethod\Group::BALANCE,
                \PagSeguro\Enum\PaymentMethod\Group::BOLETO
            );

            try{
                //Não tive tempo de colocar isso da melhor forma, pq o getAccountCrendentials parou de funcionar
                Configure::setAccountCredentials(env('PAGSEGURO_EMAIL'),env('PAGSEGURO_TOKEN_PRODUCTION'));

                $result = $payment->register(Configure::getAccountCredentials());

                //Extract code
                $result = parse_url($result);
                parse_str($result['query'],$result);
                $this->code = $result['code'];

                $this->save();

            }catch(\Exception $e){
                //todo lidar com essa merda
                \Log::critical('Deu ruim no pagamento - '.$e->getMessage());
            }

        }

        return redirect($this->paymentUrl());

    }

    public function redirectUrl()
    {
        return action('InvoiceController@paymentReturn',[ 'invoice_id' => $this->id]);
    }

    public function paymentUrl()
    {
        $env = getenv('PAGSEGURO_ENV');
        if($env == 'sandbox')
            return "https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=$this->code";
        else if($env == 'production')
            return "https://pagseguro.uol.com.br/v2/checkout/payment.html?code=$this->code";
        else
            throw new \Exception('Invalid Environment');
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value;

        if($value == 3){
            $this->purchase->approved();
            $this->attributes['payed_at'] = date('Y-m-d H:i:s');
        }
    }

    public function updateInfo()
    {
        $date = new \Carbon\Carbon('NOW -1 month');

        Configure::setAccountCredentials(env('PAGSEGURO_EMAIL'),env('PAGSEGURO_TOKEN_PRODUCTION'));

        try {
            $response = \PagSeguro\Services\Transactions\Search\Code::search(
                \PagSeguro\Configuration\Configure::getAccountCredentials(),
                $this->transaction_id, [
                    'initial_date' => $date->format('c')
                ]
            );
        }catch(\Exception $e){

            $curl = curl_init();
            curl_setopt_array($curl,[
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => 'https://ws.pagseguro.uol.com.br/v2/transactions?email='.env('PAGSEGURO_EMAIL').'&token='.env('PAGSEGURO_TOKEN_PRODUCTION').'&reference='.$this->id.'&initialDate='.$date->format('c'),
            ]);

            $response = curl_exec($curl);

            $response = simplexml_load_string($response);        

            curl_close($curl);

            $this->transaction_id = $response->transactions->transaction->code->__toString();

            $this->save();

            $response = \PagSeguro\Services\Transactions\Search\Code::search(
                \PagSeguro\Configuration\Configure::getAccountCredentials(),
                $this->transaction_id, [
                    'initial_date' => $date->format('c')
                ]
            );

//            Essa merda está bugado. Obrigado PagSeguro
//            $response = \PagSeguro\Services\Transactions\Search\Reference::search(
//                \PagSeguro\Configuration\Configure::getAccountCredentials(),
//                $this->id, [
//                    'initial_date' => $date->format('c'),
//                ]
//            );
        }

        $this->status = $response->getStatus();

        if(is_null($this->payment_method))
            $this->payment_method = $response->getPaymentMethod()->getCode();
        
        if(is_null($this->amount))
            $this->amount = $response->getGrossAmount();
        
        if(is_null($this->net_amoutn))
            $this->net_amount = $response->getNetAmount();

        $this->save();
    }
}
