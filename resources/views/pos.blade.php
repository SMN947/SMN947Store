@extends('skeleton')

@section('content')

<div class="container m-auto">
    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 my-4">
        <div></div>
        <div class="join col-span-3 grid grid-cols-5 gap-4">
            <div class="form-control w-full max-w-xs col-span-2">
                <label class="label">
                    <span class="label-text">Producto</span>
                </label>
                <select class="select select-bordered w-full max-w-xs" id="newProductProduct">
                    <option disabled selected class="hidden">Seleccione</option>
                    @foreach ($products as $product)
                    <option value="{{ $product }}">
                        {{ $product->productName }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-control w-full max-w-xs  col-span-2">
                <label class="label">
                    <span class="label-text">Cantidad</span>
                </label>
                <input type="number" id="newProductAmount" class="input input-bordered w-full max-w-xs" value="" placeholder="0" />
            </div>
            <div class="mt-auto mx-2 w-full max-w-xs col-span-1">
                <button class="btn btn-outline w-full" id="addElement">Añadir</button>
            </div>
        </div>
    </div>
    <!-- INICIO VENTA -->
    <div class="grid grid-cols-1 gap-4 my-4">
        <x-layout.card>
            <x-layout.card.header>
                Nueva venta
            </x-layout.card.header>
            <x-layout.card.body>
                <table class="table bg-base-100" id="Venta">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>SubTotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tableCart"></tbody>
                </table>
                <div id="invoice" class="flex p-4 m-1">
                    <div class="w-full">
                        <div class="flex">
                        </div>
                        <div class="flex">
                            <div class="w-8/12"></div>
                            <div class="w-4/12">
                                <table class="table bg-base-100 table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Total</td>
                                            <td><span id="totalCart"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Recibido</td>
                                            <td>
                                                <input class="input input-bordered w-full max-w-ws" type="number" id="paymentByUser" placeholder="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cambio</td>
                                            <td>
                                                <span id="clientCambio"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </x-layout.card.body>
            <x-layout.card.footer>
                <button id="closeSell" class="btn btn-success">Cerrar Venta</button>
            </x-layout.card.footer>
        </x-layout.card>
    </div>
</div>
</div>
@endsection


@section('scripts')
<script>
    var _token = "{{ csrf_token() }}"
    var dataCart = []
    var tableCart = $('#tableCart');
    var totalCart = $('#totalCart');
    var paymentByUser = $('#paymentByUser');
    var clientCambio = $('#clientCambio');
    var tableCartHtml = '';

    var datosVenta = {
        total: 0,
        pago: 0,
        vueltas: -1
    }

    function resetCart() {
        paymentByUser.val('0')
        $("#newProductAmount").val('');
        dataCart = [];
        datosVenta = {
            total: 0,
            pago: 0,
            vueltas: -1
        }
        renderCart();
        calculatePayment();
    }

    $(document).ready(function() {
        $("#addElement").on("click", addToCart);
        $("#paymentByUser").on("keyup", calculatePayment);
        $("#closeSell").on("click", saveVenta);
        closeSell
    });

    function addToCart() {
        // TODO: consultar inventario al seleccionar el producto
        var producto = $("#newProductProduct").val();
        var cantidad = $("#newProductAmount").val();
        producto = JSON.parse(producto);

        var existingProductIndex = dataCart.findIndex(item => item.productId === producto.id);
        if (existingProductIndex !== -1) {
            var totalAmount = dataCart[existingProductIndex].amount + parseInt(cantidad);

            if (totalAmount > producto.productStock) {
                alert(`No se puede vender ya que solo quedan ${producto.productStock} disponibles`);
                return;
            }
            dataCart[existingProductIndex].amount = totalAmount;
            dataCart[existingProductIndex].subTotal += producto.productSellPrice * parseInt(cantidad);
        } else {
            if (parseInt(cantidad) > producto.productStock) {
                alert(`No se puede vender ya que solo quedan ${producto.productStock} disponibles`);
                return;
            }
            dataCart.push({
                productId: producto.id,
                producto: producto.productName,
                amount: parseInt(cantidad),
                productSellPrice: producto.productSellPrice,
                productBuyPrice: producto.productBuyPrice,
                subTotal: producto.productSellPrice * parseInt(cantidad),
            });
        }
        renderCart();
    }

    function renderCart() {
        tableCartHtml = ''
        datosVenta.total = 0;
        dataCart.map((product, index) => {
            datosVenta.total += product.subTotal;
            tableCartHtml += `<tr>
                    <td>${++index}</td>
                    <td>${product.producto}</td>
                    <td>${product.amount}</td>
                    <td>${product.productSellPrice}</td>
                    <td>${product.subTotal}</td>
                    <td onclick="removeItem(${index})"><i class="fa fa-trash text-danger"></i></td>
                </tr>`
        });
        calculatePayment();
        tableCart.html(tableCartHtml)
        totalCart.html(`$${datosVenta.total}`)

    }

    function removeItem(itemId) {
        dataCart.splice(itemId - 1, 1);
        renderCart()
    }

    function calculatePayment() {
        let pagoPorUser = paymentByUser.val();
        datosVenta.vueltas = pagoPorUser - datosVenta.total;
        clientCambio.html(datosVenta.vueltas);
        if (datosVenta.vueltas < 0) {
            clientCambio.addClass("text-danger").removeClass("text-success")
        } else {
            clientCambio.removeClass("text-danger").addClass("text-success")
        }
    }

    function showInvoice(id) {
        window.open(`/{{tenant('path')}}/invoice/${id}`, '_blank');
    }

    function saveVenta() {
        if (datosVenta.total > 0 && datosVenta.vueltas >= 0) {
            $.ajax({
                method: "POST",
                url: "/{{tenant('path')}}/pos",
                data: {
                    _token: _token,
                    cartProducts: dataCart,
                    total: datosVenta.total
                }
            }).done(function(msg) {
                if (msg.error == 0) {
                    alert(msg.message);
                } else {
                    alert(msg.message);
                }
                showInvoice(msg.idVenta);
                setTimeout(() => {
                    resetCart();
                }, 2000);
            });
        } else {
            alert("Venta vacia")
        }
    }
    renderCart();
</script>
@endsection