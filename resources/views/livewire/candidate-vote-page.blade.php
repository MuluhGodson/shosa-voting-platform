<div>
        <div class="mx-auto my-32 lg:my-0 grid md:grid-cols-2 grid-cols-1">
                        
            <!--Img Col-->
            <div class="w-full">
                <!-- Big profile image for (desktop) -->
                <img src="{{Storage::url($candidate->photo)}}" class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
            </div>

            <!--Main Col-->
            <div class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none bg-black bg-opacity-75 mx-6 lg:mx-0">
            

                <div class="p-4 md:p-12 text-center lg:text-left">
                    <!-- Image for mobile view-->
                    <div class="block lg:hidden rounded-full object-top mx-auto -mt-16 h-48 w-48 bg-cover bg-center" style="background-image: url('{{Storage::url($candidate->photo)}}')"></div>
                    
                    <h1 class="text-2xl font-bold pt-8 lg:pt-0 text-secondary text-left uppercase">#{{ $candidate->candidate_number }} {{ $candidate->name }}</h1>
                    <div class="text-center">
                        <h3 class="text-xl text-white">{{ $vote_number }} vote(s)</h3>
                    </div>

                    <p class="py-5 text-white">
                        {{ Str::words($candidate->bio, $text_words , '...') }}
                         @if(!$showText)
                             <button wire:click="openText('{{ $candidate->slug }}','y')" class="bg-transparent text-secondary font-bold">See all</button>
                         @else
                             <button wire:click="openText('{{ $candidate->slug }}','n')" class="bg-transparent text-secondary font-bold">See less</button>
                         @endif
                     </p>

                

                    @if($candidate->fb_link || $candidate->ig_link || $candidate->twitter_link)
                        <div class="flex justify-center gap-1 text-sm px-5">
                            @if($candidate->fb_link)
                                <div><a class="mx-3" target="_blank" href="{{ $candidate->fb_link }}"><i class="fab fa-facebook p-1 border rounded text-gray-200 text-3xl"></i></a></div>
                            @endif
                            @if($candidate->ig_link)
                                <div><a class="mx-3" target="_blank" href="{{ $candidate->ig_link }}"><i class="fab fa-instagram p-1 border rounded text-gray-200 text-3xl"></i></a></div>
                            @endif
                            @if($candidate->twitter_link)
                                <div><a class="mx-3" target="_blank" href="{{ $candidate->twitter_link }}"><i class="fab fa-twitter p-1 border rounded text-gray-200 text-3xl"></i></a></div>
                            @endif
                        </div>
                    @endif

                    <div class="pt-12 pb-8 flex justify-center">                    
                        <x-jet-button class="ml-2 bg-secondary border border-secondary py-3 text-white" wire:click="openVote('{{ $candidate->slug }}')" wire:loading.class="bg-transparent">
                            Vote
                            <div wire:loading wire:target="openEdit">
                                <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                            </div>
                        </x-jet-button>
                    </div>
                </div>
            </div>
        </div>

    




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
