@extends('layouts.app')

@section('content')
    <div style="min-height: 640px;" class="bg-gray-100">

        <div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">

            <!-- Static sidebar for desktop -->
            <div class="hidden md:flex md:flex-shrink-0">
                <div class="flex flex-col w-64">
                    <!-- Sidebar component, swap this element with another sidebar if you like -->
                    <div class="flex flex-col h-0 flex-1">
                        <div class="flex items-center h-16 flex-shrink-0 px-4 bg-gray-900">
                            <svg class="text-gray-400 mr-3 h-6 w-6" x-description="Heroicon name: outline/chart-bar" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span class="text-2xl text-gray-300 font-bold">Reports</span>
                        </div>
                        <div class="flex-1 flex flex-col overflow-y-auto">
                            <nav class="flex-1 px-2 py-4 bg-gray-800 space-y-1">


                                <!-- Current: "bg-gray-200 text-gray-900", Default: "text-gray-600 hover:bg-gray-50 hover:text-gray-900" -->
                                <a href="{{ route('report.membership') }}" class="text-gray-300 hover:bg-gray-700
                                hover:text-white group flex items-center
                                px-2 py-2
                                text-sm
                                font-bold rounded-md">
                                    <!-- Current: "text-gray-300", Default: "text-gray-400 group-hover:text-gray-300" -->
                                    Membership List
                                </a>

                                <a href="{{ route('report.club-members') }}" class="text-gray-300 hover:bg-gray-700
                                hover:text-white group
                                flex
                                items-center px-2 py-2 text-sm font-bold rounded-md">
                                    Club Member List
                                </a>

                                <a href="{{ route('report.club.status') }}" class="text-gray-300 hover:bg-gray-700
                                hover:text-white
                                group
                                 flex
                                items-center px-2 py-2 text-sm font-bold rounded-md">
                                    Clubs Status
                                </a>

                                <a href="{{ route('report.invalid.personnel') }}" class="text-gray-300
                                hover:bg-gray-700
                                hover:text-white group
                                flex
                                items-center px-2 py-2 text-sm font-bold rounded-md">
                                    Invalid Personnel
                                </a>

                                <a href="{{ route('report.active.coaches') }}" class="text-gray-300
                                hover:bg-gray-700
                                hover:text-white group
                                flex
                                items-center px-2 py-2 text-sm font-bold rounded-md">
                                    Active Coaches
                                </a>

                                <a href="{{ route('report.invalid.coaches') }}" class="text-gray-300
                                hover:bg-gray-700
                                hover:text-white
                                group
                                flex
                                items-center px-2 py-2 text-sm font-bold rounded-md">
                                    Invalid Coaches
                                </a>

                                <a href="{{ route('report.email.consent') }}" class="text-gray-300 hover:bg-gray-700
                                hover:text-white group
                                flex
                                items-center px-2 py-2 text-sm font-bold rounded-md">
                                    Email Consent
                                </a>

                                <a href="{{ route('report.grading.list') }}" class="text-gray-300
                                hover:bg-gray-700
                                hover:text-white group
                                flex
                                items-center px-2 py-2 text-sm font-bold rounded-md">
                                    Grading List
                                </a>

                                <a href="{{ route('report.compliance-status') }}" class="bg-gray-900 text-white
                                hover:bg-gray-700 hover:text-white
                                group
                                flex
                                items-center px-2 py-2 text-sm font-bold rounded-md">
                                    Compliance status
                                </a>


                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow item">
                    <button @click.stop="sidebarOpen = true" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" x-description="Heroicon name: outline/menu-alt-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                    </button>
                    <div class="text-2xl font-bold text-gray-700 pl-8 flex items-center">
                        <h2>Compliance Status Report</h2>
                    </div>
                </div>

                @livewire('compliance-report', ['clubs' => $clubs])
            </div>
        </div>

    </div>

@endsection
