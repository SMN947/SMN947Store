@extends('skeleton')

@section('content')
<div class="container m-auto my-4">
    <form action="/categories" method="POST">
        <x-layout.card>
            <x-layout.card.header>
                Creacion de Categoria
            </x-layout.card.header>
            <x-layout.card.body>
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 my-4">
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Nombre de la categoria</span>
                        </label>
                        <input type="text" name="categoryName" class="input input-bordered w-full max-w-xs" />

                    </div>
                </div>
            </x-layout.card.body>
            <x-layout.card.footer>
                <button class="btn btn-success">Crear Categoria</button>
            </x-layout.card.footer>
        </x-layout.card>
    </form>

    <div class="grid grid-cols-1 gap-4 my-4">
        <x-layout.card>
            <x-layout.card.header>
                Categorias
            </x-layout.card.header>
            <x-layout.card.body>
                <table class="table bg-base-100" id="salesResume">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categoria</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->categoryName }}</td>
                            <td>
                                <a class="btn btn-error btn-sm" onclick="modalDelete{{$category->id }}.showModal()">Eliminar</a>
                            </td>
                        </tr>

                        <!-- START DELETE MODAL -->
                        <dialog id="modalDelete{{ $category->id }}" class="modal modal-bottom sm:modal-middle">
                            <div class="modal-box">
                                <h3 class="font-bold text-lg">Eliminar Categoria</h3>
                                <p class="py-4">
                                    ¿Está seguro que desea eliminar la categoria
                                    <strong>{{ $category->categoryName }}</strong>?
                                </p>
                                <div class="modal-action">
                                    <button type="button" class="btn btn-secondary" onclick="modalDelete{{$category->id }}.close()">
                                        No, cancelar
                                    </button>
                                    <form action="{{ route('categories.destroy', ['category' => $category->id,'tenant'=>tenant('path')]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            Sí, eliminar categoria
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                        <!-- END DELETE MODAL -->
                        @endforeach
                    </tbody>
                </table>
            </x-layout.card.body>
            <x-layout.card.footer>
                <button class="btn btn-success">Crear Categoria</button>
            </x-layout.card.footer>
        </x-layout.card>
    </div>
</div>
@endsection