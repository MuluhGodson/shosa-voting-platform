<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{ __('Vote') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
            <div class="overflow-hidden sm:rounded-lg text-white">
                <p class="text-center"><i class="fas fa-check-circle text-3xl text-green-500"></i></p>
                <h2 class="text-center font-bold text-3xl">Thank You!</h2>
                <h3 class="text-center">Your payment is succesfully done and your votes have been registered.</h3>
                
            </div>
        </div>
    </div>
</x-guest-layout>