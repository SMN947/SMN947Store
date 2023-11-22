@extends('skeleton')

@section('content')

<!-- Open the modal using ID.showModal() method -->

<form action="/products" method="POST">
    <div class="container m-auto my-4">
        <x-layout.card>
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
                            <a class="btn btn-danger btn-sm" onclick="modalDelete{{$product->id }}.showModal()">Eliminar</a>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-target="#editModal{{ $product->id }}">Editar</button>
                        </td>
                    </tr>
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
                    <!-- Edit Modal Content -->
                    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="editProductName" class="form-label">Nombre del producto</label>
                                            <input type="text" class="form-control" id="editProductName" name="productName" value="{{ $product->productName }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editCategoryId" class="form-label">Categoría</label>
                                            <select class="form-control" id="editCategoryId" name="category_id" required>
                                                <option value="" selected disabled>Selecciona</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                    {{ $category->categoryName }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editProductBuyPrice" class="form-label">Precio de Compra</label>
                                            <input type="text" class="form-control" id="editProductBuyPrice" name="productBuyPrice" value="{{ $product->productBuyPrice }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editProductSellPrice" class="form-label">Precio de Venta</label>
                                            <input type="text" class="form-control" id="editProductSellPrice" name="productSellPrice" value="{{ $product->productSellPrice }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editProductUnit" class="form-label">Unidad (Kg, lb, unidad, pliego, etc)</label>
                                            <input type="text" class="form-control" id="editProductUnit" name="productUnit" value="{{ $product->productUnit }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editProductStock" class="form-label">Cantidad disponible</label>
                                            <input type="text" class="form-control" id="editProductStock" name="productStock" value="{{ $product->productStock }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editProductMinStock" class="form-label">Cantidad mínima para alertar</label>
                                            <input type="text" class="form-control" id="editProductMinStock" name="productMinStock" value="{{ $product->productMinStock }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editProductDescription" class="form-label">Descripción</label>
                                            <input type="text" class="form-control" id="editProductDescription" name="productDescription" value="{{ $product->productDescription }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </x-layout.card.body>
    </x-layout.card>
</div>
<!-- FIN LISTA PRODUCTOS -->
</div>
@endsection