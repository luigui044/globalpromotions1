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
USE App\Http\Controllers\VentaController;

class PayPalController extends Controller
{
    protected $apiContext;
    ////credenciales de api
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
    //procesamiento de pago con formulario de pago 
    public function processPayment(Request $request)
    {


        ////////////////CODIGO DE CHAT GPT///////////////////////////////
        // Obtener los datos del formulario
        $cardNumber = $request->input('card_number');
        $expirationDate = $request->input('expiration_date');
        $cvv = $request->input('cvv');
        $cardHolderName = $request->input('card_holder_name');

        // Validar los datos del formulario (agrega tus propias reglas de validación aquí)

      

        // Crear un objeto Payer
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(10);
        // Crear un objeto Transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount )
        ->setDescription('Descripción de la transacción');


        // Configurar otros detalles de la transacción (opcional)
        // Redireccionar URL
            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(route('paypal.complete'))
                ->setCancelUrl(route('paypal.checkout'));

        // Crear el objeto Payment
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

       
        try {
            // Crear el pago
            $payment->create($this->apiContext);
            // Obtener la URL de aprobación
            return redirect()->to($payment->getApprovalLink());
            // Redirigir al usuario a la URL de aprobación
        } catch (\PayPalException $e) {
            // Manejar el error
            return back()->withErrors('Error al procesar el pago: ' . $e->getMessage());
        }
    }


    //procesamiento depago redirigiendo a paypal 
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
        } catch (\PayPalException $e) {
            return $e;
        }

    }
    ///cuando pasa de checkout a complete
    public function complete(Request $request)
    {
        $paymentId = $request->get('paymentId');
        $payerId = $request->get('PayerID');

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
   
        } catch (\Exception $e) {
            return $e;
        }
    }
}