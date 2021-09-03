<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layouts.parts.header')

    <body class="font-sans antialiased">
        <x-jet-banner />
        <script>
            AOS.init();
        </script>
        <div class="min-h-screen bg-black">
            @livewire('navigation-menu')
            @include('sweetalert::alert')
            <script>
                window.addEventListener('swal',function(e){
                    swal.fire(e.detail);
                });
            </script>
             <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-secondary shadow">
                    <div class="md:max-w-7xl w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

                <div class="grid md:grid-cols-6 grid-cols-1 justify-center">

                    <div class="hidden sm:block max-h-screen rounded">
                        <!-- Side bar -->
                        @include('layouts.parts.sidebar')
                    </div>

                    <div class="md:max-w-7xl w-full pt-1 md:pb-1 col-span-5">
                        <!-- Page Content -->
                        <main>
                            {{ $slot }}
                        </main>
                    </div> 
                </div>   

            @include('layouts.parts.footer')
        </div>

        

        @stack('modals')

        @livewireScripts
    </body>
</html>
