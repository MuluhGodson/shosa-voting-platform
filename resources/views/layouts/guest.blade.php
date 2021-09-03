<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layouts.parts.header')

    <body class="font-sans antialiased" style="background-image: url('https://unsplash.com/photos/4u2U8EO9OzY')">
        <x-jet-banner />
        <script>
            AOS.init();
        </script>
        <div class="min-h-screen bg-black">
            <div class="flex max-w-7xl mx-auto">
               {{-- <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>--}}

            </div>
            @include('sweetalert::alert')
            <script>
                window.addEventListener('swal',function(e){
                    swal.fire(e.detail);
                });
            </script>
             


            <div class="w-full mx-auto max-w-7xl sm:w-full pt-1 md:pb-1">
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div> 
   

            @include('layouts.parts.footer')
        </div>

        

        @stack('modals')

        @livewireScripts
    </body>
</html>
