@extends('base.base-dash-index')
@section('title')
    Talent Management - Siakad By Internal Developer
@endsection
@section('menu')
    Errors
@endsection
@section('submenu')
    Errors Authorization
@endsection
@if (Auth::check())
    @section('urlmenu')
        {{ route($prefix . 'home-index') }}
    @endsection
@else
@endif
@section('subdesc')
    Errors Pages Authorization
@endsection
@section('content')
    <div class="max-w-4xl mx-auto p-4">
        @if (Str::is('error/verify', request()->path()))
            <!-- Verify Error Card -->
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="px-6 py-4 flex justify-between items-center border-b border-yellow-400">
                    <h2 class="text-2xl font-bold text-white">{{ $submenu }}</h2>
                    <a href="{{ url()->current() }}"
                        class="flex items-center px-4 py-2 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full text-white font-medium transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                clip-rule="evenodd" />
                        </svg>
                        Refresh
                    </a>
                </div>
                <div class="p-6">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white mr-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="text-xl font-semibold text-white">Account Verification Required</p>
                            <p class="text-yellow-100 mt-1">Your account is not yet verified. Please wait for administrator
                                approval or contact support.</p>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(Str::is('error/access', request()->path()))
            <!-- Access Error Card -->
            <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="px-6 py-4 flex justify-between items-center border-b border-red-400">
                    <h2 class="text-2xl font-bold text-white">{{ $submenu }}</h2>
                    <a href="{{ url()->current() }}"
                        class="flex items-center px-4 py-2 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full text-white font-medium transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                clip-rule="evenodd" />
                        </svg>
                        Refresh
                    </a>
                </div>
                <div class="p-6">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white mr-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <div>
                            <p class="text-xl font-semibold text-white">Access Denied</p>
                            <p class="text-red-100 mt-1">Your account doesn't have permission to access this page. Please
                                return to <a href="/"
                                    class="font-bold underline hover:text-white transition-colors">Home</a> or contact your
                                administrator.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
