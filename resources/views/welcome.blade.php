@extends('skeleton')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start border-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-default text-uppercase mb-1">
                                    Tiendas Activas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">+100</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start border-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-default text-uppercase mb-1">
                                    Ventas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">+2000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start border-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-default text-uppercase mb-1">
                                    Productos Vendidos
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            +5000
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-start border-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-default text-uppercase mb-1">
                                    Facturas Generadas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">+2000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
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
                        <h6 class="m-0 font-weight-bold text-default">Que es {{ config('app.name') }}?</h6>
                    </div>
                    <div class="card-body">
                        <p>Es un sistema que busca facilitar el control que se tiene sobre puntos de venta, permitiendo una
                            facil administracion de:
                        </p>

                        <p>
                        <ul>
                            <li>Inventario</li>
                            <li>Pedidos a proveedores</li>
                            <li>Ventas</li>
                            <li>Ganancias</li>
                            <li>Fidelizaion de clientes</li>
                            <li>Generacion de facturas</li>
                        </ul>
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
