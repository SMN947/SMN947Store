@extends('skeleton')

@section('content')

<div class="container m-auto">
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 my-4">
        <x-layout.card>
            <x-layout.card.body>
                <h1 class="text-lg font-bold">Tiendas Activas</h1>
                <p class="">+100</p>
            </x-layout.card.body>
        </x-layout.card>
        <x-layout.card>
            <x-layout.card.body>
                <h1 class="text-lg font-bold">Ventas</h1>
                <p class="">+2000</p>
            </x-layout.card.body>
        </x-layout.card>
        <x-layout.card>
            <x-layout.card.body>
                <h1 class="text-lg font-bold">Productos</h1>
                <p class="">+5000</p>
            </x-layout.card.body>
        </x-layout.card>
        <x-layout.card>
            <x-layout.card.body>
                <h1 class="text-lg font-bold">Clientes</h1>
                <p class="">+1000</p>
            </x-layout.card.body>
        </x-layout.card>
    </div>


    <x-layout.card>
        <x-layout.card.header>
            Que es {{ config('app.name') }}?
        </x-layout.card.header>
        <x-layout.card.body>
            <p>
                Es un sistema que busca facilitar el control que se tiene sobre
                puntos de venta, permitiendo unafacil administracion de:
            </p>
            <div class="pl-10">
                <ul class="list-disc">
                    <li>Inventario</li>
                    <li>Pedidos a proveedores</li>
                    <li>Ventas</li>
                    <li>Ganancias</li>
                    <li>Fidelizaion de clientes</li>
                    <li>Generacion de facturas</li>
                </ul>
            </div>
        </x-layout.card.body>
    </x-layout.card>
</div>
@endsection