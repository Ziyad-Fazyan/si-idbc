@extends('base.base-dash-index')
@section('title')
    Data Tagihan Perkuliahan - Siakad By Internal Developer
@endsection
@section('menu')
    Data Tagihan Perkuliahan
@endsection
@section('submenu')
    Lihat Tagihan {{ $tagihan->code }}
@endsection
@section('urlmenu')
@endsection
@section('subdesc')
    Halaman untuk melihat Tagihan {{ $tagihan->code }}
@endsection
@section('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endsection
@section('content')
    <section class="min-h-screen bg-[#F3EFEA] py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-[#0C6E71] px-6 py-4 border-b border-[#E4E2DE]">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white">
                        @yield('menu')
                    </h2>
                    <a href="{{ route('mahasiswa.home-tagihan-index') }}"
                        class="text-[#FF6B35] hover:text-orange-400 transition-colors duration-200">
                        <i class="fa-solid fa-backward text-xl"></i>
                    </a>
                </div>
            </div>

            <div class="p-6 sm:p-8">
                <form id="payment-form" action="{{ route('mahasiswa.home-tagihan-payment', $tagihan->code) }}"
                    method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-medium text-[#2E2E2E]">Name</label>
                        <input type="text"
                            class="w-full px-4 py-2 border border-[#E4E2DE] rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                            id="name" readonly value="{{ Auth::guard('mahasiswa')->user()->mhs_name }}" name="name">
                    </div>

                    <div class="space-y-1">
                        <label for="email" class="block text-sm font-medium text-[#2E2E2E]">Email</label>
                        <input type="email"
                            class="w-full px-4 py-2 border border-[#E4E2DE] rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                            id="email" readonly value="{{ Auth::guard('mahasiswa')->user()->mhs_mail }}" name="email">
                    </div>

                    <div class="space-y-1">
                        <label for="amount" class="block text-sm font-medium text-[#2E2E2E]">Amount</label>
                        <input type="number"
                            class="w-full px-4 py-2 border border-[#E4E2DE] rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                            id="amount" readonly value="{{ $tagihan->price }}" name="amount">
                    </div>

                    <div class="space-y-1">
                        <label for="note" class="block text-sm font-medium text-[#2E2E2E]">Note</label>
                        <textarea
                            class="w-full px-4 py-2 border border-[#E4E2DE] rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent min-h-[100px]"
                            id="note" name="note">Pembayaran Tagihan Kuliah {{ $tagihan->code }}</textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" id="pay-button"
                            class="w-full bg-[#FF6B35] hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#FF6B35] focus:ring-offset-2">
                            Pay Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('payment-form');

        form.addEventListener('submit', function(e) {
            const button = document.getElementById('pay-button');
            button.disabled = true;
            button.innerHTML = 'Processing...';

            // You can add additional payment processing logic here
            // For example, integrating with Midtrans or other payment gateway

            // form.submit(); // Uncomment this if you want to auto-submit after processing
        });

        // Add focus styles for better accessibility
        const inputs = form.querySelectorAll('input, textarea, button');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-[#0C6E71]', 'rounded-md');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-[#0C6E71]', 'rounded-md');
            });
        });
    });
</script>
@section('custom-js')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        var snapToken = ""; // Inisialisasi snapToken

        // Fungsi untuk melakukan permintaan pembayaran
        $('#pay-button').click(function(event) {
            event.preventDefault();

            $.post("{{ route('mahasiswa.home-tagihan-payment', $tagihan->code) }}", {
                    _token: '{{ csrf_token() }}',
                    name: $('#name').val(),
                    email: $('#email').val(),
                    amount: $('#amount').val(),
                    note: $('#note').val()
                },
                function(data, status) {

                    snapToken = data.snap_token; // Simpan snapToken dari respons server
                    uniqCode = data.code_uniq; // Simpan snapToken dari respons server
                    // $('#snap-token').val(snapToken);

                    console.log(data.snap_token); // Tambahkan ini untuk debugging
                    // var snapToken = document.getElementById('snap-token').value;
                    snap.pay(snapToken, {
                        onSuccess: function(result) {
                            // location.reload();
                            window.location.href =
                                "{{ route('mahasiswa.home-tagihan-payment-success', ':uniqCode') }}"
                                .replace(':uniqCode', uniqCode);

                        },

                        onPending: function(result) {
                            location.reload();
                        },

                        onError: function(result) {
                            // window.location.href = "{{ route('mahasiswa.home-tagihan-payment-success', ':uniqCode') }}".replace(':uniqCode', uniqCode);

                            location.reload();
                        }
                    });
                });
        });
    </script>
@endsection
