@extends('base.base-auth-index')
@section('content')
    <section class="min-h-screen bg-gray-50">
        <div class="flex min-h-screen">
            <!-- Left side - Login Form -->
            <div class="w-full md:w-1/2 flex flex-col justify-center px-4 sm:px-6 lg:px-8 py-12">
                <div class="w-full max-w-md mx-auto">
                    <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 border border-gray-100">
                        <!-- Logo -->
                        <div class="flex justify-center mb-6">
                            <img src="{{ asset('storage/images/' . $web->school_logo) }}" alt="School Logo"
                                class="max-h-24 object-contain">
                        </div>

                        <!-- Login Header -->
                        <div class="mb-6 text-center">
                            <h2 class="text-2xl font-bold text-gray-800">Admin Sign In</h2>
                            <p class="text-sm text-gray-600 mt-1">Enter your credentials to access your account</p>
                        </div>

                        <!-- Alert component -->
                        @include('sweetalert::alert')

                        <!-- Login Form -->
                        <form action="{{ route('admin.auth-signin-post') }}" method="POST" class="space-y-5">
                            @csrf

                            <div>
                                <label for="login" class="block text-sm font-medium text-gray-700 mb-1">Username / Email
                                    / Phone</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" name="login" id="login"
                                        class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-300 focus:border-green-500 focus:outline-none transition-all duration-200"
                                        placeholder="Enter your username, email or phone number">
                                </div>
                                @error('login')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="password" name="password" id="password"
                                        class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-300 focus:border-green-500 focus:outline-none transition-all duration-200"
                                        placeholder="••••••••">
                                </div>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="rememberMe" name="remember"
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded transition-all duration-200">
                                <label for="rememberMe" class="ml-2 block text-sm text-gray-700">
                                    Remember me
                                </label>
                            </div>

                            <!-- Turnstile Widget -->
                            <div>
                                <x-turnstile-widget theme="auto" language="id" />
                                @error('cf-turnstile-response')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 shadow-md transition-all duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Sign in
                                </button>
                            </div>
                        </form>

                        <!-- Footer Links -->
                        <div class="mt-6 text-center space-y-2">
                            <p class="text-sm text-gray-600">
                                Forgot your password?
                                <a href="{{ route('admin.auth-forgot-page') }}"
                                    class="font-medium text-green-600 hover:text-green-500 transition-colors duration-200">
                                    Reset it here
                                </a>
                            </p>
                            <p class="text-sm text-gray-600">
                                Back to home?
                                <a href="{{ route('root.home-index') }}"
                                    class="font-medium text-green-600 hover:text-green-500 transition-colors duration-200">
                                    Click here
                                </a>
                            </p>
                        </div>
                    </div>

                    <!-- Additional Security Notice -->
                    <div class="mt-6 text-center">
                        <div class="flex items-center justify-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Secured by Cloudflare Turnstile
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Image with Overlay -->
            <div class="hidden md:block md:w-1/2 bg-cover bg-center relative"
                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg')">
                <div class="absolute inset-0 bg-green-700 bg-opacity-80"></div>
                <div class="absolute inset-0 flex items-center justify-center p-12">
                    <div class="text-center max-w-lg">
                        <div
                            class="bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-sm border border-white border-opacity-20 shadow-lg">
                            <h2 class="text-3xl font-bold text-white mb-4">"Attention is the new currency"</h2>
                            <p class="text-lg text-white">The more effortless the writing looks, the more effort the writer
                                actually put into the process.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
