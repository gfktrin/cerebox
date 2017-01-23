<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function paymentReturn(Request $request)
    {
        $invoice = Invoice::find($request->get('invoice_id'));

        $invoice->transaction_id = $request->get('transaction_id');

        $invoice->save();

        $invoice->updateInfo();

        return redirect()->action('HomeController@paymentReturn');
    }

    public function notification(Request $request)
    {
        $notification_type = $request->get('notificationType');
        $notification_code = $request->get('notificationCode');

        $invoice = Invoice::where('transaction_id',$notification_code)->get()->first();

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
