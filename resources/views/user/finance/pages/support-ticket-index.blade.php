@extends('base.base-dash-index')
@section('title')
    Ticket Support - Siakad By Internal Developer
@endsection
@section('menu')
    Ticket Support
@endsection
@section('submenu')
    Lihat Daftar Ticket Support
@endsection
@section('urlmenu')
@endsection
@section('subdesc')
    Halaman untuk melihat daftar ticket support
@endsection
@section('content')
    <section class="p-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="border-b p-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">@yield('menu')</h2>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Prioritas</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Departement</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[45%]">Subject</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Last Reply</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($ticket as $key => $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-4 whitespace-nowrap text-center">{{ ++$key }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                @if ($item->raw_prio_id === 0)
                                    <span class="text-[#0C6E71]">{{ $item->prio_id }}</span>
                                @elseif ($item->raw_prio_id === 1)
                                    <span class="text-[#FF6B35]">{{ $item->prio_id }}</span>
                                @elseif ($item->raw_prio_id === 2)
                                    <span class="text-red-500">{{ $item->prio_id }}</span>
                                @elseif ($item->raw_prio_id === 3)
                                    <span class="text-red-600 font-bold">{{ $item->prio_id }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">{{ $item->dept_id }}</td>
                            <td class="px-4 py-4 w-[45%]">
                                <a href="{{ route($prefix . 'support.ticket-view', $item->code) }}" 
                                   class="text-[#0C6E71] hover:text-[#0C6E71] hover:underline">
                                    #{{ $item->code }} - {{ $item->subject }}
                                </a>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                @if ($item->raw_stat_id === 0)
                                    <span class="text-green-600 font-bold">{{ $item->stat_id }}</span>
                                @elseif ($item->raw_stat_id === 1)
                                    <span class="text-red-600 font-bold">{{ $item->stat_id }}</span>
                                @elseif ($item->raw_stat_id === 2)
                                    <span class="text-gray-400 font-bold">{{ $item->stat_id }}</span>
                                @elseif ($item->raw_stat_id === 3)
                                    <span class="text-green-600 font-bold">{{ $item->stat_id }}</span>
                                @elseif ($item->raw_stat_id === 4)
                                    <span class="text-[#0C6E71] font-bold">{{ $item->stat_id }}</span>
                                @elseif ($item->raw_stat_id === 5)
                                    <span class="text-[#FF6B35] font-bold">{{ $item->stat_id }}</span>
                                @elseif ($item->raw_stat_id === 6)
                                    <span class="text-yellow-500 font-bold">{{ $item->stat_id }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">{{ $item->updated_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal Edit -->
    <div x-data="{ open: false }">
        @foreach ($ticket as $item)
            <div x-show="open" x-cloak class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-lg font-semibold text-[#0C6E71]">Edit Ticket #{{ $item->code }}</h2>
                    <form method="POST" action="{{ route($prefix . 'support.ticket-edit', $item->code) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mt-4">
                            <label for="subject" class="block text-gray-700">Subject</label>
                            <input type="text" id="subject" name="subject" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded" value="{{ $item->subject }}">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <button type="button" @click="open = false" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                            <button type="submit" class="bg-[#0C6E71] text-white px-4 py-2 rounded">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('custom-js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalTriggers = document.querySelectorAll('[data-modal-target]');
        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', function() {
                document.querySelector(this.getAttribute('data-modal-target')).classList.remove('hidden');
            });
        });

        const modalClose = document.querySelectorAll('[data-modal-close]');
        modalClose.forEach(close => {
            close.addEventListener('click', function() {
                this.closest('.modal').classList.add('hidden');
            });
        });
    });
</script>
@endsection
