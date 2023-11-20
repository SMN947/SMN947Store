<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de venta</title>
    @vite('resources/css/app.css')

    <style>
        #printButton {
            display: none;
        }
    </style>

    <script>
        function printInvoice() {
            window.print();
        }

        // Show the button when the page is fully loaded
        window.onload = function() {
            document.getElementById('printButton').style.display = 'block';
        };

        // Hide the button before printing
        window.onbeforeprint = function() {
            document.getElementById('printButton').style.display = 'none';
        };

        // Show the button after printing
        window.onafterprint = function() {
            document.getElementById('printButton').style.display = 'block';
        };
    </script>
</head>

<body class="container font-sans bg-gray-100 m-auto">

    <div class="mt-4 flex justify-center">
        <button id="printButton" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded cursor-pointer" onclick="printInvoice()">Imprimir</button>
    </div>
    <div id="invoice">
        <div class="flex justify-between p-4">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="100" height="100" class="mr-4">
                <div>
                    <p class="text-xl">Piñateria</p>
                    <p class="font-bold text-lg">Lunita De Papel</p>
                    <p class="font-bold text-base">NIT: 53070412-3</p>
                </div>
            </div>

            <div class="text-right flex justify-between">
                <div>
                    <p class="text-xl">Recibo N° {{ $receiptNumber }}</p>
                    <p>{{ $sale[0]->created_at }}</p>
                </div>
            </div>
        </div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Producto</th>
                    <th class="py-2 px-4 border-b">Cantidad</th>
                    <th class="py-2 px-4 border-b">Precio Unitario</th>
                    <th class="py-2 px-4 border-b">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saleDetails as $saleDetail)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $saleDetail->productName }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $saleDetail->amount }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $saleDetail->productSellPrice }}</td>
                    <td class="py-2 px-4 border-b">{{ $saleDetail->subTotal }}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="py-2 px-4 border-b font-bold text-center" colspan="3">Total</td>
                    <td class="py-2 px-4 border-b font-bold text-green-600">{{ $sale[0]->total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>