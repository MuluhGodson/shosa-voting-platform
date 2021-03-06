<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-black border-b-secondary border-b-2 border-t-2 border-t-secondary shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
