@extends('skeleton')
@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#inventory').DataTable();
        $('#salesResumee').DataTable();
        $('#topSell').DataTable();
    });
</script>
@endsection
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
    </div>

    <form action="{{ route('dashboard.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col">
                <label for="start_date">Fecha de inicio:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $startDate->format('Y-m-d') }}">
            </div>
            <div class="col">
                <label for="end_date">Fecha de fin:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $endDate->format('Y-m-d') }}">
            </div>
            <div class="col">
                <br />
                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </div>
        </div>
    </form>


    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-start border-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Ganancias (Mensual)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-start border-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ganancia (Semanal)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- RESUMEN DE VENTAS -->
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Resumen de ventas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-bordered" id="salesResumee">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Total</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ $sale->total }}</td>
                                <td>{{ $sale->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <!-- MAS VENDIDOS -->
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Mas vendidos</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-bordered" id="topSell">
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
                </div>
            </div>
        </div>

        <!-- MAS VENDIDOS -->
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Estado de inventario</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-bordered" id="inventory">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection