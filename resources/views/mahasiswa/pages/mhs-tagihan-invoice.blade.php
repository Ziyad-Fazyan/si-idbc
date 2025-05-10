<!DOCTYPE html>
<html lang='en' class=''>

<head>
    <meta charset='UTF-8'>
    <title>Invoice - ESEC Academy</title>
    <meta name="robots" content="noindex">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                background: white;
            }

            .page-break {
                page-break-after: always;
            }

            .no-print {
                display: none;
            }
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #F3EFEA;
        }
    </style>
</head>

<body class="p-4 md:p-8 print:p-0">
    <!-- Print Button (hidden when printing) -->
    <button onclick="window.print()"
        class="no-print fixed top-4 right-4 bg-[#FF6B35] hover:bg-orange-600 text-white px-4 py-2 rounded-md shadow-md transition-colors">
        Print Invoice
    </button>

    <!-- Invoice Container -->
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden print:shadow-none print:rounded-none">
        <!-- Header Section -->
        <div class="p-6 md:p-8 print:p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div class="mb-6 md:mb-0">
                    <h2 class="text-2xl font-bold text-[#0C6E71]">ESEC Academy</h2>
                    <p class="text-[#3B3B3B] italic">Jakarta, Indonesia</p>
                    <p class="text-[#3B3B3B]">Jl. Ciremai Raya No 240 Kota Jakarta Selatan</p>
                </div>

                <div class="flex justify-center mb-6 md:mb-0">
                    <img class="w-24 h-24 md:w-32 md:h-32 object-contain"
                        src="{{ asset('storage/images/web/site-logo.png') }}" alt="ESEC Academy Logo">
                </div>

                <div class="text-right">
                    <p class="text-[#3B3B3B]">Invoice #<span
                            class="uppercase font-medium">{{ $history->tagihan_code }}</span></p>
                    <p class="text-[#3B3B3B]">Issued: {{ \Carbon\Carbon::parse($history->created_at)->format('d M Y') }}
                    </p>
                    <span
                        class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">PAID</span>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="bg-[#0C6E71] text-white rounded-lg overflow-hidden mb-8">
                <div class="p-4 md:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-1">
                            <h3 class="font-semibold">Summary and Notes</h3>
                        </div>
                        <div class="md:col-span-2">
                            <p class="font-medium">{{ $history->tagihan->name }}</p>
                            <p>{{ $history->tagihan->desc }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="mb-8 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#E4E2DE]">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                No.</th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                Item</th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                Qty.</th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                Amount</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">1</td>
                            <td class="px-4 py-4 text-sm text-[#2E2E2E]">Pembayaran {{ $history->tagihan->name }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">1</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">Rp.
                                {{ number_format($history->tagihan->price, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Billing Info -->
                <div class="border-r border-[#E4E2DE] pr-4">
                    <h3 class="text-lg font-semibold text-[#0C6E71] mb-3">Invoiced to:</h3>
                    <p class="text-lg font-bold text-[#2E2E2E] mb-1">{{ $history->users->mhs_name }}</p>
                    <p class="text-sm text-[#3B3B3B]">
                        {{ $history->users->mhs_addr_kota == null ? 'Nama Kota' : $history->users->mhs_addr_kota }},
                        {{ $history->users->mhs_addr_provinsi == null ? 'Nama Provinsi' : $history->users->mhs_addr_provinsi }}
                    </p>
                    <p class="text-sm text-[#3B3B3B] mt-3">Thank you for your business. Please contact us if you have
                        any questions.</p>
                </div>

                <!-- Totals -->
                <div>
                    <table class="w-full">
                        <tbody>
                            <tr class="border-b border-[#E4E2DE]">
                                <td class="py-2 text-sm font-medium text-[#3B3B3B]">Subtotal</td>
                                <td class="py-2 text-right text-sm text-[#2E2E2E]">Rp.
                                    {{ number_format($history->tagihan->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="bg-[#E4E2DE]">
                                <td class="py-3 font-medium text-[#0C6E71]">Total</td>
                                <td class="py-3 text-right font-bold text-[#0C6E71]">Rp.
                                    {{ number_format($history->tagihan->price, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="text-sm text-red-500 mt-3">
                        Due date: {{ \Carbon\Carbon::parse($history->created_at)->addDays(3)->format('d M Y H:i:s') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="bg-[#F3EFEA] p-4 text-center text-sm text-[#3B3B3B]">
            ESEC Academy - SiakadPT By Internal Developer
        </div>
    </div>

    <script>
        // Print functionality
        function printInvoice() {
            window.print();
        }

        // Add any additional JavaScript interactions here
        document.addEventListener('DOMContentLoaded', function() {
            // You can add more interactive elements if needed
        });
    </script>
</body>

</html>
