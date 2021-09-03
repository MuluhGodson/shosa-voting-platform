<div>
    <div class="p-4">
        <div>
            <x-jet-button wire:click="openCreate">
                {{__('Create Contest') }}
            </x-jet-button>
        </div>
    </div>

    <div class="my-4">
        <div class="grid sm:grid-cols-4 gap-4">
            @forelse ($contests as $cont)
                <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg transition hover:px-1 duration-500 ease-in-out  col rounded hover:border-r-2 hover:boder-r-white hover:border-l-2 hover:border-l-secondary cursor-pointer hover:transform hover:scale-150">
                    <div wire:click="openView('{{ $cont->slug }}')">
                        <img src="{{Storage::url($cont->cover_image)}}" class="object-cover object-top h-60 w-full" alt="{{$cont->name}}">
                        <div class="my-1 flex justify-end py-1 px-1">
                            @if(($cont->active) && ($cont->ending_date >= today()->toDateString()))
                                <small class="my-2 text-right px-2 rounded-full bg-secondary text-white">active</small>
                            @else
                                <small class="my-2 text-right px-2 rounded-full bg-red-600 text-white">inactive</small>
                            @endif
                        </div>
                        <div class="p-2 my-1">
                            <h1 class="text-center text-lg text-secondary font-bold uppercase">
                                {{ $cont->name }}
                            </h1>
                            <p class="text-gray-400 text-center">{{ Str::words(strip_tags($cont->description),15,'...') }}</p>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between content-end p-3">
                            <div>
                                <button wire:click="openEdit('{{ $cont->slug }}')"><i class="fas fa-edit text-secondary"></i></button>
                            </div>
                            <div>
                                <button wire:click="delete('{{ $cont->slug }}')"><i class="fas fa-trash text-red-500"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-400">No contest have been created yet.</p>
            @endforelse
        </div>
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
                        
                        <h1 class="text-xl font-bold pt-8 lg:pt-0 text-secondary text-justify uppercase">{{ $name }}</h1>
                        <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                        
                        <div>
                            <p class="text-base uppercase font-bold flex items-center justify-center lg:justify-start">
                                @if($fee)
                                    <small>PARTICIPATION: {{ $amount }}</small>
                                @else
                                    <small>PARTICIPATION: FREE</small>
                                @endif
                            </p>
                            <p class="text-base uppercase font-bold flex items-center justify-center lg:justify-start">
                                @if($tarrif)
                                    <small class="my-2">VOTING: {{ $vote_fee }}</small>
                                @else
                                    <small class="my-2">VOTING: FREE</small>
                                @endif
                            </p>
                            <p class="text-base uppercase font-bold flex items-center justify-center lg:justify-start">
                                <small>Duration: {{ $b_date }} - {{ $e_date }}</small>
                            </p>
                        </div>
                        <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                        <p class="pt-8 text-sm">
                            {{ Str::words(strip_tags($description), $text_words ,'...') }}
                            @if(!$showText)
                                <button wire:click="openText('{{ $slug }}','y')" class="bg-transparent text-secondary font-bold">See all</button>
                            @else
                                <button wire:click="openText('{{ $slug }}','n')" class="bg-transparent text-secondary font-bold">See less</button>
                            @endif
                        </p>

                        <div class="pt-12 pb-8">
                            <a href="{{ route('candidate.index', ['contest' => $slug]) }}" class="bg-secondary hover:bg-transparent hover:border hover:border-secondary hover:text-secondary text-white font-bold py-2 px-4 rounded-full">
                            View Candidates
                            </a> 
                        </div>

                        
                        
                        <!-- Use https://simpleicons.org/ to find the svg for your preferred product --> 

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
                            <small class="my-2 text-right px-2 rounded-full bg-secondary text-white">active</small>
                        @else
                            <small class="my-2 text-right px-2 rounded-full bg-red-600 text-white">inactive</small>
                        @endif
                    </p>
                </div>
                

            </div>
        </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button class="bg-transparent text-gray-400" wire:click="$toggle('viewContest')" wire:loading.attr="disabled">
                    Close
                </x-jet-secondary-button>

                <x-jet-button class="ml-2 bg-transparent border border-secondary" wire:click="openEdit('{{ $slug }}')" wire:loading.class="bg-transparent">
                    Edit
                    <div wire:loading wire:target="openEdit">
                        <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                    </div>
                </x-jet-button>
                <x-jet-danger-button class="ml-2" wire:click="delete('{{ $slug }}')" wire:loading.class="bg-transparent">
                    Delete
                    <div wire:loading wire:target="delete">
                        <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                    </div>
                </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
@endif

