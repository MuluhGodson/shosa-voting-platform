<div>

    <div class="flex flex-col sm:justify-center items-center bg-black">
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
        <h1 class="text-center text-xl md:text-4xl text-gray-300"> Vote your favorite contestant for <span class="text-secondary uppercase font-bold">{{ $contest->name }}</span> </h1>
    </div>
    <div class="my-4">
        <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
            @forelse ($candidates->sortByDesc('vote_count') as $cand)
                <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg rounded transition hover:px-1 duration-500 ease-in-out  col hover:border-r-2 hover:boder-r-white hover:border-l-2 hover:border-l-secondary cursor-pointer hover:transform hover:scale-150">
                    <div wire:click="openCandidate('{{ $cand->slug }}')">
                        <img src="{{Storage::url($cand->photo)}}" class="object-cover object-top h-full w-full rounded-md" alt="{{$cand->name}}">
                        <div class="my-1 flex justify-center gap-4 py-1 px-1">
                            <p class="text-sm text-gray-400"><i class="fas fa-birthday-cake"></i> {{ \Carbon\Carbon::parse($cand->dob)->diffForHumans(null,1,true) }}</p>
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
                    </div>
                    <div>
                         <div class="flex justify-center content-end p-3">
                            <div>
                                <button class="rounded px-2 py-2 bg-transparent border border-secondary text-secondary font-semibold hover:bg-secondary hover:text-gray-400" wire:click="openVote('{{ $cand->slug }}')">Vote</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-400">No contestants applied yet.</p>
            @endforelse
        </div>
    </div>


     @if($viewCandidate)
        <!-- Modal to view candidate -->
            <x-jet-dialog-modal class="bg-transparent" wire:model="viewCandidate">
                <x-slot name="title">
                    
                </x-slot>

                <x-slot name="content">

                    <div class="max-w-4xl flex items-center h-auto flex-wrap mx-auto my-32 lg:my-0">
                        
                        <!--Main Col-->
                        <div class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-black bg-opacity-75 mx-6 lg:mx-0">
                        

                            <div class="p-4 md:p-12 text-center lg:text-left">
                                <!-- Image for mobile view-->
                                <div class="block lg:hidden rounded-full shadow-xl object-top mx-auto -mt-16 h-48 w-48 bg-cover bg-center" style="background-image: url('{{Storage::url($candidate->photo)}}')"></div>
                                
                                <h1 class="text-xl font-bold pt-8 lg:pt-0 text-secondary text-left uppercase">{{ $candidate->name }}</h1>
                                <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                                
                                <div class="text-md text-left">
                                    <p>
                                        Date of Birth: {{ $candidate->dob }}
                                    </p>
                                    {{--<p>
                                        Division of Origin: {{ $candidate->division->name }}
                                    </p>--}}
                                    <p>
                                        Height: {{ $candidate->height }}
                                    </p>
                                    <p>
                                        Profession: {{ $candidate->profession }}
                                    </p>
                                   
                                </div>
                                <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                                <p class="pt-8 text-sm">
                                    {{ Str::words($candidate->bio, $text_words , '...') }}
                                    @if(!$showText)
                                        <button wire:click="openText('{{ $candidate->slug }}','y')" class="bg-transparent text-secondary font-bold">See all</button>
                                    @else
                                        <button wire:click="openText('{{ $candidate->slug }}','n')" class="bg-transparent text-secondary font-bold">See less</button>
                                    @endif
                                </p>

                                <div class="pt-12 pb-8">
                                    <button wire:click="openVote('{{ $candidate->slug }}')" class="bg-secondary hover:bg-transparent hover:border hover:border-secondary hover:text-secondary text-white font-bold py-2 px-4 rounded-full">
                                    Vote Now
                                    </button> 
                                </div>

                                
                                
                                <!-- Use https://simpleicons.org/ to find the svg for your preferred product --> 

                            </div>

                        </div>
                        
                        <!--Img Col-->
                        <div class="w-full lg:w-2/5">
                            <!-- Big profile image for side bar (desktop) -->
                            <img src="{{Storage::url($candidate->photo)}}" class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
                        </div>

                        <!-- Pin to top right corner -->
                        <div class="absolute top-0 right-0 h-12 w-18 p-4">
                            <p class="pt-4 font-bold flex items-center justify-center lg:justify-start uppercase text-3xl">
                               
                            </p>
                        </div>

                        <!-- Pin to left corner -->
                        @if($candidate->fb_link || $candidate->ig_link || $candidate->twitter_link)
                        <div class="absolute top-0 left-0 h-10 w-18 p-1 text-white">
                            <div class="flex justify-center gap-1 text-sm p-2">
                                @if($candidate->fb_link)
                                    <div><a target="_blank" href="{{ $candidate->fb_link }}"><i class="fab fa-facebook p-1 border rounded text-gray-200"></i></a></div>
                                @endif
                                @if($candidate->ig_link)
                                    <div><a target="_blank" href="{{ $candidate->ig_link }}"><i class="fab fa-instagram p-1 border rounded text-gray-200"></i></a></div>
                                @endif
                                @if($candidate->twitter_link)
                                    <div><a target="_blank" href="{{ $candidate->twitter_link }}"><i class="fab fa-twitter p-1 border rounded text-gray-200"></i></a></div>
                                @endif
                            </div>
                        </div>
                        @endif
                        

                    </div>
                </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button class="bg-transparent text-gray-400" wire:click="$toggle('viewCandidate')" wire:loading.attr="disabled">
                            Close
                        </x-jet-secondary-button>

                        <x-jet-button class="ml-2 bg-transparent border border-secondary" wire:click="openVote('{{ $candidate->slug }}')" wire:loading.class="bg-transparent">
                            Vote
                            <div wire:loading wire:target="openEdit">
                                <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                            </div>
                        </x-jet-button>
                </x-slot>
            </x-jet-dialog-modal>
        @endif



            <!-- Payment -->
        @if($vote_payment)
            <x-jet-dialog-modal wire:model="vote_payment">
                <x-slot name="title">
                    Voting Fee <span class="text-secondary">{{ $vote_amount }} {{ $currency }} for {{ number_format((int)$vote_count) }} vote(s)</span>
                </x-slot>

                <x-slot name="content">
                    <x-jet-validation-errors class="mb-4" />
                    <div class="p-4">
                        <h1 class="font-bold text-xl text-center">Payment Information</h1>
                    
                        <div class="my-2">
                            <h3 class="font-bold text-xl text-center">Select Currency</h3>
                            <select wire:model="currency" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm">
                                @if(is_array($currencies) || is_object($currencies))
                                @foreach($currencies as $c)
                                    <option value="{{$c->code}}">{{$c->name}} - {{$c->code}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="my-2">
                            <h3 class="font-bold text-xl text-center">Enter amount</h3>
                            <div class="mt-1">
                                <x-jet-label class="font-bold" for="name" value="{{ __('Amount') }}" />
                                <x-jet-input id="vote_amount" class="cam-amount block mt-1 w-full border-gray-400 text-gray-800" wire:model="vote_amount" type="text" name="vote_amount" :value="old('vote_amount')" required />
                            </div>
                        </div>
                    </div>
                    
                </x-slot>

                <x-slot name="footer">

                    <x-jet-button class="ml-2" wire:click="initiatePay()" wire:loading.class="bg-transparent">
                        Pay {{ $vote_amount }} {{ $currency }}
                        <div wire:loading wire:target="initiatePay">
                            <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                        </div>
                    </x-jet-button>
                </x-slot>
            </x-jet-dialog-modal>
        @endif


        @if($free_vote)
            <x-jet-dialog-modal wire:model="free_vote">
                <x-slot name="title">
                    @if(!$voted_already && !$vote_succesful)
                        Confirm Vote
                    @endif
                </x-slot>

                <x-slot name="content">

                    @if(!$voted_already && !$vote_succesful)
                        Vote for <span class="text-secondary uppercase font-semibold">{{ $candidate->name }} </span> ?
                    @endif

                    @if($voted_already)
                        <h1 class="text-center text-secondary uppercase text-3xl"> You already Voted! </h1>
                        <p class="text-center"><i class="fas fa-times animate-spin text-4xl text-red-600"></i></p>
                    @endif

                    @if($vote_succesful)
                        <h1 class="text-center text-secondary uppercase text-3xl"> You vote is Succesful </h1>
                        <p class="text-center"><i class="fas fa-check-circle animate-spin text-4xl text-green-600"></i></p>
                    @endif
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('free_vote')" wire:loading.attr="disabled">
                        Close
                    </x-jet-secondary-button>

                    @if(!$voted_already && !$vote_succesful)
                        <x-jet-button class="ml-2" wire:click="vote('{{ $candidate->slug }}')" wire:loading.class="bg-transparent">
                            Vote
                            <div wire:loading wire:target="vote">
                                <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                            </div>
                        </x-jet-button>
                    @endif
                </x-slot>
            </x-jet-dialog-modal>
        @endif
</div>
