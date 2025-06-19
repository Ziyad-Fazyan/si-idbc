@extends('base.base-dash-index')
@section('title')
    Data Recovery Center - Siakad By Internal Developer
@endsection
@section('menu')
    Data Recovery
@endsection
@section('submenu')
    Recycle Bin Management
@endsection
@section('urlmenu')
    {{ route('web-admin.trash.index') }}
@endsection
@section('subdesc')
    Centralized management for recoverable deleted data (soft deleted items)
@endsection
@section('content')
    <section class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Recovery Center</h1>
                <p class="text-gray-600">Manage and restore soft deleted data across all system modules</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="bg-gray-100 px-3 py-1 rounded-full text-sm font-medium text-gray-800">
                    {{ count($models) }} Modules
                </span>
            </div>
        </div>

        <!-- Notification Area -->
        <div class="space-y-3">
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 rounded-r px-4 py-3 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 text-green-500">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 rounded-r px-4 py-3 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 text-red-500">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Modules Grid -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($models as $modelKey => $modelName)
                        <div class="border border-gray-100 rounded-lg p-5 hover:shadow-md transition-all duration-200 bg-gradient-to-br from-white to-gray-50">
                            <div class="flex items-start justify-between mb-3">
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $modelName }}</h3>
                            <p class="text-sm text-gray-500 mb-4">View and restore deleted records</p>
                            <a href="{{ route('web-admin.trash.show', $modelKey) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                                View Deleted
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Empty State -->
            @if(count($models) === 0)
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No recoverable modules found</h3>
                    <p class="mt-1 text-sm text-gray-500">There are currently no modules with soft delete functionality enabled.</p>
                </div>
            @endif
        </div>

        <!-- Help Section -->
        <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">About Soft Deleted Data</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Soft deleted data remains in the database but is marked as deleted. You can restore these items or permanently delete them from their respective module views.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection