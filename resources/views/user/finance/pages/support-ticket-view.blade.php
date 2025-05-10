@extends('base.base-dash-index')
@section('title')
    Ticket Support - Siakad By Internal Developer
@endsection
@section('menu')
    Ticket Support
@endsection
@section('submenu')
    Lihat Ticket
@endsection
@section('urlmenu')
    {{ route($prefix . 'support.ticket-index') }}
@endsection
@section('subdesc')
    Halaman untuk melihat Ticket #{{ $ticket->code }}
@endsection
@section('content')
    <section class="p-4 space-y-4">
        <!-- Ticket Reply Form -->
        <form action="{{ route($prefix . 'support.ticket-store-reply', $ticket->code) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md overflow-hidden">
            @csrf
            <div class="border-b p-4 flex justify-between items-center bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-800">Reply to Ticket #{{ $ticket->code }}</h2>
                <a href="@yield('urlmenu')" class="flex items-center text-yellow-600 hover:text-yellow-800">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back
                </a>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Student Name -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
                    <input type="text" readonly value="{{ Auth::user()->name }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                </div>

                <!-- Department -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Departement</label>
                    <input type="text" readonly value="{{ $ticket->dept_id }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                </div>

                <!-- Priority Level -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Level Prioritas</label>
                    <input type="text" readonly value="{{ $ticket->prio_id }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                </div>

                <!-- Subject -->
                <div class="md:col-span-2 space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" readonly value="{{ $ticket->subject }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                </div>

                <!-- Status -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="stat_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="0" {{ $ticket->raw_stat_id === 0 ? 'selected' : '' }}>Open</option>
                        <option value="1" {{ $ticket->raw_stat_id === 1 ? 'selected' : '' }}>In Progress</option>
                        <option value="2" {{ $ticket->raw_stat_id === 2 ? 'selected' : '' }}>Closed</option>
                        <option value="3" {{ $ticket->raw_stat_id === 3 ? 'selected' : '' }}>Answered</option>
                        <option value="4" {{ $ticket->raw_stat_id === 4 ? 'selected' : '' }}>Student Reply</option>
                        <option value="5" {{ $ticket->raw_stat_id === 5 ? 'selected' : '' }}>On Hold</option>
                        <option value="6" {{ $ticket->raw_stat_id === 6 ? 'selected' : '' }}>Pending Student</option>
                    </select>
                    @error('stat_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div class="md:col-span-3 space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea name="message" id="summernote" class="w-full"></textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="md:col-span-3 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Send Ticket
                    </button>
                </div>
            </div>
        </form>

        <!-- Support Thread -->
        <div id="support-container" class="space-y-4">
            @foreach ($support as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4">
                        <div class="flex flex-col md:flex-row gap-4">
                            <!-- User Info -->
                            <div class="md:w-1/4 space-y-3">
                                <div class="flex items-start">
                                    @if ($item->users_id !== null)
                                        <img src="{{ asset('storage/images/' . $item->users->mhs_image) }}" 
                                             class="w-12 h-12 rounded-full mr-3 object-cover">
                                        <div>
                                            <p class="font-semibold">{{ $item->users->mhs_name }}</p>
                                            <p class="text-sm text-gray-500">{{ $item->created_at->diffForHumans() }}</p>
                                            <p class="text-sm">Kelas {{ $item->users->kelas->name }}</p>
                                        </div>
                                    @elseif ($item->admin_id !== null)
                                        <img src="{{ asset('storage/images/' . $item->admin->image) }}" 
                                             class="w-12 h-12 rounded-full mr-3 object-cover">
                                        <div>
                                            <p class="font-semibold">{{ $item->admin->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $item->created_at->diffForHumans() }}</p>
                                            <p class="text-sm">{{ $item->admin->type }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-blue-600 hover:text-blue-800">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>
                                    <button class="p-2 text-red-600 hover:text-red-800">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Message Content -->
                            <div class="md:w-3/4">
                                <div class="prose max-w-none">
                                    {!! $item->message !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Original Ticket -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- User Info -->
                    <div class="md:w-1/4">
                        <div class="flex items-start">
                            @if ($ticket->users_id !== null)
                                <img src="{{ asset('storage/images/' . $ticket->users->mhs_image) }}" 
                                     class="w-12 h-12 rounded-full mr-3 object-cover">
                                <div>
                                    <p class="font-semibold">{{ $ticket->users->mhs_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $ticket->created_at->diffForHumans() }}</p>
                                    <p class="text-sm">Kelas {{ $ticket->users->kelas->name }}</p>
                                </div>
                            @elseif ($ticket->admin_id !== null)
                                <img src="{{ asset('storage/images/' . $ticket->admin->image) }}" 
                                     class="w-12 h-12 rounded-full mr-3 object-cover">
                                <div>
                                    <p class="font-semibold">{{ $ticket->admin->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $ticket->created_at->diffForHumans() }}</p>
                                    <p class="text-sm">{{ $ticket->admin->type }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Message Content -->
                    <div class="md:w-3/4">
                        <div class="prose max-w-none">
                            {!! $ticket->message !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom-js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let autoRefreshTimer;
        const refreshInterval = 15000; // 15 seconds

        function startAutoRefresh() {
            autoRefreshTimer = setInterval(() => {
                location.reload();
            }, refreshInterval);
        }

        function stopAutoRefresh() {
            if (autoRefreshTimer) {
                clearInterval(autoRefreshTimer);
            }
        }

        // Initialize auto-refresh
        startAutoRefresh();

        // Handle Summernote events
        const summernote = $('#summernote');
        summernote.on('summernote.keyup', stopAutoRefresh);
        summernote.on('summernote.blur', startAutoRefresh);

        // Pause refresh when tab is inactive
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                stopAutoRefresh();
            } else {
                startAutoRefresh();
            }
        });
    });
</script>
@endsection