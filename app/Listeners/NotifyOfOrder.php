<?php

namespace App\Listeners;

use App\Events\OrderWasPlaced;
use App\Mailing\AdminMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyOfOrder
{
    /**
     * @var AdminMailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param AdminMailer $mailer
     */
    public function __construct(AdminMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  OrderWasPlaced  $event
     * @return void
     */
    public function handle(OrderWasPlaced $event)
    {
        $this->mailer->notifyOfNewQuoteRequest($event->order);
    }
}
