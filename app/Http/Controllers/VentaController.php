<?php

namespace App\Http\Controllers;


use DB;
use PDF;
Use Alert;
use stdClass;
use Exception;
use JavaScript;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPdfEmail;
use App\Mail\MailNotify;
use Carbon\Carbon;
use App\Models\TPrueba;
use App\Models\TVenta;
use App\Models\TDetaVenta;
use App\Models\TEvento;
use App\Models\TBoleto;
use App\Models\VwVenta;
use App\Models\VwDatosBoleto;
use App\Models\VwAsiLocalidade;
use App\Events\NewVentaTicketMesa;
use SimpleSoftwareIO\QrCode\Generator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Jenssegers\Date\Date;

use Dompdf\Dompdf;
use GuzzleHttp\Client;



class VentaController extends Controller
{
    private $client;
    private $clienteId;
    private $secret;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api-m.sandbox.paypal.com'
        ]);
        $this->clientId =  'ASTK97kvu4JcQSt1rVeLFAK_HAMHTjIYd1u46_nYHJEkbo7I1xokfl15dQxG1pWDLk7S-lJOvnw6I6-v';
        $this->secret =  'EF_RCV8NU5MRW2is8cwXHa5a8tvgiDPViX8acZkPxE41t2TxyR8Q1oN5E_d1rzJ-wkBC1RlyssgowxhH';


    } 

    private function getAccesssToken()
    {
        $response = $this->client->request('POST','/v1/oauth2/token',[
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'body' => 'grant_type=client_credentials',
            'auth' => [
                $this->clientId, $this->secret, 'basic'
            ]
        ]);
        
        $data = json_decode($response->getBody(), true);
        return $data['access_token'];
    }

    public function sendPdfEmail(Request $request)
    {   
        try

      {  
            if ($request->hasFile('pdf')) {
                $pdf = $request->file('pdf');
                $email = Auth()->user()->email;
                $pdfPath = public_path('pdfs/ticket.pdf');
                $pdf->move(public_path('pdfs'), 'ticket.pdf');
                Mail::to($email)->send(new SendPdfEmail($pdfPath));
                unlink($pdfPath);
                return response('El archivo PDF ha sido enviado correctamente.', 200);
               
            }
     

  
        }

        catch (Exception $e) {
            return response( $e  , 400);
        }


    }


    function vender(Request $req){
        $evento = TEvento::find($req->id);
        $fecha_actual = date("d-m-Y");
        $fecha= new Date( Carbon::create($req->fechas)->toDayDateTimeString());
        $fecha2= $fecha->format('j F Y');
        $dia = $fecha->format('l');
        $cantidad = $req->cantidad;
        $boletos = array();
        $nombreCliente = auth()->user()->first_name.' '. auth()->user()->last_name;
        $accessToken = $this->getAccesssToken();
        $orderId= $req->orderId;
        $payerId= $req->payerId;

        $response =   $this->client->request('GET','/v2/checkout/orders/'.$orderId,[
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer $accessToken"
            ]
        ]);

        $data = json_decode($response->getBody(), true);


        if($data['status']==='APPROVED')
        {
       
            $venta = new TVenta();
            $venta->id_cliente = auth()->user()->id;
            $venta->fecha = $fecha_actual;
            $venta->id_evento = $req->id;
            $venta->tipo_venta = 1;
            $venta->subtotal = $req->subTotal;
            $venta->total = $data['purchase_units'][0]['amount']['value'];
            $venta->pp_order_id = $orderId;
            $venta->pp_payer_id = $payerId;


          
            if ($req->selectSeats != "") {
                $venta->asientos =  $req->selectSeats;
            }
            $venta->save();
            
            $idVenta = $venta->id;

            for ($i=0; $i < $cantidad ; $i++) { 
                if ($req->selectSeats != "")
                {
                    $arrayBoletos = explode(',',$req->selectSeats);
                    $mesaSilla = $this->obtenerDetalleUbicacion($arrayBoletos[$i]);
                }
                

                $nuevoBoleto = new TBoleto();
                $nuevoBoleto->id_localidad = $req->localidad;
                $nuevoBoleto->id_evento = $req->evento;
                $nuevoBoleto->fecha_stamp = strtotime('now');
                if ($req->selectSeats != "") {
                $nuevoBoleto->mesa = $mesaSilla['mesa'];
                $nuevoBoleto->asiento = $mesaSilla['asiento'];           
                $nuevoBoleto->id_espacio = $req->selectSeats;

                }
             
                $nuevoBoleto->save();

                $boleto = $nuevoBoleto->id;
                $localidad = $nuevoBoleto->id_localidad;
                $evento1 =  $req->evento; 
                $fechaStamp =$nuevoBoleto->fecha_stamp;

                 //codigo para genera el qr 
                $qrCode =new Generator;
                $rutaImagen = storage_path('globalProd/public/img/logo.jpg');
                $nuevoBoleto->codigo_qr = QrCode::size(170)->style('dot')->eye('circle')->merge('\public\img\logo.png',.5)->generate($boleto.'-'.$localidad.'-'.$evento1.'-'.$fechaStamp);
                $nuevoBoleto->save();
                array_push($boletos,$nuevoBoleto);


                $detVenta =  new TDetaVenta();
                $detVenta->id_venta = $idVenta;
                $detVenta->id_boleto = $boleto;
                $detVenta->id_localidad = $localidad;
                $detVenta->id_evento = $req->evento;
                $detVenta->fecha_stamp = $fechaStamp;
                $detVenta->save();

                // Se dispara el evento de boleto comprado cuando ya se han insertado los datos en todas las tablas
                broadcast(new NewVentaTicketMesa(
                    $nuevoBoleto->id_evento,
                    $nuevoBoleto->id_localidad,
                    $nuevoBoleto->mesa, 
                    $nuevoBoleto->asiento, 
                ))->toOthers();
            }

            $datosBoletos = VwAsiLocalidade::where('evento',$req->evento)->where('id_asignacion',$localidad)->first();
            $precioBoleto = $datosBoletos->precio;
            $nombreLocalidad = $datosBoletos->nombre_localidad;
            // $this->generarPDF($idVenta);

            JavaScript::put([
                'boletos' => $boletos,
                'orderId' => $orderId,
                'evento' => $evento,
                'fecha2' => $fecha2,
                'dia' => $nombreCliente,
                'precioBoleto' => $precioBoleto,
                'nombreLocalidad' => $nombreLocalidad

            ]);

            return view('tiquetera.ticket', compact('idVenta','boletos','orderId','evento','fecha2','dia','nombreCliente','precioBoleto','nombreLocalidad','localidad'));
        }

        alert()->error('Error','No se ha podido procesar el pago');

        return back(); 
    }

    function concierto($id){
        $evento = TEvento::where('id_evento', $id)->first();
        $localidades = VwAsiLocalidade::where('evento',$id)->get();
        $fecha= new Date( Carbon::create($evento->fechas)->toDayDateTimeString());
        $fecha2= $fecha->format('j F Y');
        $dia = $fecha->format('l');
        JavaScript::put([
            'evento' => $evento,
            'localidades' => $localidades,
        ]);
        return view('tiquetera.venta-concierto',compact('evento','localidades','fecha2','dia'));

    }

    public function obtenerDetalleUbicacion($ubicacion) {
        $partes = explode('-', $ubicacion);
        $mesa = str_replace('mesa', '', $partes[0]);
        $asiento = str_replace('asiento', '', $partes[1]); 
        return ['mesa' => $mesa, 'asiento' => $asiento];
    }

    function filtrarDisLocalidad(Request $req){
        $localDis = VwAsiLocalidade::where('id_asignacion',$req->id)->first();
        return view('tiquetera.partials.localidad-disponible',compact('localDis'));
    }

    function desplegarMesas(){
        return view('desplegarmesas');
    }

    function desplegarsillas(){
        return view('desplegarsillas');
    }
}
