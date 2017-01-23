<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Invoice;
use Illuminate\Http\Request;
use PagSeguro\Services\Application\Search\Notification;

class InvoiceController extends Controller
{
    public function paymentReturn(Request $request)
    {
        $invoice = Invoice::where('id',$request->get('invoice_id'))->get()->first();

        $invoice->transaction_id = $request->get('transaction_id');

        $invoice->save();

        $invoice->updateInfo();

        return redirect()->action('HomeController@paymentReturn');
    }

    public function notification(Request $request)
    {
        $notification_type = $request->get('notificationType');
        $notification_code = $request->get('notificationCode');

        $response = Notification::search(\PagSeguro\Configuration\Configure::getAccountCredentials(), $notification_code);

        $invoice = Invoice::where('transaction_id',$response->getCode())->get()->first();

        if(is_null($invoice)){
            $invoice = Invoice::where('id',$response->getReference())->get()->first();

            $invoice->transaction_id = $response->getCode();

            $invoice->save();
        }

        $invoice->updateInfo();
    }

    public function create()
    {

    }

    public function updateStatus(Request $request,Invoice $invoice)
    {
        $invoice->updateInfo();

        if($request->ajax())
            return $invoice;
        else
            return redirect()->back();
    }
}
