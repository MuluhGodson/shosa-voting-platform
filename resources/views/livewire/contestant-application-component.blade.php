<div>
    <!-- Modal to create a new contest -->
    
        <div class="flex flex-col sm:justify-center items-center bg-black">
            <div>
                <x-jet-authentication-card-logo />
            </div>
        </div>
       
        <x-jet-validation-errors class="mb-4" />

       
            <p class="text-center font-semibold text-gray-300">Fill the form below to apply for <span class="text-secondary">{{ $contest->name }}</span></p>
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
                    <x-jet-label class="font-bold" for="dob" value="{{ __('Date of Birth') }}" />
                    <x-jet-input id="dob" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="dob" type="date" name="dob" :value="old('dob')" required />
                </div>
            </div>

           {{-- <div class="mt-4">
                 <x-jet-label class="font-bold" for="pob" value="{{ __('Division of Origin') }}" />
                 <livewire:utils.location :lt="null"/>
            </div> --}}

            <div class="mt-4">
                <x-jet-label class="font-bold" for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="email" type="text" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label class="font-bold" for="tel" value="{{ __('Telephone') }}" />
                <x-jet-input id="tel" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="tel" type="text" name="tel" :value="old('tel')" required />
            </div>

            <div class="mt-4">
                <x-jet-label class="font-bold" for="height" value="{{ __('Height') }}" />
                <div class="flex flex-row gap-4 justify-between">
                    <x-jet-input id="height" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="height" type="text" name="height" :value="old('height')" required />
                    <select wire:model="h_unit" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="m">m</option>
                        <option value="cm">cm</option>
                    </select>
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
                <x-jet-label class="font-bold" for="profession" value="{{ __('Profession') }}" />
                <x-jet-input id="profession" class="block mt-1 w-full border-gray-400 text-gray-800" wire:model="profession" type="text" name="profession" :value="old('profession')" required />
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

            <div class="flex justify-end gap-4">
                <a href="{{ route('apply') }}" class="bg-transparent rounded border text-gray-400 hover:text-gray-600 px-2">
                    Cancel
                </a>

                <x-jet-button class="ml-2" wire:click="apply('{{ $contest->slug }}')" wire:loading.class="bg-transparent">
                    Apply
                    <div wire:loading wire:target="register">
                        <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                    </div>
                </x-jet-button>
            </div>


            <!-- Payment -->
        @if($fee_payment)
            <x-jet-dialog-modal wire:model="fee_payment">
                <x-slot name="title">
                    Registration Fee <span class="text-secondary">{{ $fee_amount }} {{ $currency }}</span>
                </x-slot>

                <x-slot name="content">
                    
                    <div class="p-4">
                    @if(!$payStatus)
                        <h1 class="font-bold text-xl text-center">Select Currency</h1>
                        <select wire:model="currency" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm">
                            @if(is_array($currencies) || is_object($currencies))
                            @foreach($currencies as $c)
                                <option value="{{$c->code}}">{{$c->name}} - {{$c->code}}</option>
                            @endforeach
                            @endif
                        </select>
                    @endif
                        
                    </div>             
                </x-slot>

                <x-slot name="footer">
                    <x-jet-button class="ml-2" wire:click="initiatePay()" wire:loading.class="bg-transparent">
                        Pay {{ $fee_amount }} {{ $currency }}
                        <div wire:loading wire:target="initiatePay">
                            <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                        </div>
                    </x-jet-button>
                </x-slot>
            </x-jet-dialog-modal>
        @endif

        
        


        <script>
            window.addEventListener('tel-number', event => {
                var cleave = new Cleave('.cam-tel', {
                    prefix: '+237',
                    phone: true,
                    phoneRegionCode: 'cm'
                })
            });
        </script>

        <script>
            $('textarea').on("input", function(){  
                let maxlength = $('textarea').attr("maxlength");
                let currentLength = $('textarea').val().length;
                $('#charCount').text(maxlength - currentLength + ' charecters left');
                if( currentLength >= maxlength ){
                    $('#charCount').text(maxlength - currentLength + ' charecters left');
                }
            });
        </script>
</div>
