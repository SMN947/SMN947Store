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
                        <h6 class="m-0 font-weight-bold text-default">Crear Categoria</h6>
                    </div>
                    <div class="card-body">
                        <form action="/categories" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre de la categoria</label>
                                        <input type="text" name="categoryName" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <input class="btn btn-success float-right" type="submit" value="Crear">
                        </form>
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
                        <h6 class="m-0 font-weight-bold text-default">Listado de Categorias</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>

                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->categoryName }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modal{{ $category->id }}">Eliminar</button>
                                        </td>
                                    </tr>

                                    <!-- MODAL -->
                                    <div class="modal fade" id="modal{{ $category->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Al eliminar la categoría
                                                        <strong>{{ $category->categoryName }}</strong>
                                                        se eliminan todas las tareas asignadas a la misma.
                                                    </p>
                                                    ¿Está seguro que desea eliminar la categoría
                                                    <strong>{{ $category->categoryName }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No, cancelar</button>
                                                    <form
                                                        action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Sí, eliminar
                                                            categoría</button>
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
