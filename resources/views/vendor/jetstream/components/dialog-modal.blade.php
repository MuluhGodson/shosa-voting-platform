@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg text-gray-400">
            {{ $title }}
        </div>

        <div class="mt-4 text-gray-300">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-4 bg-black text-right border-t-2 border-secondary">
        {{ $footer }}
    </div>
</x-jet-modal>
