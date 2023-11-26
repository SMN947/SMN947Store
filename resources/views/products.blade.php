@extends('skeleton')

@section('content')
<form action="/products" method="POST">
    <div class="container m-auto my-4">
        <x-layout.card>

            <x-layout.card.header>
                Creacion de Producto
            </x-layout.card.header>
            <x-layout.card.body>
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 my-4">
                    @foreach ($newProductFormFields as $formField)
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">{{$formField->label}}</span>
                        </label>
                        @if ($formField->type == 'text' || $formField->type == 'number')
                        <input type="{{$formField->type}}" name="{{$formField->name}}" class="input input-bordered w-full max-w-xs" />
                        @elseif ($formField->type == 'select')
                        <select name="{{$formField->name}}" class="select select-bordered">
                            <option disabled selected class="hidden"></option>
                            @foreach ($formField->options as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->categoryName }}
                            </option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                    @endforeach
                </div>
            </x-layout.card.body>
            <x-layout.card.footer>
                <button class="btn btn-success">Crear producto</button>
            </x-layout.card.footer>
        </x-layout.card>
</form>

<!-- INICIO LISTA PRODUCTOS -->
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
                        <th>Nombre</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Ganancia</th>
                        <th>Unidad</th>
                        <th>Disponible</th>
                        <th>Nivel minimo</th>
                        <th>Descripcion</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr class="hover:bg-base-300">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->productName }}</td>
                        <td>${{ $product->productBuyPrice }}</td>
                        <td>${{ $product->productSellPrice }}</td>
                        <td>${{ $product->productSellPrice -  $product->productBuyPrice }}</td>
                        <td>{{ $product->productUnit }}</td>
                        <td>{{ $product->productStock }}</td>
                        <td>{{ $product->productMinStock }}</td>
                        <td>{{ $product->productDescription }}</td>
                        <td>
                            <a class="btn btn-error btn-sm" onclick="modalDelete{{$product->id }}.showModal()">Eliminar</a>
                        </td>
                        <td>
                            <a class="btn btn-warning btn-sm" onclick="modalEdit{{$product->id }}.showModal()">Editar</a>
                        </td>
                    </tr>
                    <!-- START DELETE MODAL -->
                    <dialog id="modalDelete{{ $product->id }}" class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <h3 class="font-bold text-lg">Eliminar Producto</h3>
                            <p class="py-4">
                                ¿Está seguro que desea eliminar el producto
                                <strong>{{ $product->productName }}</strong>?
                            </p>
                            <div class="modal-action">
                                <button type="button" class="btn btn-secondary" onclick="modalDelete{{$product->id }}.close()">
                                    No, cancelar
                                </button>
                                <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        Sí, eliminar producto
                                    </button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <!-- END DELETE MODAL -->
                    <!-- START EDIT MODAL -->
                    <dialog id="modalEdit{{ $product->id }}" class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
                                @method('PUT')
                                @csrf

                                <h3 class="font-bold text-lg">Editar Producto</h3>
                                <p class="py-4">

                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Nombre del producto</span>
                                    </label>
                                    <input type="text" id="editProductName" name="productName" value="{{ $product->productName }}" class="input input-bordered w-full max-w-xs" />
                                </div>
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Categoría</span>
                                    </label>
                                    <select class="select select-bordered" id="editCategoryId" name="category_id" required>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->categoryName }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Precio de Compra</span>
                                    </label>
                                    <input type="text" class="input input-bordered w-full max-w-xs" id="editProductBuyPrice" name="productBuyPrice" value="{{ $product->productBuyPrice }}" required>
                                </div>
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Precio de Venta</span>
                                    </label>
                                    <input type="text" class="input input-bordered w-full max-w-xs" id="editProductSellPrice" name="productSellPrice" value="{{ $product->productSellPrice }}" required>
                                </div>
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Unidad (Kg, lb, unidad, pliego, etc)</span>
                                    </label>
                                    <input type="text" class="input input-bordered w-full max-w-xs" id="editProductUnit" name="productUnit" value="{{ $product->productUnit }}" required>
                                </div>
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Cantidad disponible</span>
                                    </label>
                                    <input type="text" class="input input-bordered w-full max-w-xs" id="editProductStock" name="productStock" value="{{ $product->productStock }}" required>
                                </div>
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Cantidad mínima para alertar</span>
                                    </label>
                                    <input type="text" class="input input-bordered w-full max-w-xs" id="editProductMinStock" name="productMinStock" value="{{ $product->productMinStock }}" required>
                                </div>
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Descripción</span>
                                    </label>
                                    <input type="text" class="input input-bordered w-full max-w-xs" id="editProductDescription" name="productDescription" value="{{ $product->productDescription }}">
                                </div>
                                </p>
                                <div class="modal-action">
                                    <button type="button" class="btn btn-secondary" onclick="modalEdit{{$product->id }}.close()">
                                        No, cancelar
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        Guardar cambios
                                    </button>
                                </div>
                            </form>
                        </div>
                    </dialog>
                    <!-- END EDIT MODAL -->
                    @endforeach
                </tbody>
            </table>
        </x-layout.card.body>
    </x-layout.card>
</div>
<!-- FIN LISTA PRODUCTOS -->
</div>
@endsection