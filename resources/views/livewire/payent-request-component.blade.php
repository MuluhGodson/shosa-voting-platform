<div>
    <div>
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
                                Tel
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Currency
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Candidate
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Votes
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Payment Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class=" text-gray-200 divide-y divide-gray-200">
                    @forelse ($pr as $p)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex gap-4 items-center">
                                    <div>
                                        <div class="text-gray-200">{{$p->tel}}</div>
                                        
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-gray-200">
                                    {{ $p->amount }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-gray-200">
                                    {{ $p->currency }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-gray-200">
                                    {{ Str::remove('CANDIDATE',\App\Models\Candidate::find($p->candidate_id)->name) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                {{ number_format($p->vote_count) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-gray-200">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-gray-200">
                                    {{ $p->created_at }}
                                </span>
                            </td>
                            <td>
                                <x-jet-button wire:click="addVote('{{ $p->id }}')">
                                    {{__('Validate Payment') }}
                                    <div wire:loading wire:target="addVote">
                                        <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                                    </div>
                                </x-jet-button>
                            </td>
                        </tr>
                    @empty
                        No pending payments available yet
                    @endforelse
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>

</div>
