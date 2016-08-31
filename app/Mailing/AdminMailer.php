<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/31/16
 * Time: 9:28 PM
 */

namespace App\Mailing;


use App\Orders\Order;

class AdminMailer extends AbstractMailer
{
    public function conveySiteMessage($enquiry)
    {
        $to = ['ryan@absolutesport.co.za' => 'Ryan Kiepiel'];
        $from = [$enquiry['email'] => $enquiry['name']];
        $view = 'email.sitemessage';
        $data = compact('enquiry');

        $this->sendTo($to, $from, 'New Kookaburra Cricket Site message', $view, $data);
    }

    public function notifyOfNewQuoteRequest(Order $order)
    {
        $to = ['ryan@absolutesport.co.za' => 'Ryan Kiepiel'];
        $from = [$order->customer_email => $order->customer_name];
        $view = 'email.order';
        $data = [
            'order' => [
                'id' => $order->id,
                'name' => $order->customer_name,
                'email' => $order->customer_email
            ]
        ];

        $this->sendTo($to, $from, 'New Kookaburra Cricket Quote Request', $view, $data);
    }
}