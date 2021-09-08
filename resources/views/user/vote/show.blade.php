<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{ __('Vote for ') }} {{ $contest->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto p-4">
            <div class="overflow-hidden sm:rounded-lg">
                <livewire:contestant-vote-component :contest="$contest" />
            </div>
        </div>
    </div>
</x-guest-layout>