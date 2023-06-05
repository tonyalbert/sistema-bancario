<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TransacaoController;
use Illuminate\Support\Facades\Auth;


class SiteController extends Controller
{
    public function home()
    {
        $myUser = Auth::user();
        
        $transacaoController = new TransacaoController();
        $transacoes = $transacaoController->getTransacoes();
        $saldo = $transacaoController->getSaldo();
        $recebimentos = $transacaoController->getRecebimentos();
        $users = $transacaoController->getUsers();

        return view('dashboard', compact('transacoes', 'saldo', 'recebimentos', 'myUser', 'users'));
    }
}
