<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;

use Dompdf\Dompdf;

class TicketsController extends Controller
{
    public function pruebaPDF()
    {

        // //necesito renderiszar una view que contiene imagenes con dompdf y que no de error al renderizar la imagen
        // $options = new Options();
        // $options->set('defaultFont', 'Courier');
        // $dompdf = new Dompdf($options);
        // $dompdf->loadHtml(view('tiquetera.pruebaPdf'));
        // $dompdf->setPaper('A4', 'landscape');
        // $dompdf->render();
        // $dompdf->stream();
        // return $dompdf->stream('archivo.pdf');



        $data = [
            'title' => 'Mi primer PDF generado en Laravel',
            'content' => 'Contenido del PDF'
        ];


        $pdf = Pdf::loadView('tiquetera.pruebaPdf', $data);
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->stream('archivo.pdf');
    }


    public function pruebaView()
    {

        return view('tiquetera.pruebaPdf');
    }
}
