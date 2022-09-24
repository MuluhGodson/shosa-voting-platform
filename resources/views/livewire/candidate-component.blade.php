<div>
    <div class="p-4">
        <div>
            <a href="{{ route('apply') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-gray-200 text-xs uppercase tracking-widest bg-secondary hover:bg-transparent hover:border-secondary hover:text-secondary active:bg-gray-900 focus:outline-none focus:border-secondary focus:ring focus:ring-secondary disabled:opacity-25 transition">
                {{__('Add Contestant') }}
            </a>
        </div>
    </div>

        <div class="my-4">
        <div class="grid sm:grid-cols-4 gap-4">
            @forelse ($contest->candidates as $cand)
                <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg transition hover:px-1 duration-500 ease-in-out  col rounded hover:border-r-2 hover:boder-r-white hover:border-l-2 hover:border-l-secondary cursor-pointer hover:transform hover:scale-150">
                    <div wire:click="openCandidate('{{ $cand->slug }}')">
                        <img src="{{Storage::url($cand->photo)}}" class="object-cover object-top h-60 w-full" alt="{{$cand->name}}">
                        <div class="my-1 flex justify-center gap-4 py-1 px-1">
                            {{--<p class="text-sm text-gray-400"><i class="fas fa-birthday-cake"></i>  {{ $cand->dob  }}</p>
                            <p class="text-sm text-gray-400"><i class="fas fa-city"></i> {{ $cand->town }}</p>--}}
                         
                        </div>
                        <div class="p-2 my-1">
                            <h1 class="text-center text-lg text-secondary font-bold uppercase">
                                <span class="text-gray-300">#{{ $cand->candidate_number }}</span> {{ $cand->name }}
                            </h1>
                           {{-- <pclass="text-gray-400text-center">Str::words($cand->bio,15,'...') --}}
                        </div>

                        
                    </div>
                   
                    <div>
                        <div class="flex justify-between content-end p-3">
                            <div>
                                <button wire:click="openEdit('{{ $cand->slug }}')"><i class="fas fa-edit text-secondary"></i></button>
                            </div>
                            <div>
                                <button wire:click="delete('{{ $cand->slug }}')"><i class="fas fa-trash text-red-500"></i></button>
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
                                        Email: {{ $candidate->email }}
                                    </p>
                                    <p>
                                        Tel: {{ $candidate->tel }}
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
                                    <a href="" class="bg-secondary hover:bg-transparent hover:border hover:border-secondary hover:text-secondary text-white font-bold py-2 px-4 rounded-full">
                                    View Votes
                                    </a> 
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
                               #<span class="text-secondary"> {{ $candidate->candidate_number }}</span>
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

                        <x-jet-button class="ml-2 bg-transparent border border-secondary" wire:click="openEdit('{{ $candidate->slug }}')" wire:loading.class="bg-transparent">
                            Edit
                            <div wire:loading wire:target="openEdit">
                                <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                            </div>
                        </x-jet-button>
                        <x-jet-danger-button class="ml-2" wire:click="delete('{{ $candidate->slug }}')" wire:loading.class="bg-transparent">
                            Delete
                            <div wire:loading wire:target="delete">
                                <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                            </div>
                        </x-jet-danger-button>
                </x-slot>
            </x-jet-dialog-modal>
        @endif

        @if($editCandidate)
            <!-- Modal to edit candidate -->
            <x-jet-dialog-modal class="bg-transparent" wire:model="editCandidate">
                <x-slot name="title">
                    
                </x-slot>

                <x-slot name="content">

                           <x-jet-validation-errors class="mb-4" />

       
            <p class="text-center font-semibold text-gray-300">Update information for <span class="text-secondary">{{ $name }}</span></p>
            <div class="mt-4">
                <x-jet-label class="font-bold" for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="name" type="text" name="name" :value="old('name')" required />
            </div>

            <div class="mt-4 grid md:grid-cols-2 grid-cols-1 gap-4 justify-between">
                <div class="mt-2">
                    <x-jet-label class="font-bold" for="currency" value="{{ __('Gender') }}" />
                    <select wire:model="gender" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm">
                        <option>Select a gender</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
                <div class="mt-2">
                    <x-jet-label class="font-bold" for="candidatenum" value="{{ __('Candidate Number') }}" />
                    <x-jet-input id="candidate_number" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="candidate_number" type="text" name="candidate_number" :value="old('candidate_number')" required />
                </div>

            </div>

            <div class="mt-4 grid md:grid-cols-2 grid-cols-1 gap-4 justify-between">
                <div class="mt-4">
                    <x-jet-label class="font-bold" for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="email" type="text" name="email" :value="old('email')" required />
                </div>

                <div class="mt-4">
                    <x-jet-label class="font-bold" for="tel" value="{{ __('Telephone') }}" />
                    <x-jet-input id="tel" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="tel" type="text" name="tel" :value="old('tel')" required />
                </div>
            </div>


            <div class="mt-4">
                <x-jet-label class="font-bold" for="bio" value="{{ __('Bio') }}" />
                <small class="text-gray-500">Tell us about yourself. (max 1000 characters)</small>
                <div class="bg-gray-100 rounded">
                    <textarea rows="10" maxlength="1000" wire:model="bio" class="summernote block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                </div>
                <small class="text-right text-gray-400" id="charCount"></small>
            </div>


            <div class="mt-4">
                <x-jet-label class="font-bold" for="town" value="{{ __('Town') }}" />
                 <small class="text-gray-500">Which town do you live in?</small>
                <x-jet-input id="town" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="town" type="text" name="town" :value="old('town')" required />
            </div>



            <div class="mt-4 grid md:grid-cols-3 grid-cols-1 gap-4 justify-between">
                <div class="mt-1">
                    <x-jet-label class="font-bold" for="instagram" value="{{ __('Instagram Account') }}" />
                    <small class="text-gray-500"><i class="fab fa-instagram"></i> Link to your Instagram account </small>
                    <x-jet-input id="instagram" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="instagram" type="text" name="instagram" :value="old('instagram')" required />
                </div>

                <div class="mt-1">
                    <x-jet-label class="font-bold" for="facebook" value="{{ __('Facebook Account') }}" />
                    <small class="text-gray-500"><i class="fab fa-facebook"></i>  Link to your Facebook account </small>
                    <x-jet-input id="facebook" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="facebook" type="text" name="facebook" :value="old('facebook')" required />
                </div>

                <div class="mt-1">
                    <x-jet-label class="font-bold" for="twitter" value="{{ __('Twitter Account') }}" />
                    <small class="text-gray-500"><i class="fab fa-twitter"></i> Link to your Twitter account </small>
                    <x-jet-input id="twitter" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="twitter" type="text" name="twitter" :value="old('twitter')" required />
                </div>
            </div>


            <div class="my-4">
                <x-jet-label class="font-bold" for="cover" value="{{ __('Photo') }}" />
                <small class="text-gray-500">Upload a photo of yourself for this contest.</small>
                <x-jet-input id="cover" class="block mt-1 w-full border-gray-400 text-gray-400" wire:model="cover" type="file" name="cover" :value="old('cover')" required />
                @if ($cover)
                    Photo Preview:
                    <img width="200px" src="{{ $cover->temporaryUrl() }}">
                @endif
            </div>

                </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button class="bg-transparent text-gray-400" wire:click="$toggle('editCandidate')" wire:loading.attr="disabled">
                            Close
                        </x-jet-secondary-button>

                        <x-jet-button class="ml-2" wire:click="update('{{ $slug }}')" wire:loading.class="bg-transparent">
                            Update
                            <div wire:loading wire:target="update">
                                <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                            </div>
                        </x-jet-button>
                </x-slot>
            </x-jet-dialog-modal>
        @endif
</div>