@if($createContest)
    <!-- Modal to create a new contest -->
    <x-jet-dialog-modal wire:model="createContest">
        

        <x-slot name="title">
            Create Contest
        </x-slot>

        <x-slot name="content">
             <x-jet-validation-errors class="mb-4" />

            <div class="text-left">
                <label for="active" class="flex mt-1 gap-3 items-center">
                    <x-jet-checkbox wire:model="active" id="active" class="" name="active" />
                    <x-jet-label class="font-bold" for="active" value="{{ __('Active') }}" />
                </label>
            </div>

            <div class="mt-4">
                <x-jet-label class="font-bold" for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="name" type="text" name="name" :value="old('name')" required />
            </div>

            <div class="mt-4">
                <x-jet-label class="font-bold" for="currency" value="{{ __('Currency') }}" />
                <select wire:model="currency" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm">
                    <option>Select a Currency</option>
                    @forelse ($currencies as $cur)
                        <option value="{{ $cur->code }}">{{ $cur->name }} - ({{ $cur->symbol }})</option>
                    @empty
                        No Currencies available yet
                    @endforelse
                </select>
            </div>

            <div class="mt-4">
                <small>Leave this box checked if contestants need to pay a registration fee before participating in this contest.</small>
                <div class="">
                    <div>
                        <label for="fee" class="flex mt-1 gap-3 items-center">
                            <x-jet-checkbox wire:model="fee" id="fee" class="" name="fee" />
                            <x-jet-label class="font-bold" for="fee" value="{{ __('Registration Fee') }}" />
                        </label>
                    </div>
                    @if($fee)
                        <div class="">                       
                            <div>
                                <x-jet-label class="font-bold" for="amount" value="{{ __('Amount for Registration') }}" />
                                <x-jet-input id="amount" class="cam-amount block mt-1 w-full border-gray-400 text-gray-800" wire:model="amount" type="text" name="amount" :value="old('amount')" required />
                                <small>Amount in {{ $currency }}</small>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <div class="mt-4">
                    <small>Select this box if voters need to pay to vote.</small>
                    <div class="">
                        <div>
                            <label for="fee" class="flex mt-1 gap-3 items-center">
                                <x-jet-checkbox wire:model="tarrif" id="vote_fee" class="" name="tarrif" />
                                <x-jet-label class="font-bold" for="tarrif" value="{{ __('Pay to Vote') }}" />
                            </label>
                        </div>
                        @if($tarrif)
                            <small>Set the amount per vote(s).</small>
                            <div class="grid md:grid-cols-2 mt-1 gap-4">
                                <div>
                                    <x-jet-label class="font-bold" for="vote_count" value="{{ __('Number of Votes') }}" />
                                    <x-jet-input id="vote_count" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="vote_count" type="number" name="vote_count" :value="old('vote_count')" />

                                </div>
                            
                                <div>
                                    <x-jet-label class="font-bold" for="vote_fee" value="{{ __('Amount per vote(s)') }}" />
                                    <x-jet-input id="vote_fee" class="cam-amount block mt-1 w-full border-gray-400 text-gray-800" wire:model="vote_fee" type="text" name="vote_fee" :value="old('vote_fee')" />
                                    <small>Amount in {{ $currency }}</small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div wire:ignore class="mt-4">
                <x-jet-label class="font-bold" for="description" value="{{ __('Description') }}" />
                <small>Give details about this contest.</small>
                <div class="bg-gray-100 rounded">
                    <textarea wire:model.defer="description" wire:model="description" class="summernote block mt-1 w-full text-gray-100 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4 mt-4 grid-cols-1">
                <div class="mt-2">
                    <x-jet-label class="font-bold" for="b_date" value="{{ __('Beginning Date') }}" />
                    <x-jet-input id="b_date" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="b_date" type="date" name="b_date" :value="old('b_date')" required />
                </div>
                <div class="mt-2">
                    <x-jet-label class="font-bold" for="e_date" value="{{ __('Ending Date') }}" />
                    <x-jet-input id="e_date" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="e_date" type="date" name="e_date" :value="old('e_date')" required />
                </div>
            </div>


            <div class="my-4">
                <x-jet-label class="font-bold" for="cover" value="{{ __('Cover Image') }}" />
                <small>Upload a cover art for this contest.</small>
                <x-jet-input id="cover" class="block mt-1 w-full border-gray-400 text-gray-400" wire:model="cover" type="file" name="cover" :value="old('cover')" required />
                @if ($cover)
                    Cover Preview:
                    <img width="200px" src="{{ $cover->temporaryUrl() }}">
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('createContest')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="create" wire:loading.class="bg-transparent">
                Create
                <div wire:loading wire:target="create">
                    <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                </div>
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
@endif

