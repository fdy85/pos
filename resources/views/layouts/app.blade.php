<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '') }}</title>

        <!-- APG LOGO -->  
        <link rel="icon" type="image/png" href="{{asset('img/icos/greenTriangleLogo.png')}}">

        {{-- Toastr --}}
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        {{-- DatePicker --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

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
                @inject('carbon', 'Carbon\Carbon')
                {{-- TOP MENU --}}
                @include('welcomeTemplate.top-navbar-section')
                <div class="flex">
                    {{-- SIDEBAR --}}
                    @auth
                        @include('welcomeTemplate.sidebar-section')    
                    @endauth
            
                    @yield('content')
                    
                
                    
                {{-- {{ $slot }} --}}
                </div>
                
                
                
            </main>


        </div>

        <!-- Page Content -->

        {{-- JQuery --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        
        <!-- SweetAlerts -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/bb384beed0.js" crossorigin="anonymous"></script>

        {{--  DatePicker --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>

        {{-- Main JS --}}

        {{-- @stack('modals') --}}

        @livewireScripts

        {{-- Main JS --}}
        <script>
            /* Base URL */
            const baseURL = {!! json_encode(url('/')) !!}
                console.log(baseURL);

            /* Dialog confirm modals */
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn-confirm',
                    cancelButton: 'btn-close'
                },
                buttonsStyling: false
            })

            function ConfirmDestroy(id){
                //console.log(id);
                swalWithBootstrapButtons.fire({
                    title: 'Seguro que desea Eliminar este Registro?',
                    text: "Una vez eliminado, la información no podrá ser recuperada!",
                    showCancelButton: true,
                    confirmButtonText: "Si, Eliminar!",
                    cancelButtonText: 'Cancelar',
                    focusConfirm: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        /* emit listener to Controller  */
                        window.livewire.emit('destroy', id);
                    }
                })        
            }

            function ConfirmFlowDestroy(id){
                swalWithBootstrapButtons.fire({
                    title: 'Seguro que desea Eliminar este Registro?',
                    text: "Una vez eliminado, la información no podrá ser recuperada!",
                    showCancelButton: true,
                    confirmButtonText: "Si, Eliminar!",
                    cancelButtonText: 'Cancelar',
                    focusConfirm: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        /* emit listener to Controller  */
                        window.livewire.emit('destroyFlow', id);
                    }
                })        
            }

            /* Confirm User Activation */
            /* This function is exclusively for dashboard-page [New Users] */
            function ConfirmActivateUser(id){
                swalWithBootstrapButtons.fire({
                    title: 'Seguro que desea Activar a este Usuario?',
                    text: "Una vez Activdo, El usuario tendra acceso al Panel de Control para Clientes!",
                    showCancelButton: true,
                    confirmButtonText: "Si, Activar!",
                    cancelButtonText: 'Cancelar',
                    focusConfirm: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        /* emit listener to Controller  */
                        window.livewire.emit('activeUser', id);
                    }else{
                        document.getElementById('chkUser'+id).checked = false;
                    }
                })        
            }

            /* Confirm Finish Events */
            /* This function is exclusively for dashboard-page*/
            function ConfirmEventPayed(id, isPayed){
            
                //var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                //console.log(checkboxes);
                if(isPayed == true){
                    swalWithBootstrapButtons.fire({
                        title: 'Seguro que desea Finalizar el Evento?',
                        text: "Una vez Finalizado, la información no podrá ser Modificada!",
                        showCancelButton: true,
                        confirmButtonText: "Si, Finalizar!",
                        cancelButtonText: 'Cancelar',
                        focusConfirm: false,
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                        /* Get all Checkboxes to delete them after accept request */
                            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                            checkboxes.forEach(element => {
                                element.parentNode.removeChild(element);
                            });
                            var inputs = document.querySelectorAll('input[type="number"]');
                            inputs.forEach(element => {
                                element.parentNode.removeChild(element);
                            });
                        /* emit listener to Controller  */
                            window.livewire.emit('savePayment', id, isPayed);
                        }else{
                            document.getElementById('chkEvent'+id).checked = false;
                        }
                    })    
                }
                        
            }
            
            /* Destroy image and emit listener */
            function deleteImageConfirmation(url){
                console.log(url);
                swalWithBootstrapButtons.fire({
                    title: 'Seguro que desea Eliminar esta imagen?',
                    text: "Una vez eliminada no podrá ser recuperada!",
                    showCancelButton: true,
                    confirmButtonText: 'Si, Eliminar!',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    console.log(result);
                    if (result.isConfirmed) {
                        console.log('emitiendo');
                        /* emit listener to Controller trims baseURL from Image's Url */
                        Livewire.emit('destroyImage', url.replace(baseURL+'/storage/', ''));
                    }
                });
            }

            $(document).ready(function(){
                /* Toast */
            Livewire.on('toast-message', msg =>{
                console.log(msg);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                icon: msg['icon'],
                title: msg['msg']
                })
                });
                
            });

            /* This function is exclusively for dashboard-page*/
            /* Evaluates at finishing event if weight exists */
            /* Revert Payment */
            Livewire.on('revert-payment', id =>{
                document.getElementById(id.id).checked = false;
            });

            /* Evaluates at User activation if client was linked */
            /* Revert Activation */
            Livewire.on('revert-activation', id =>{
                document.getElementById(id.id).checked = false;
            });

        </script>
    </body>
</html>
