<?php

namespace App\Http\Controllers;

use App\Models\Transacao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransacaoController extends Controller
{
    
    public function CriarTransacao(Request $request)
    {
        $valor = $request->input('valor');
        $descricao = $request->input('descricao');
        $user_id = Auth::id();
        $conta_destino = $request->input('conta_destino_id');

        if ($user_id == $conta_destino) {
            return redirect()->route('dashboard')->with('error', 'Não é possivel transferir para si mesmo!');
        }

        $usuarioDestino = User::find($conta_destino);

        if (!$usuarioDestino) {
            return redirect()->route('dashboard')->with('error', 'Usuário não encontrado!');
        }

        $transacao = Transacao::create([
            'valor' => $valor,
            'descricao' => $descricao,
            'user_id' => $user_id,
            'receiver_id' => $conta_destino
        ]);

        // Atualiza o saldo do usuário de origem
        $usuarioOrigem = User::find($user_id);
        $usuarioOrigem->saldo -= $valor;
        $usuarioOrigem->save();

        // Atualiza o saldo do usuário de destino
        $usuarioDestino->saldo += $valor;
        $usuarioDestino->save();

        if ($transacao) {
            return redirect()->route('dashboard')->with('success', 'Transação enviada com sucesso!');
        } else {
            return redirect()->route('dashboard')->with('error', 'Erro ao criar transação');
        }
    }

    public function getTransacoes()
    {
        $user_id = Auth::id();
        
        $transacoes = Transacao::where('user_id', $user_id)->get();
        
        return $transacoes;
    }

    public function getRecebimentos()
    {
        $user_id = Auth::id();
        
        $recebimentos = Transacao::where('receiver_id', $user_id)->get();
        
        return $recebimentos;
    }
    
    public function getSaldo()
    {
        $user_id = Auth::id();
        
        $saldo = User::find($user_id)->saldo;
        
        return $saldo;
    }
    
    public function getUsers()
    {
        $users = User::all();
        
        return $users;
    }
}
