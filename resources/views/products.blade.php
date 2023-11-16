@extends('skeleton')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-12">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-default">Crear Producto</h6>
                </div>
                <div class="card-body">
                    <form action="/products" method="POST">
                        @csrf
                        <div class="" style="  display: grid;
                            grid-template-columns: repeat(3, 1fr);
                            grid-gap: 10px;">
                            <div class="p-1">
                                <label class="form-label">Nombre del producto</label>
                                <input type="text" name="productName" class="form-control">
                            </div>
                            <div class="p-1">
                                <label class="form-label">Categoria</label>
                                <select name="category_id" class="form-control">
                                    <option value="" selected disabled>Selecciona</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="p-1">
                                <label class="form-label">Precio de Compra</label>
                                <input type="text" name="productBuyPrice" class="form-control">
                            </div>
                            <div class="p-1">
                                <label class="form-label">Precio de Venta</label>
                                <input type="text" name="productSellPrice" class="form-control">
                            </div>
                            <div class="p-1">
                                <label class="form-label">Unidad (Kg, lb, unidad, pliego, etc)</label>
                                <input type="text" name="productUnit" class="form-control">
                            </div>
                            <div class="p-1">
                                <label class="form-label">Cantidad disponible</label>
                                <input type="text" name="productStock" class="form-control">
                            </div>
                            <div class="p-1">
                                <label class="form-label">Cantidad minima para alertar</label>
                                <input type="text" name="productMinStock" class="form-control">
                            </div>
                            <div class="p-1">
                                <label class="form-label">Descripcion</label>
                                <input type="text" name="productDescription" class="form-control">
                            </div>
                        </div>
                        <input class="btn btn-success float-right" type="submit" value="Crear">
                    </form>
                </div>


                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>

                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-12">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-default">Listado de productos</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
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
                            <tr>
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
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $product->id }}">Eliminar</button>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">Editar</button>
                                </td>
                            </tr>

                            <!-- MODAL -->
                            <div class="modal fade" id="modal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro que desea eliminar el producto
                                            <strong>{{ $product->productName }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, cancelar</button>
                                            <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Sí, eliminar
                                                    producto</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection