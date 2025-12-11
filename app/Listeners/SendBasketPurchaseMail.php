<?php

namespace App\Listeners;

use App\Events\BasketPurchase;
use App\Mail\BasketPurchaseMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBasketPurchaseMail implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BasketPurchase $event): void
    {
        $mailData = $event->mailData;

        \Log::info("SendBasketPurchaseMail triggered", $mailData);

        if (empty($mailData['user_email'])) {
            \Log::error("Email missing in event data", $mailData);
            return;
        }

        Mail::to($mailData['user_email'])
            ->send(new BasketPurchaseMail($mailData));
    }
}
