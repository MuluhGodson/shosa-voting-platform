
            <div class="p-4">
              <h1 class="font-bold text-xl text-center">Payment Method</h1>

              <div class="p-3 my-2">
                  <label for="name">Name</label>
                  <input wire:model="donName" id="name" type="text" placeholder="Enter your name" autocomplete="" class="w-full  @error('donName') bg-red-200 @enderror border-b-3 outline-none shadow-none focus:shadow-none border-0 p-3 rounded focus:ring-0 focus:outline-none">
                  @error('donName') <span class="text-red-500"><br>{{ $message }}</span> @enderror
                </div>
                <div class="p-3 my-2">
                  <label for="email">Email</label>
                  <input wire:model="donEmail" id="email" type="text" placeholder="Enter your email" autocomplete="" class="w-full  @error('donEmail') bg-red-200 @enderror border-b-3 outline-none shadow-none focus:shadow-none border-0 p-3 rounded focus:ring-0 focus:outline-none">
                  @error('donEmail') <span class="text-red-500"><br>{{ $message }}</span> @enderror
                </div>
                <div class="p-1 mx-3 my-1">
                  <input type="checkbox" wire:model="donAnon" value="1" class="h-4 w-4 text-pink-600 rounded focus:outline-none focus:ring-0"><span class="ml-2 text-gray-700">Hide my name from everyone except the organizer of this fundraiser.</span>
                </div>

              <div class="">
                  <div class="flex justify-between space-x-4 content-center {{$isLocal || $isIntl ? 'hidden' : 'block'}}">
                    <div class="justify-self-center border p-2 bg-gray-200">
                      <button wire:click="getPaymentType('1')" class="font-bold text-black">
                        <p class="text-center text-sm">In Cameroon? Donate with</p>
                        <img src="{{ asset('images/local.jpeg') }}" class="rounded w-4/5 object-cover" alt="">
                      </button>
                    </div>

                    <div class="justify-self-center border p-2 bg-gray-200">
                      <button wire:click="getPaymentType('2')" class="font-bold text-black">
                        <p class="text-center text-sm">Not in Cameroon? Donate with</p>
                        <img src="{{ asset('images/paypal.jpg') }}" class="rounded w-4/5" alt="">
                      </button>
                    </div>              
                  </div>

                @if($isLocal)
                  <div class="p-3 my-5">
                    <label for="amount">How much will you like to donate?</label>
                    <input wire:model="donAmount" type="text" placeholder="Enter amount" class="cam-amount  @error('donAmount') bg-red-200 @enderror w-full text-green-500 text-xl focus:text-4xl font-semibold border-b-3 outline-none shadow-none focus:shadow-none border-0 p-3 rounded focus:ring-0 focus:outline-none">
                    @error('donAmount') <span class="text-red-500"><br>{{ $message }}</span> @enderror
                  </div>
                  <div class="p-3 my-2">
                    <label for="tel">Mobile Money number (MTN or Orange)</label>
                    <input wire:model="donTel" type="text" placeholder="Enter momo number" class="cam-tel @error('donTel') bg-red-200 @enderror w-full border-b-3 outline-none shadow-none focus:shadow-none border-0 p-3 rounded focus:ring-0 focus:outline-none">
                    @error('donTel') <span class="text-red-500"><br>{{ $message }}</span> @enderror
                  </div>
                  
                  <div class="flex justify-center">
                      <button wire:click.prevent="momoDonate()" type="button" class="w-full p-4 bg-pink-500 text-white rounded">
                          Donate {{$donAmount}}
                          <div class="my-auto float-right" wire:loading wire:target="upload">
                            <img class="mx-2" width="20px" src="">
                          </div>
                      </button>
                  </div>
                @endif

                @if($isIntl)
                  <div class="p-3 my-2">
                      <label for="currency">Select Currency</label>
                      <select wire:model="currency" class="w-full border-b-3 outline-none shadow-none focus:shadow-none border-0 p-3 rounded focus:ring-0 focus:outline-none">
                        @if(is_array($moneyCurrencies) || is_object($moneyCurrencies))
                        @foreach($moneyCurrencies as $moneyCurrency)
                          <option value="{{$moneyCurrency->code}}">{{$moneyCurrency->name}} - {{$moneyCurrency->code}}</option>
                        @endforeach
                        @endif
                      </select>
                      <div class="p-3 my-5">
                        <label for="amount">How much will you like to donate?</label>
                        <input wire:model="donAmount" type="text" placeholder="Enter amount" class="cam-amount  @error('donAmount') bg-red-200 @enderror w-full text-green-500 text-xl focus:text-4xl font-semibold border-b-3 outline-none shadow-none focus:shadow-none border-0 p-3 rounded focus:ring-0 focus:outline-none">
                        @error('donAmount') <span class="text-red-500"><br>{{ $message }}</span> @enderror
                      </div>
                      <button wire:click.prevent="callFlutter()" type="button" class="w-full my-2 p-4 bg-black text-white rounded">
                          Proceed
                          <div class="my-auto float-right" wire:loading wire:target="upload">
                            <img class="mx-2" width="20px" src="">
                          </div>
                      </button>
                  </div>
                @endif
                
              </div>
            </div>   
            <hr>
        <div class="bg-gray-100 px-4 py-3 sm:px-6">
          <span class="mt-7 p-2 flex justify-items-center w-full rounded-md shadow-lg sm:mt-0 sm:w-auto">         
           {{-- <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Cancel
            </button> --}}
            @if($isLocal)
              <div class="flex justify-center w-3/5 border p-2 bg-gray-200">
                <button wire:click="getPaymentType('2')" class="font-bold text-black">
                  <p class="text-center text-sm">Not in Cameroon? Donate with</p>
                  <img src="{{ asset('images/paypal.jpg') }}" class="rounded w-4/5" alt="">
                </button>
              </div>
            @endif
              
          </span>
        </div>

        
 


<script>
            var em = "{{$this->email}}";
            var nm = "{{$this->name}}";
            var cr = "{{$this->currency}}";
            var am = "{{$this->fee_amount}}";

     window.addEventListener('flutterpay', event => {  
            console.log('HEre');
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
                  location.reload();
                },
                customizations: {
                  title: event.detail.des,
                  description: event.detail.des,
                  //logo: "",
                },
              });      
     });
</script>