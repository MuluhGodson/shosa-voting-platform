<div>
    {{--<div class="my-5">
        <x-jet-button wire:click="voteManual()">
            {{__('Add Vote') }}
        </x-jet-button>
    </div>--}}
    @if(Session::has('message'))
        <p class="uppercase text-red-500 bg-red-200 w-auto p-4 text-center">{{ Session::get('message') }}</p>
    @endif
    @if(Session::has('message_success'))
        <p class="uppercase text-green-600 font-bold bg-green-100 w-auto p-4 text-center">{{ Session::get('message_success') }}</p>
    @endif
        <div wire:poll.500ms class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-secondary sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Votes
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Income
                            </th>
                        </tr>
                    </thead>
                    <tbody class=" text-gray-200 divide-y divide-gray-200">
                    @forelse ($candidates->sortByDesc('vote_count') as $cand)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex gap-4 items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover object-top" src="{{Storage::url($cand->photo)}}" alt="">
                                    </div>
                                    <div>
                                        <div class="text-sm text-secondary">#{{ $cand->candidate_number }} - {{$cand->name}}</div>
                                        
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-gray-200">
                                    {{ number_format($cand->vote_count) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                {{ number_format($cand->vote_amount) }} {{ $contest->currency }}
                            </td>
                        </tr>
                    @empty
                        No statistics available yet
                    @endforelse
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>

    @if($openVote)
        <x-jet-dialog-modal wire:model="openVote">
            <x-slot name="title">
                Manually Add Votes
            </x-slot>

            <x-slot name="content">
                Select a candidate and add their votes.
                <x-jet-validation-errors class="mb-4" />
                 <div class="mt-2">
                    <select wire:model="candi" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm">
                        <option>Select Candidate</option>
                        @foreach ($candidates as $candi)
                            <option value="{{ $candi->id }}">{{ $candi->name }}</option>
                        @endforeach
                    <select>
                 </div>
                 <div class="mt-2">
                    <x-jet-label class="font-bold" for="name" value="{{ __('Number of Votes') }}" />
                    <x-jet-input id="vote_number" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="vote_number" type="number" name="vote_number" :value="old('vote_number')" required />
                </div>
            </x-slot>

            <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('openVote')" wire:loading.attr="disabled">
                        Nevermind
                    </x-jet-secondary-button>
                <x-jet-confirms-password wire:then="addVote()">
                    <x-jet-button class="ml-2" wire:loading.class="bg-transparent">
                        Add Votes
                        <div wire:loading wire:target="addVote">
                            <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                        </div>
                    </x-jet-button>
                </x-jet-confirms-password>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>
