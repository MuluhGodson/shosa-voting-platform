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

            <div class="mt-4">
                 <x-jet-label class="font-bold" for="pob" value="{{ __('Division of Origin') }}" />
                 <livewire:utils.location :lt="null"/>
            </div>

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
                        <h1 class="font-bold text-xl text-center">Payment Method</h1>
                    @endif
                        <div class="p-3 my-2">
                        
                            <div class="flex justify-between space-x-4 content-center {{$isLocal || $isIntl ? 'hidden' : 'block'}}">
                                <div class="justify-self-center p-2">
                                    <button wire:click="getPaymentType('1')" class="font-bold">
                                        <p class="text-center text-sm">In Cameroon?</p>
                                        <img src="{{ asset('images/local.jpeg') }}" class="rounded w-4/5 object-cover" alt="">
                                    </button>
                                </div>

                                <div class="justify-self-center p-2">
                                    <button wire:click="getPaymentType('2')" class="font-bold">
                                        <p class="text-center text-sm">Not in Cameroon?</p>
                                        <img src="{{ asset('images/paypal.jpg') }}" class="rounded w-4/5" alt="">
                                    </button>
                                </div>              
                            </div>

                            @if($isLocal && !$payStatus)
                                <div class="mt-4">
                                    <x-jet-label class="font-bold" for="momo-tel" value="{{ __('Momo Number') }}" />
                                    <small class="text-gray-500">Both Orange and MTN are accepted </small>
                                    <x-jet-input wire:loading.attr="disabled" wire:loading.class="bg-gray-600 disabled" wire:target="initiatePay()" id="momo-tel" class="cam-tel block mt-1 w-full border-gray-400 text-gray-800" wire:model="momo_tel" type="text" name="momo-tel" :value="old('momo-tel')" required />
                                </div>
                                <div class="mt-4">
                                    <x-jet-label class="font-bold" for="momo-tel" value="{{ __('Amount') }}" />
                                    <small class="text-gray-500">Charges may apply </small>
                                    <x-jet-input id="fee_amount" disabled class="block mt-1 w-full bg-gray-600 border-gray-400 disabled text-gray-300" wire:model="fee_amount" type="text" name="fee_amount" :value="old('fee_amount')" required />
                                </div>
                            @endif

                            @if($isIntl)
                                <div class="mt-4">
                                    <x-jet-label class="font-bold" for="currency" value="{{ __('Choose your preffered currency') }}" />
                                    <select wire:model="currency" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm">
                                        <option>Select a Currency</option>
                                        @forelse ($currencies as $cur)
                                            <option value="{{ $cur->code }}">{{ $cur->name }} - ({{ $cur->symbol }})</option>
                                        @empty
                                            No Currencies available yet
                                        @endforelse
                                    </select>
                                 </div>
                            @endif
                
                        </div>
                    </div> 

                    @if($isLocal)
                        <div wire:loading wire:target="initiatePay" class="w-full">
                            <div class="grid grid-cols-1 justify-items-center  justify-center">
                                <div>
                                <p class="text-gray-400 text-center"> Check your phone to authorize the payment. Do not use the back button. </p>
                                </div>
                                <div>
                                    <img src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($isIntl)
                        <div wire:loading wire:target="initiatePay" class="w-full">
                            <div class="grid grid-cols-1 justify-items-center  justify-center">
                                <div>
                                <p class="text-gray-400 text-center"> Do not close this window. You will be redirected to a payment service for Visa/Mastercard payments </p>
                                </div>
                                <div>
                                    <img src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                                </div>
                            </div>
                        </div>
                    @endif


                    @if($payStatus)
                        <h1 class="text-center text-secondary uppercase text-3xl"> Payment succesful </h1>
                        <p class="text-center"><i class="fas fa-check-circle animate-spin text-4xl text-green-600"></i></p>
                        <p class="text-center">Wait a moment...</p>
                    @endif
                        
                    
                </x-slot>

                <x-slot name="footer">
                    @if(($isLocal || $isIntl) && !$payStatus)
                       <x-jet-button class="ml-2" wire:click="initiatePay()" wire:loading.class="bg-transparent">
                            Pay {{ $fee_amount }}
                            <div wire:loading wire:target="initiatePay">
                                <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                            </div>
                        </x-jet-button>
                    @endif
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

        <script>
            
            var em = "{{$this->email}}";
            var nm = "{{$this->name}}";
            var cr = "{{$this->currency}}";
            var am = "{{$this->fee_amount}}";

            window.addEventListener('flutterpay', event => {  
                    console.log(event.detail.em);
                    console.log(event.detail.nm);
                    console.log(event.detail.cr);
                    console.log(event.detail.am);
                    FlutterwaveCheckout({
                        public_key: event.detail.pub,
                        tx_ref: event.detail.refs,
                        amount: event.detail.am,
                        currency: event.detail.cr,
                        //country: "",
                        payment_options: "card, mobilemoneyghana, mobilemoneyrwanda, ussd, mpesa, mobilemoneyzambia, qr, mobilemoneyuganda, mobilemoneytanzania",
                        //redirect_url: // specified redirect URL
                        //"",
                        meta: {
                        consumer_id: 23,
                        consumer_mac: "92a3-912ba-1192a",
                        },
                        customer: {
                        email: event.detail.em,
                        phone_number: "",
                        name: event.detail.nm,
                        },
                        callback: function (data) {
                        window.Livewire.emit('flutterTrans', data);
                        console.log(data);
                        },
                        onclose: function() {
                        window.Livewire.emit('flutterClose');
                        },
                        customizations: {
                        title: event.detail.des,
                        description: event.detail.des,
                        logo: "{{ asset('images/logo/logo.png') }}",
                        },
                    });      
            });
        </script>

        



</div>
