<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '') }}</title>

        <!-- APG LOGO -->  
        <link rel="icon" type="image/png" href="{{asset('img/icos/greenTriangleLogo.png')}}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        {{-- <x-jet-banner /> --}}

        <div class=" bg-slate-100">

            {{-- Main Content --}}
            <main>
                @livewire('admin.pos.print-ticket')
                                
            </main>


        </div>

        <!-- Page Content -->

        {{-- JQuery --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        
        @livewireScripts

        {{-- Main JS --}}
        <script>
            /* Base URL */
            const baseURL = {!! json_encode(url('/')) !!}
                console.log(baseURL);

            

        </script>
    </body>
</html>

