@extends('skeleton')
@section('scripts')

@endsection
@section('content')
<div class="container m-auto">
    <!-- INICIO INVENTARIO -->
    <div class="grid grid-cols-1 gap-4 my-4">
        <x-layout.card>
            <x-layout.card.header>
                Nuestros Productos
            </x-layout.card.header>
            <x-layout.card.body>
                <div class="grid grid-cols-3 gap-4 my-4">
                    @foreach ($stock as $product)
                    <div class="card bg-base-100 shadow-xl">
                        <x-layout.card.header>
                            {{ $product->productName }}
                        </x-layout.card.header>
                        <div class="card-body">
                            <p class="text-lg font-semibold">
                                ${{ $product->productSellPrice }}
                            </p>
                            <p class="mb-2 mt-2">
                                <b>Descripcion</b>
                                <br />
                                {{ $product->categoryName }}
                            </p>
                            <div class="card-actions">
                                <div class="badge badge-outline">{{ $product->categoryName }}</div>
                                <div class="badge badge-outline"> {{ $product->productStock }} disponibles</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </x-layout.card.body>
        </x-layout.card>
    </div>
    <!-- FIN INVENTARIO -->
</div>
@endsection