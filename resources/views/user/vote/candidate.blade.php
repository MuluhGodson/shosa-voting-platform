<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{ __('Vote for ') }} {{ $candidate->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto p-4">
            <h2 class="font-semibold text-xl text-white leading-tight text-center">
                {{ __('Vote for ') }} {{ $candidate->name }}
            </h2>
            <div class="overflow-hidden sm:rounded-lg my-5">
               @livewire('candidate-vote-page', ['contest' => $contest, 'candidate' => $candidate])
            </div>
        </div>
    </div>
</x-guest-layout>