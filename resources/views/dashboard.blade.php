<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:dashboard-component />

                <div id="myCalendar" width="200" height="400"  class="bg-gray-300">
                    {!! $calendar->calendar() !!}
                    {!! $calendar->script() !!}
                </div>
               
            </div>
        </div>
    </div>
</x-app-layout>
