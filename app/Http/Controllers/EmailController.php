<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function index(){
        return view('mail.index');
    }

    public function send(Request $request){
        $texto = $request->texto;
        $assunto = $request->assunto;
        $destinatario = $request->destinatario;

        $result = Mail::send('mail.teste', ['texto' => $texto], function($m) use ($destinatario, $assunto){

            $nomeEmail = env('MAIL_FROM_NAME');
            $m->from(env('MAIL_USERNAME'), $nomeEmail);
            $m->subject($assunto);
            $m->to($destinatario);
        });

        dd($result);
    }
}
