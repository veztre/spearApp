<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


use Illuminate\Http\Request;

class PDFController extends Controller
{

    public function generatePDF(){
    $data = [
        'title' => 'Welcome to ItSolutionStuff.com',
        'date' => date('m/d/Y')
    ];
    $pdf = PDF::loadView('PDF/myPDF', $data);
  
    return $pdf->download('itsolutionstuff.pdf');

   }

    public function activityPDF()
    {
        $data = [
           'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')

        ];
        $pdf = PDF::loadView('PDF/myPDF', $data);
        //  $pdf->getDomPDF()->setProtocol($_SERVER['DOCUMENT_ROOT']);
        return $pdf->download('activity.pdf');
    }

}
