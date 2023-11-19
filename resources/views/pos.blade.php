@extends('skeleton')

@section('content')
<div class="container mx-auto">

    <!-- Content Row -->
    <div class="flex">

        <!-- Content Column -->
        <div class="w-full">

            <!-- Project Card Example -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-bold text-default">Nueva Venta</h6>
                </div>
                <div class="card-body">
                    <div class="flex">
                        <div class="md:w-2/12 sm:w-full"></div>
                        <div class="md:w-8/12 sm:w-full m-1">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control" id="newProductProduct">
                                                @foreach ($products as $product)
                                                <option value="{{ $product }}">
                                                    {{ $product->productName }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" id="newProductAmount">
                                        </td>
                                        <td>
                                            <button class="btn btn-success" id="addElement">Añadir</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="invoice" class="flex p-4 m-1">
                        <div class="w-full">
                            <div class="flex">
                                <table class="table table-bordered table-striped" id="Venta">
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
                            </div>
                            <div class="flex">
                                <div class="w-8/12"></div>
                                <div class="w-4/12">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Total</td>
                                                <td><span id="totalCart"></span></td>
                                            </tr>
                                            <tr>
                                                <td>Recibido</td>
                                                <td>
                                                    <input class="form-control" type="number" id="paymentByUser">
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
                </div>

                <div class="card-footer">
                    <button id="closeSell" class="btn btn-success ml-0">Cerrar Venta</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
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
            window.open(`/invoice/${id}`, '_blank');
            // const invoice = this.document.getElementById("invoice");
            // var opt = {
            //     margin: 0.5,
            //     filename: 'myfile.pdf',
            //     image: {
            //         type: 'jpeg',
            //         quality: 0.98
            //     },
            //     html2canvas: {
            //         scale: 2
            //     },
            //     jsPDF: {
            //         unit: 'mm',
            //         format: 'a4',
            //         orientation: 'portrait'
            //     }
            // };

            // html2pdf().from(invoice).set(opt).toPdf().get('pdf').then(function(pdfObj) {
            //     pdfObj.autoPrint();
            //     window.open(pdfObj.output('bloburl'), '_blank');
            // });
        }

        function saveVenta() {
            if (datosVenta.total > 0 && datosVenta.vueltas >= 0) {
                $.ajax({
                    method: "POST",
                    url: "/pos",
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