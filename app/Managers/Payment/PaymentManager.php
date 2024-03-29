<?php

namespace App\Managers\Payment;

use Exception;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentManager implements IPaymentManager
{
    public function __construct(string $stripeSecretKey)
    {
        Stripe::setApiKey($stripeSecretKey);
    }

    public function startSession(int $amount): ?object
    {
        $session = null;

        if ($amount > 0) {
            try {
                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items'           => [[
                        'name'     => 'Cup of coffee',
                        'images'   => ['https://cdn.pixabay.com/photo/2015/11/07/11/16/coffee-1030971_1280.jpg'],
                        'amount'   => $amount,
                        'currency' => 'gbp',
                        'quantity' => 1,
                    ]],
                    'success_url' => config('services.stripe.success_url'),
                    'cancel_url'  => config('services.stripe.cancel_url'),
                ]);
            } catch (Exception $exception) {
                abort(500, $exception->getMessage());
            }
        }

        return $session;
    }

    public function retrieveSession(string $sessionId): ?object
    {
        $session = null;

        if (trim($sessionId) !== '') {
            try {
                $session = Session::retrieve($sessionId);
            } catch (Exception $exception) {
                abort(500, $exception->getMessage());
            }
        }

        return $session;
    }
}
