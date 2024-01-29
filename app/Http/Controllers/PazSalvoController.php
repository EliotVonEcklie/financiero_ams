<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class PazSalvoController extends Controller
{
    public function show()
    {
        $data = ['title' => 'domPDF in Laravel 10'];
        $pdf = PDF::loadView('pdf.paz_y_salvo', $data);
        return $pdf->stream('pazysalvo.pdf');
    }
}
