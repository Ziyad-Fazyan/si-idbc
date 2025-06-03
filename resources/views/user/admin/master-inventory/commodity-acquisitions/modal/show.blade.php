<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-sm transition-all duration-300">
    <!-- Loading Indicator -->
    <div id="loading-show" class="hidden py-8">
        <div class="flex justify-center items-center">
            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-blue-500"></div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="border-b border-gray-100 pb-5 mb-6">
        <div class="flex items-center space-x-3">
            <div class="p-2 rounded-lg bg-blue-50 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-800">Detail Perolehan</h2>
        </div>
    </div>

    <!-- Content Section -->
    <div id="content-show">
        <div class="space-y-5">
            <!-- Name Card -->
            <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-xs hover:shadow-sm transition-shadow duration-200">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Nama</p>
                        <p id="show-name" class="text-lg font-semibold text-gray-800 break-words"></p>
                    </div>
                    <div class="p-1.5 rounded-md bg-blue-50 text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-xs hover:shadow-sm transition-shadow duration-200">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Deskripsi</p>
                        <p id="show-description" class="text-gray-700 leading-relaxed break-words"></p>
                    </div>
                    <div class="p-1.5 rounded-md bg-green-50 text-green-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Close Button -->
        <div class="mt-6 flex justify-end">
            <button type="button" @click="$dispatch('close-modal', {name: 'show-perolehan'})"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Tutup
            </button>
        </div>
    </div>
</div>
