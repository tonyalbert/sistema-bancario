<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>User {{ $myUser->id }}</h1>
                    <h1>Saldo: R$ {{ $saldo }}</h1>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="/transacao" method="post">
                        @csrf
                        <label for="valor">valor</label>
                        <input type="text" name="valor" required>
                        <label for="descricao">Descrição</label>
                        <input type="text" name="descricao" required>
                        <label for="conta_destino_id">Conta de destino</label>
                        <input type="text" name="conta_destino_id" required>
                        <input type="submit" value="enviar">
                        
                    </form>

                    <ul class="mt-3">
                        @foreach ($transacoes as $transacoes)
                            <li>Enviou R${{ $transacoes->valor }} para o usuário de id {{ $transacoes->receiver_id }}</li>    
                        @endforeach
                    </ul>
                    <hr>
                    <ul class="mt-3">
                        @foreach ($recebimentos as $recebimentos)
                            <li>Recebeu R${{ $recebimentos->valor }} do usuário de id {{ $recebimentos->user_id }}</li>    
                        @endforeach
                    </ul>
                    <ul class="mt-3">
                        @foreach ($users as $user)
                            <li>{{ $user->id }}: {{ $user->name }} tem R$ {{ $user->saldo }} </li>    
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
