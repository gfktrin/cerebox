<?php

namespace Cerebox;

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

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function contest(){
        return $this->hasManyThrough(Contest::class,Project::class,'contest_id','id','contest_id');
    }

    public function scopeFromUser($query,$user){
        if($user instanceof User)
            return $query->where('user_id',$user->id);
        else
            return $query->where('user_id',$user);
    }

    public function scopeFromProject($query,$project){
        if($project instanceof Project)
            return $query->where('user_id',$project->id);
        else
            return $query->where('user_id',$project);
    }

    public function getStatus(){
        if(is_null($this->status)) return self::$status[0];
        else return self::$status[$this->status];
    }

    public static function create(array $attributes = [])
    {
        $invoice = new static($attributes);

        $invoice->save();

        $product = Product::where('name','Inscrição')->get()->first(); //todo revisitar isso
        $user = $invoice->user;

        $payment = new Payment();

        $payment->addItems()->withParameters($product->id,$product->name,1,number_format($product->price,2));

        $payment->setCurrency('BRL');

        $payment->setReference($invoice->id);

        $payment->setRedirectUrl($invoice->redirectUrl());

        //Customer information
        $payment->setSender()->setName($user->name);
        $payment->setSender()->setEmail($user->email);

        $payment->acceptPaymentMethod()->groups(
            \PagSeguro\Enum\PaymentMethod\Group::CREDIT_CARD,
            \PagSeguro\Enum\PaymentMethod\Group::BALANCE
        );

        try{
            $result = $payment->register(Configure::getAccountCredentials());

            //Extract code
            $result = parse_url($result);
            parse_str($result['query'],$result);
            $invoice->code = $result['code'];

            $invoice->save();

        }catch(\Exception $e){
            //todo lidar com essa merda
        }

        return $invoice;
    }

    public function pay(User $user,Collection $product){

        $payment = new Payment();

        $payment->addItems()->withParameters($product->id,$product->name,1,number_format($product->price,2));

        $payment->setCurrency('BRL');

        $payment->setReference($this->id);

        $payment->setRedirectUrl($this->redirectUrl());

        //Customer information
        $payment->setSender()->setName($user->name);
        $payment->setSender()->setEmail($user->email);
        //$payment->setSender()->setPhone()->withParameters(11,56273440); //todo Ver se vou usar isso
        //$payment->setSender()->setDocument()->withParameters('CPF','insira um numero de CPF valido'); //todo ver se vou usar isso

        //Metadata
        //$payment->addMetadata()->withParameters('GAME_NAME', 'DOTA'); //todo não sei se vou usar

        $payment->acceptPaymentMethod()->groups(
            \PagSeguro\Enum\PaymentMethod\Group::CREDIT_CARD,
            \PagSeguro\Enum\PaymentMethod\Group::BALANCE
        );

        try{
            $result = $payment->register(Configure::getAccountCredentials());
        }catch(\Exception $e){

        }
    }

    public function redirectUrl(){
        return action('InvoiceController@paymentReturn',[ 'invoice_id' => $this->id]);
    }

    public function paymentUrl(){
        $env = getenv('PAGSEGURO_ENV');
        if($env == 'sandbox')
            return "https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=$this->code";
        else if($env == 'production')
            return "https://pagseguro.uol.com.br/v2/checkout/payment.html?code=$this->code";
    }

    public function setStatusAttribute($value){
        $this->attributes['status'] = $value;

        if($value == 3)
            $this->attributes['payed_at'] = date('Y-m-d H:i:s');
    }

    public function updateInfo(){
        $date = new \Carbon\Carbon('NOW -6 months');

        $response = \PagSeguro\Services\Transactions\Search\Code::search(
            \PagSeguro\Configuration\Configure::getAccountCredentials(),
            $this->transaction_id,[
                'initial_date' => $date->format('c')
            ]
        );

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
