<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPalController extends Controller
{
    protected $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function processPayment(Request $request)
    {
        // Obtener los datos del formulario
        $cardNumber = $request->input('card_number');
        $expirationDate = $request->input('expiration_date');
        $cvv = $request->input('cvv');
        $cardHolderName = $request->input('card_holder_name');

        // Validar los datos del formulario (agrega tus propias reglas de validación aquí)

        // Configurar la API de PayPal
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );

        // Crear un objeto Payer
        $payer = new Payer();
        $payer->setPaymentMethod('credit_card');

        // Crear un objeto Transaction
        $transaction = new Transaction();
        $transaction->setAmount(/* Configura el monto de la transacción */);

        // Configurar otros detalles de la transacción (opcional)

        // Crear el objeto Payment
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction]);

        // Redireccionar URL
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(/* URL de retorno después del pago exitoso */)
            ->setCancelUrl(/* URL de cancelación del pago */);
        $payment->setRedirectUrls($redirectUrls);

        try {
            // Crear el pago
            $payment->create($apiContext);

            // Obtener la URL de aprobación
            $approvalUrl = $payment->getApprovalLink();

            // Redirigir al usuario a la URL de aprobación
            return redirect($approvalUrl);
        } catch (PayPalException $e) {
            // Manejar el error
            return back()->withErrors('Error al procesar el pago: ' . $e->getMessage());
        }
    }



    public function checkout()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(10); // Cambia el valor a la cantidad que desees cobrar

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription('Descripción de la transacción');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.complete'))
            ->setCancelUrl(route('paypal.checkout'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->to($payment->getApprovalLink());
        } catch (\Exception $e) {
            return $e;
        }

    }

    public function complete(Request $request)
    {
        $paymentId = $request->get('paymentId');
        $payerId = $request->get('PayerID');

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
            return 'listo';
        } catch (\Exception $e) {
            return $e;
        }
    }
}