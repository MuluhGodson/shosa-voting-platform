<div>

        @if(Session::has('message'))
            <p class="uppercase text-red-500 bg-red-200 w-auto p-4 text-center">{{ Session::get('message') }}</p>
        @endif
        @if(Session::has('message_success'))
            <p class="uppercase text-green-500 bg-green-200 w-auto p-4 text-center">{{ Session::get('message_success') }}</p>
        @endif

        <div class="my-8">
            <h1 class="text-center text-xl md:text-4xl text-gray-300"> Select a contest you want to vote in</span> </h1>
        </div>
        <div class="grid sm:grid-cols-4 gap-4">
            @forelse ($contests as $contest)
                <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg transition hover:px-1 duration-500 ease-in-out  col rounded hover:border-r-2 hover:boder-r-white hover:border-l-2 hover:border-l-secondary cursor-pointer hover:transform hover:scale-150">
                    <div wire:click="openView('{{ $contest->slug }}')">
                        <img src="{{Storage::url($contest->cover_image)}}" class="object-cover object-top h-60 w-full" alt="{{$contest->name}}">
                        <div class="my-1 flex justify-end py-1 px-1">
                            @if(($contest->active) && ($contest->ending_date >= today()->toDateString()))
                                <small class="my-2 text-right px-2 rounded-full bg-secondary text-white">voting open</small>
                            @else
                                <small class="my-2 text-right px-2 rounded-full bg-red-600 text-white">voting closed</small>
                            @endif
                        </div>
                        <div class="p-2 my-1">
                            <h1 class="text-center text-lg text-secondary font-bold uppercase">
                                {{ $contest->name }}
                            </h1>
                            <p class="text-gray-400 text-center">{{ Str::words($contest->description,15,'...') }}
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-center content-end p-3">
                            <div>
                                <a href="{{ route('vote.candidate', $contest->slug) }}" class="rounded-full px-2 py-1 bg-transparent border border-secondary text-secondary font-semibold hover:bg-secondary hover:text-gray-400">Vote Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-400">No contest are available yet.</p>
            @endforelse
        </div>

        @if($viewContest)
        <!-- Modal to view contest -->
        <x-jet-dialog-modal class="bg-transparent" wire:model="viewContest">
            <x-slot name="title">
            
            </x-slot>

            <x-slot name="content">
                <div class="max-w-4xl flex items-center h-auto flex-wrap mx-auto my-32 lg:my-0">
                
                    <!--Main Col-->
                    <div class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-black bg-opacity-75 mx-6 lg:mx-0">
                        <div class="p-4 md:p-12 text-center lg:text-left">
                            <!-- Image for mobile view-->
                            <div class="block lg:hidden rounded-full shadow-xl mx-auto -mt-16 h-48 w-48 bg-cover bg-center" style="background-image: url('{{Storage::url($event_photo)}}')"></div>
                            
                            <h1 class="text-xl font-bold pt-8 lg:pt-0 text-secondary text-left uppercase">{{ $name }}</h1>
                            <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                            
                            <div>
                                <p class="text-base uppercase font-bold flex items-center justify-center lg:justify-start">
                                    @if($tarrif)
                                        <small class="my-2">VOTING: {{ $vote_fee }} per vote</small>
                                    @else
                                        <small class="my-2">VOTING: FREE</small>
                                    @endif
                                </p>
                                <p class="text-base uppercase font-bold flex items-center justify-center lg:justify-start">
                                    <small>Duration: {{ $b_date }} - {{ $e_date }}</small>
                                </p>
                            </div>
                            <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                            <p class="pt-8 text-sm  text-justify">
                                {{ Str::words($description, $text_words , '...') }}
                                @if(!$showText)
                                    <button wire:click="openText('{{ $slug }}','y')" class="bg-transparent text-secondary font-bold">See all</button>
                                @else
                                    <button wire:click="openText('{{ $slug }}','n')" class="bg-transparent text-secondary font-bold">See less</button>
                                @endif
                            </p>

                            <div class="pt-12 pb-8">
                                <a href="{{ route('vote.candidate', $slug) }}" class="bg-secondary hover:bg-transparent hover:border hover:border-secondary hover:text-secondary text-white font-bold py-2 px-4 rounded-full">
                                Vote Now
                                </a> 
                            </div>

                        </div>

                    </div>
                    
                    <!--Img Col-->
                    <div class="w-full lg:w-2/5">
                        <!-- Big profile image for side bar (desktop) -->
                        <img src="{{Storage::url($event_photo)}}" class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
                    </div>

                    <!-- Pin to top right corner -->
                    <div class="absolute top-0 right-0 h-12 w-18 p-4">
                        <p class="pt-4 text-base font-bold flex items-center justify-center lg:justify-start">
                            @if(($active) && ($e_date >= today()->toDateString()))
                                <small class="my-2 text-right px-2 rounded-full bg-secondary text-white">voting open</small>
                            @else
                                <small class="my-2 text-right px-2 rounded-full bg-red-600 text-white">voting closed</small>
                            @endif
                        </p>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button class="bg-transparent text-gray-400" wire:click="$toggle('viewContest')" wire:loading.attr="disabled">
                    Close
                </x-jet-secondary-button>

                 <a href="{{ route('vote.candidate', $slug) }}" class="rounded-md px-2 py-1 mx-1 bg-transparent border border-secondary text-secondary font-semibold hover:bg-secondary hover:text-gray-400">Vote Now</a>

            </x-slot>
        </x-jet-dialog-modal>
        @endif
</div>