@if($editContest)
     <!-- Modal to edit a contest -->
    <x-jet-dialog-modal wire:model="editContest">
        

        <x-slot name="title">
            Edit Contest
        </x-slot>

        <x-slot name="content">
             <x-jet-validation-errors class="mb-4" />

            <div class="text-left">
                <label for="active" class="flex mt-1 gap-3 items-center">
                    <x-jet-checkbox wire:model="active" id="active" class="" name="active" />
                    <x-jet-label class="font-bold" for="active" value="{{ __('Active') }}" />
                </label>
            </div>

            <div class="mt-4">
                <x-jet-label class="font-bold" for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="name" type="text" name="name" :value="old('name')" required />
            </div>

            <div class="mt-4">
                <x-jet-label class="font-bold" for="currency" value="{{ __('Currency') }}" />
                <select wire:model="currency" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm">
                    <option>Select a Currency</option>
                    @forelse ($currencies as $cur)
                        <option value="{{ $cur->code }}">{{ $cur->name }} - ({{ $cur->symbol }})</option>
                    @empty
                        No Currencies available yet
                    @endforelse
                </select>
            </div>

            <div class="mt-4">
                <small>Select this box if contestants need to pay a registration fee before participating in this contest.</small>
                <div class="">
                    <div>
                        <label for="fee" class="flex mt-1 gap-3 items-center">
                            <x-jet-checkbox wire:model="fee" id="fee" class="" name="fee" />
                            <x-jet-label class="font-bold" for="fee" value="{{ __('Registration Fee') }}" />
                        </label>
                    </div>
                    @if($fee)
                        <div class="">                       
                            <div>
                                <x-jet-label class="font-bold" for="amount" value="{{ __('Amount for Registration') }}" />
                                <x-jet-input id="amount" class="cam-amount block mt-1 w-full border-gray-400 text-gray-800" wire:model="amount" type="text" name="amount" :value="old('amount')" required />
                                <small>Amount in {{ $currency }}</small>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <div class="mt-4">
                    <small>Select this box if voters need to pay to vote.</small>
                    <div class="">
                        <div>
                            <label for="fee" class="flex mt-1 gap-3 items-center">
                                <x-jet-checkbox wire:model="tarrif" id="vote_fee" class="" name="tarrif" />
                                <x-jet-label class="font-bold" for="tarrif" value="{{ __('Pay to Vote') }}" />
                            </label>
                        </div>
                        @if($tarrif)
                            <small>Set the amount per vote(s).</small>
                            <div class="grid md:grid-cols-2 mt-1 gap-4">
                                <div>
                                    <x-jet-label class="font-bold" for="vote_count" value="{{ __('Number of Votes') }}" />
                                    <x-jet-input id="vote_count" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="vote_count" type="number" name="vote_count" :value="old('vote_count')" />

                                </div>
                            
                                <div>
                                    <x-jet-label class="font-bold" for="vote_fee" value="{{ __('Amount per vote(s)') }}" />
                                    <x-jet-input id="vote_fee" class="cam-amount block mt-1 w-full border-gray-400 text-gray-800" wire:model="vote_fee" type="text" name="vote_fee" :value="old('vote_fee')" />
                                    <small>Amount in {{ $currency }}</small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div wire:ignore class="mt-4">
                <x-jet-label class="font-bold" for="description" value="{{ __('Description') }}" />
                <small>Give details about this contest.</small>
                <div class="bg-gray-100 rounded">
                    <textarea wire:model.defer="description" wire:model="description" class="summernote block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4 mt-4 grid-cols-1">
                <div class="mt-2">
                    <x-jet-label class="font-bold" for="b_date" value="{{ __('Beginning Date') }}" />
                    <x-jet-input id="b_date" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="b_date" type="date" name="b_date" :value="old('b_date')" required />
                </div>
                <div class="mt-2">
                    <x-jet-label class="font-bold" for="e_date" value="{{ __('Ending Date') }}" />
                    <x-jet-input id="e_date" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="e_date" type="date" name="e_date" :value="old('e_date')" required />
                </div>
            </div>


            <div class="my-4">
                <x-jet-label class="font-bold" for="cover" value="{{ __('Cover Image') }}" />
                <small>Upload a cover art for this contest.</small>
                <x-jet-input id="cover" class="block mt-1 w-full border-gray-400 text-gray-400" wire:model="cover" type="file" name="cover" :value="old('cover')" required />
                @if($cover)
                    Cover Preview:
                    <img width="200px" src="{{ $cover->temporaryUrl() }}">
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('editContest')" wire:loading.attr="disabled">
                Nevermind
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


<script>
	window.addEventListener('enter-amount', event => {
        $('.cam-amount').toArray().forEach(function(field){
            var cleave = new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            })
        })
	});
</script>

<!-- Summernote init -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

  <script>
  	window.addEventListener('summer-editor', event => {
		$('.summernote').summernote({
	        placeholder: 'Give details about this contest',
	        tabsize: 2,
	        height: 300,
            spellCheck: true,
            dialogsInBody: true,
            dialogsFade: true ,
	        toolbar: [
	          ['font', ['bold', 'underline', 'clear']],
	          ['para', ['ul', 'ol', 'paragraph']],
              ['insert', ['link', 'video']]
              
	        ],
	        callbacks: {
		        onChange: function(e) {
		              @this.set('description', e);
		        },
			}
      	});
  	});
  </script>

</div>
