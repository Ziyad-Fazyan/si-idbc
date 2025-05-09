<footer class="bg-white border-t border-gray-200 mt-auto ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-3 md:mb-0 text-center md:text-left">
                <p class="text-sm text-gray-600">
                    <span class="font-medium">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</span> &copy;
                    <span class="font-semibold text-indigo-600">{{ $web->school_apps }}</span> -
                    <span class="text-gray-700">{{ $web->school_name }}</span>
                </p>
            </div>
            <div class="text-center md:text-right">
                <p class="text-sm text-gray-600">
                    Developed by
                    <span class="font-medium text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                        Programming Class 24/25
                    </span>
                </p>
            </div>
        </div>
    </div>
</footer>
