<!DOCTYPE html>
<html lang='en' class=''>
<head>
    <meta charset='UTF-8'>
    <title>Invoice - {{ $history->tagihan_code }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            body {
                background: white;
                -webkit-print-color-adjust: exact;
            }
            .print-shadow {
                box-shadow: none;
            }
            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>

<body class="bg-[#F3EFEA] text-[#2E2E2E] p-4 md:p-8 print:p-0">
    <div class="max-w-4xl mx-auto bg-white print-shadow rounded-lg shadow-md overflow-hidden print:shadow-none">
        <!-- Header Section -->
        <div class="bg-[#0C6E71] p-6 text-white">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold">Esec Academy</h1>
                    <p class="text-[#E4E2DE]">Jl. Ciremai Raya No 240 Kota Jakarta Selatan</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="font-medium">Invoice #{{ $history->tagihan_code }}</p>
                        <p class="text-sm text-[#E4E2DE]">Issued: {{ \Carbon\Carbon::parse($history->created_at)->format('d M Y H:i') }}</p>
                    </div>
                    <div class="bg-[#FF6B35] px-3 py-1 rounded-full text-sm font-bold">
                        PAID
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="p-6 border-b border-[#E4E2DE]">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3 mb-4 md:mb-0">
                    <h2 class="text-lg font-semibold text-[#0C6E71]">Summary</h2>
                </div>
                <div class="md:w-2/3">
                    <h3 class="font-medium">{{ $history->tagihan->name }}</h3>
                    <p class="text-gray-600">{{ $history->tagihan->desc }}</p>
                </div>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="p-6">
            <div class="flex flex-col md:flex-row">
                <!-- Customer Info -->
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-4">
                    <h3 class="text-lg font-semibold text-[#0C6E71] mb-3">Billed To</h3>
                    <div class="bg-[#F3EFEA] p-4 rounded-lg">
                        <h4 class="font-bold text-lg">{{ $history->users->mhs_name }}</h4>
                        <p class="text-gray-600">
                            {{ $history->users->mhs_addr_kota ?? 'Nama Kota' }}, 
                            {{ $history->users->mhs_addr_provinsi ?? 'Nama Provinsi' }}
                        </p>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="md:w-1/2 md:pl-4">
                    <h3 class="text-lg font-semibold text-[#0C6E71] mb-3">Payment Details</h3>
                    <div class="bg-[#F3EFEA] p-4 rounded-lg">
                        <div class="flex justify-between mb-1">
                            <span>Due Date:</span>
                            <span class="font-medium text-red-600">
                                {{ \Carbon\Carbon::parse($history->created_at)->addDays(3)->format('d M Y') }}
                            </span>
                        </div>
                        <div class="flex justify-between mb-1">
                            <span>Payment Method:</span>
                            <span class="font-medium">Bank Transfer</span>
                        </div>
                        <div class="flex justify-between font-bold mt-2 pt-2 border-t border-[#E4E2DE]">
                            <span>Total Amount:</span>
                            <span class="text-[#0C6E71]">
                                Rp. {{ number_format($history->tagihan->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="mt-8 overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-[#0C6E71] text-white">
                            <th class="py-3 px-4 text-left rounded-tl-lg">No.</th>
                            <th class="py-3 px-4 text-left">Item</th>
                            <th class="py-3 px-4 text-right">Qty</th>
                            <th class="py-3 px-4 text-right">Price</th>
                            <th class="py-3 px-4 text-right rounded-tr-lg">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-[#E4E2DE] hover:bg-gray-50">
                            <td class="py-3 px-4">1</td>
                            <td class="py-3 px-4 font-medium">Pembayaran {{ $history->tagihan->name }}</td>
                            <td class="py-3 px-4 text-right">1</td>
                            <td class="py-3 px-4 text-right">Rp. {{ number_format($history->tagihan->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-right">Rp. {{ number_format($history->tagihan->price, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Totals -->
            <div class="flex justify-end mt-4">
                <div class="w-full md:w-1/2">
                    <div class="flex justify-between py-2 border-b border-[#E4E2DE]">
                        <span class="font-medium">Subtotal:</span>
                        <span>Rp. {{ number_format($history->tagihan->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between py-2 font-bold text-lg">
                        <span>Total:</span>
                        <span class="text-[#0C6E71]">Rp. {{ number_format($history->tagihan->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-[#F3EFEA] p-6 text-center text-sm text-gray-500 rounded-b-lg">
            <p>Thank you for your business!</p>
            <p class="mt-1">* Taxes will be calculated using the default % value for your region</p>
            <button onclick="window.print()" class="mt-4 bg-[#FF6B35] hover:bg-[#E05D2E] text-white px-6 py-2 rounded-md transition-colors print:hidden">
                Print Invoice
            </button>
        </div>
    </div>

    <script>
        // Print functionality
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'p') {
                e.preventDefault();
                window.print();
            }
        });

        // Add more interactivity as needed
    </script>
</body>
</html>