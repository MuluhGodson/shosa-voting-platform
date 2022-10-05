<div>

    <div class="flex flex-col sm:justify-center items-center">
        <div>
            <x-jet-authentication-card-logo />
        </div>
    </div>

    @if(Session::has('message'))
        <p class="uppercase text-red-500 bg-red-200 w-auto p-4 text-center">{{ Session::get('message') }}</p>
    @endif
    @if(Session::has('message_success'))
        <p class="uppercase text-green-600 font-bold bg-green-100 w-auto p-4 text-center">{{ Session::get('message_success') }}</p>
    @endif

    <div class="my-8">
        <h1 class="text-center text-xl md:text-4xl text-gray-300"> Vote your favorite contestant for <span class="text-white uppercase font-bold">{{ $contest->name }}</span> </h1>
    </div>
    <div class="my-4">
        <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
            @forelse ($candidates->sortByDesc('vote_count') as $cand)
                <a class="my-5" href="{{ route('candidate.vote', ['contest'=>$contest, 'candidate' => $cand]) }}">
                    <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg rounded transition hover:px-1 duration-500 ease-in-out  col hover:border-r-2 hover:boder-r-white hover:border-l-2 hover:border-l-secondary cursor-pointer hover:transform hover:scale-150">
                    
                        <div class="bg-black">
                            <img src="{{Storage::url($cand->photo)}}" class="object-cover object-top h-full w-full rounded-md" alt="{{$cand->name}}">
                            <div class="my-1 flex justify-center gap-4 py-1 px-1">
                            
                                <p class="text-sm text-gray-400"><i class="fas fa-city"></i> {{ $cand->town }}</p>
                            </div>
                            <div class="p-2 my-1">
                                <h1 class="text-center text-lg text-secondary font-bold uppercase">
                                    {{ $cand->name }}
                                </h1>
                                {{-- <pclass="text-gray-400text-center">Str::words($cand->bio,5,'...readmore') </p>--}}
                            </div>
                            <!-- Pin to right corner -->
                            <div class="absolute top-0 right-0 h-10 w-18 p-1 bg-secondary text-white">
                                <p class="p-1 font-bold flex items-center justify-center lg:justify-start uppercase text-xl">
                                    <span class="font-bold">{{ number_format($cand->vote_count)}} @if($cand->vote_count > 1 || $cand->vote_count == 0)Votes @else Vote @endif</span>
                                </p>
                            </div>
                            <div class="absolute top-0 left-0 h-10 w-18 p-1 bg-secondary text-white">
                                <p class="p-1 font-bold flex items-center justify-center lg:justify-start uppercase text-xl">
                                    <span class="font-bold">#{{ $cand->candidate_number }} </span>
                                </p>
                            </div>
                        
                            <div>
                                <div class="flex justify-center content-end p-3">
                                    <div>
                                        <button class="rounded px-2 py-2 bg-transparent border border-secondary text-secondary font-semibold hover:bg-secondary hover:text-gray-400" wire:click="openVote('{{ $cand->slug }}')">Vote</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </a>

            @empty
                <p class="text-gray-400">No contestants applied yet.</p>
            @endforelse
        </div>
    </div>
</div>
