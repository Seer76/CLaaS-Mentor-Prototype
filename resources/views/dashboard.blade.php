<x-app-layout>
    <div class="py-6 space-y-8">
        <!-- Page Title & Subtitle -->
        <div>
            <h2 class="text-3xl font-bold text-brand-dark dark:text-white">Security Control Centre</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Multi-tenant security monitoring and threat detection
                across all environments</p>
        </div>

        <!-- Navigation Tabs -->
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="-mb-px flex space-x-8">
                <a href="#"
                    class="border-b-2 border-brand-accent py-4 px-1 text-sm font-medium text-brand-dark dark:text-white">Overview</a>
                <a href="#"
                    class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Active
                    Alerts</a>
                <a href="#"
                    class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Tenant
                    Status</a>
                <a href="#"
                    class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Compliance</a>
            </nav>
        </div>

        <!-- Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Create Alert Rule -->
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm flex items-center space-x-4 cursor-pointer hover:shadow-md transition">
                <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </div>
                <span class="font-semibold text-brand-dark dark:text-white">Create Alert Rule</span>
            </div>

            <!-- Run Security Scan -->
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm flex items-center space-x-4 cursor-pointer hover:shadow-md transition">
                <div class="p-3 bg-teal-100 dark:bg-teal-900 rounded-lg">
                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <span class="font-semibold text-brand-dark dark:text-white">Run Security Scan</span>
            </div>

            <!-- Generate Report -->
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm flex items-center space-x-4 cursor-pointer hover:shadow-md transition">
                <div class="p-3 bg-orange-100 dark:bg-orange-900 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <span class="font-semibold text-brand-dark dark:text-white">Generate Report</span>
            </div>

            <!-- Export Data -->
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm flex items-center space-x-4 cursor-pointer hover:shadow-md transition">
                <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                </div>
                <span class="font-semibold text-brand-dark dark:text-white">Export Data</span>
            </div>
        </div>

        <!-- Status Notification -->
        <div class="bg-gray-200 dark:bg-gray-700 p-4 rounded-md flex items-center">
            <svg class="w-5 h-5 text-gray-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="text-gray-700 dark:text-gray-300 font-medium">Security systems operating normally. Monitoring
                12 tenants across 3 environments.</span>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Active Threats -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border-t-4 border-purple-600">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold text-brand-dark dark:text-white">Active Threats</h3>
                        <p class="text-4xl font-bold text-brand-dark dark:text-white mt-4">3</p>
                        <p class="text-gray-500 mt-2">Medium priority threats detected</p>
                    </div>
                    <div class="p-2">
                        <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-4 dark:bg-gray-700">
                    <div class="bg-purple-600 h-2.5 rounded-full" style="width: 45%"></div>
                </div>
            </div>

            <!-- Tenants Monitored -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border-t-4 border-purple-600">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold text-brand-dark dark:text-white">Tenants Monitored</h3>
                        <p class="text-4xl font-bold text-brand-dark dark:text-white mt-4">12</p>
                        <p class="text-gray-500 mt-2">Across production, staging, development</p>
                    </div>
                    <div class="p-2">
                        <svg class="w-6 h-6 text-teal-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5.5 16a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 16h-8z"></path>
                        </svg>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-4 dark:bg-gray-700">
                    <div class="bg-teal-600 h-2.5 rounded-full" style="width: 70%"></div>
                </div>
            </div>

            <!-- Compliance Score -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border-t-4 border-purple-600">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold text-brand-dark dark:text-white">Compliance Score</h3>
                        <p class="text-4xl font-bold text-brand-dark dark:text-white mt-4">94%</p>
                        <p class="text-gray-500 mt-2">ISO 27001, SOC 2, GDPR compliant</p>
                    </div>
                    <div class="p-2">
                        <svg class="w-6 h-6 text-teal-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-4 dark:bg-gray-700">
                    <div class="bg-green-600 h-2.5 rounded-full" style="width: 94%"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>