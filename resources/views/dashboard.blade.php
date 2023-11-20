@extends('skeleton')
@section('scripts')

<script>
    $(document).ready(function() {
        $('#inventory').DataTable();
        $('#salesResume').DataTable();
        $('#topSell').DataTable();
    });
</script>
@endsection
@section('content')
<div class="container m-auto">
    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 my-4">
        <div></div>
        <form action="{{ route('dashboard.index') }}" method="GET" class="col-span-3">
            <div class="join grid grid-cols-5 gap-4">
                <div class="form-control w-full max-w-xs col-span-2">
                    <label class="label">
                        <span class="label-text">Fecha de Inicio</span>
                    </label>
                    <input type="date" id="start_date" name="start_date" class="input input-bordered w-full max-w-xs" value="{{ $startDate->format('Y-m-d') }}" />
                </div>
                <div class="form-control w-full max-w-xs  col-span-2">
                    <label class="label">
                        <span class="label-text">Fecha de Fin</span>
                    </label>
                    <input type="date" id="end_date" name="end_date" class="input input-bordered w-full max-w-xs" value="{{ $endDate->format('Y-m-d') }}" />
                </div>
                <div class="mt-auto mx-2 w-full max-w-xs  col-span-1">
                    <button class="btn btn-outline w-full">Filtrar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 my-4">
        <x-layout.card>
            <x-layout.card.body>
                <h1 class="text-lg font-bold">Ganancias Mes</h1>
                <p class="">$xx.xxx.xxx</p>
            </x-layout.card.body>
        </x-layout.card>
        <x-layout.card>
            <x-layout.card.body>
                <h1 class="text-lg font-bold">Ganancias Semana</h1>
                <p class="">$xx.xxx.xxx</p>
            </x-layout.card.body>
        </x-layout.card>
        <x-layout.card>
            <x-layout.card.body>
                <h1 class="text-lg font-bold">Ventas</h1>
                <p class="">xxx</p>
            </x-layout.card.body>
        </x-layout.card>
    </div>
    <!-- INICIO RESUMEN DE VENTAS -->
    <div class="grid grid-cols-1 gap-4 my-4">
        <x-layout.card>
            <x-layout.card.header>
                Resumen de ventas
            </x-layout.card.header>
            <x-layout.card.body>
                <table class="table bg-base-100" id="salesResume">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Total</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                        <tr class="hover:bg-base-300">
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->total }}</td>
                            <td>{{ $sale->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-layout.card.body>
        </x-layout.card>
    </div>
    <!-- FIN RESUMEN DE VENTAS -->
    <!-- INICIO MAS VENDIDOS -->
    <div class="grid grid-cols-1 gap-4 my-4">
        <x-layout.card>
            <x-layout.card.header>
                Mas Vendidos
            </x-layout.card.header>
            <x-layout.card.body>
                <table class="table bg-base-100" id="topSell">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topSell as $product)
                        <tr>
                            <td>{{ $product->productName }}</td>
                            <td>{{ $product->amount }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-layout.card.body>
        </x-layout.card>
    </div>
    <!-- FIN MAS VENDIDOS -->
    <!-- INICIO INVENTARIO -->
    <div class="grid grid-cols-1 gap-4 my-4">
        <x-layout.card>
            <x-layout.card.header>
                Estado de inventario
            </x-layout.card.header>
            <x-layout.card.body>
                <table class="table bg-base-100" id="inventory">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Stock Actual</th>
                            <th>Minimo</th>
                            <th>Delta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stock as $product)
                        <tr class="bg-{{ $product->toMinStock <= 0 ? 'danger' : 'success' }}">
                            <td>{{ $product->productName }}</td>
                            <td>{{ $product->productStock }}</td>
                            <td>{{ $product->productMinStock }}</td>
                            <td>{{ $product->toMinStock }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-layout.card.body>
        </x-layout.card>
    </div>
    <!-- FIN INVENTARIO -->
</div>
@endsection