<?php

namespace App\Http\Controllers;

use App\Exports\ExportUser;
use App\Models\User;
//use Barryvdh\DomPDF\PDF;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PDFController extends Controller
{
    public function users_pdf(){
        $users = User::getTeacher(Auth::user()->id, Auth::user()->is_admin);

        $data = [
            'title'=>'Users pdf',
            'date'=>date('d-m-y'),
            'users'=>$users
        ];

       // $pdf = app('dompdf.wrapper'); // Crée une instance de PDF
        $pdf = PDF::loadView('users', $data);

        return $pdf->download('myUsers.pdf');
    }

    public function users_excel(){
        return Excel::download(new ExportUser, 'myUsers.xlsx');
    }
}
