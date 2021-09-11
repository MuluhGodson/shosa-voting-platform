<div>

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
                                        <div class="text-sm text-secondary">{{$cand->name}}</div>
                                        
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
</div>
