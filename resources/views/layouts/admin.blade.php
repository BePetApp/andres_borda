<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  data-theme="bumblebee">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
        <style>
            /* -----
            SVG Icons - svgicons.sparkk.fr
            ----- */

            .svg-icon {
            width: 1.5em;
            height: 1.5em;
            }

            .svg-icon path,
            .svg-icon polygon,
            .svg-icon rect {
            fill: #e1e1e1;
            }

            .svg-icon circle {
            stroke: #e1e1e1;
            stroke-width: 1;
            }
        </style>
        
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen">      
            <!-- Page Content -->
            <main>
                <div class="drawer drawer-mobile" data-theme="dark">
                    <input id="my-drawer-2" type="checkbox" class="drawer-toggle">
                    <div class="drawer-content lg:!z-30" data-theme="bumblebee">
    
                        <!-- Page content here -->
                        <div class="bg-gray-100 p-4 lg:p-8 min-h-screen">
                            <div class="p-3">
                                <label for="my-drawer-2" class="btn btn-primary drawer-button p-2 text-xs lg:hidden">
                                    <svg class="svg-icon" viewBox="0 0 20 20">
                                        <path fill="none" d="M1.683,3.39h16.676C18.713,3.39,19,3.103,19,2.749s-0.287-0.642-0.642-0.642H1.683
                                            c-0.354,0-0.641,0.287-0.641,0.642S1.328,3.39,1.683,3.39z M1.683,7.879h11.545c0.354,0,0.642-0.287,0.642-0.641
                                            s-0.287-0.642-0.642-0.642H1.683c-0.354,0-0.641,0.287-0.641,0.642S1.328,7.879,1.683,7.879z M18.358,11.087H1.683
                                            c-0.354,0-0.641,0.286-0.641,0.641s0.287,0.642,0.641,0.642h16.676c0.354,0,0.642-0.287,0.642-0.642S18.713,11.087,18.358,11.087z
                                             M11.304,15.576H1.683c-0.354,0-0.641,0.287-0.641,0.642s0.287,0.641,0.641,0.641h9.621c0.354,0,0.642-0.286,0.642-0.641
                                            S11.657,15.576,11.304,15.576z"></path>
                                    </svg>
                                </label>
                                <span class="text-2xl">{{ $pageName ?? 'Dashboard'}}</span>
                            </div>
                            {{ $slot }}
                        </div>
                    </div>
                     
                    <div class="drawer-side">
                        <label for="my-drawer-2" class="drawer-overlay"></label>
                        <ul class="menu p-4 overflow-y-auto w-72 bg-base-100 text-base-content">

                            <!-- Sidebar content here -->
                            <div class="flex flex-col justify-between h-screen">
                                <div class="flex-1">
                                    <div class="p-4 border-b-2 mb-2 border-slate-700">
                                        <h1 class="text-xl mb-2"><a href="{{ route('home') }}">Woody E-commerce</a></h1>
                                        <p class="italic text-xs">Panel de Administración</p>
                                    </div> 
                                    <li><a href="{{ route('admin.dashboard') }}" 
                                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : ''}}">Dashboard</a></li>
        
                                    <li><a href="{{ route('admin.products') }}" 
                                        class="{{ request()->routeIs('admin.products') ? 'active' : ''}}">Productos</a></li>

                                    <li><a href="{{ route('admin.users') }}" 
                                        class="{{ request()->routeIs('admin.users') ? 'active' : ''}}">Usuarios</a></li>
                                    
                                    <li><a href="{{ route('admin.orders') }}" 
                                        class="{{ request()->routeIs('admin.orders') ? 'active' : ''}}">Ventas / Ordenes</a></li>
                                </div>
                                <div class="text-sm pt-3 border-t-2 border-slate-700">
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
        
                                        <li><a href="{{ route('logout') }}"
                                                 @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </a></li>
                                    </form>
                                </div>  
                            </div>

                        </ul>
                    </div>
                </div> 
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        {{ $scripts ?? ''}}
    </body>
</html>
