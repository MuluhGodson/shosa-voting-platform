<div>
     <div>
        <x-jet-button wire:click="withdrawModal">
            {{__('Withdraw') }}
        </x-jet-button>
    </div>

    
        <div  class="my-5">
            <div class="grid md:grid-cols-3 grid-cols-1  gap-4">
                @forelse ($balance as $b)
                    <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg rounded border-t-2 border-t-secondary border-b-2 border-b-secondary">
                            <div class="my-1 flex justify-around py-1 px-1">
                                @if($b['provider'] == 'ORANGE')
                                    <div class="rounded-full"> 
                                        <img src="{{ asset('images/orange.png') }}" width="50px">
                                    </div>
                                @elseif($b['provider'] == 'MTN')
                                    <div class="rounded-full">
                                        <img src="{{ asset('images/mtn.jpg') }}" width="50px" height="50px">
                                    </div>
                                @else
                                    <img src="" width="50px">
                                @endif
                                <div>
                                    <small class="my-2 px-2 text-right rounded bg-secondary text-white uppercase">{{ $b['provider'] }}</small>
                                </div>
                            </div>
                            <div class="p-2 my-1">
                                <h1 class="text-center text-lg text-secondary font-bold uppercase">
                                    {{ $b['value'] }} {{ $b['currency'] }}
                                </h1>
                                <p class="text-gray-400 text-center">{{ $b['service_name'] }}</p>
                            </div>
                    </div>
                @empty
                    <p class="text-gray-400">No Finance data available yet.</p>
                @endforelse
                <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg rounded border-t-2 border-t-secondary border-b-2 border-b-secondary">
                    <div class="my-1 flex justify-between py-1 px-1">
                        <div class="rounded-full">
                            <img src="{{ asset('images/paypal.jpg') }}" width="100px">
                        </div>
                        <div>
                            <small class="my-2 text-right px-2 rounded bg-secondary text-white uppercase">FlutterWave</small>
                        </div>
                    </div>
                    <div class="p-2 my-1">
                        <h1 class="text-center text-lg text-secondary font-bold uppercase">
                                NAN
                        </h1>
                        <p class="text-gray-400 text-center">Visa/Mastercard/International</p>
                    </div>
                </div>
            </div>
        </div>

        @if(Session::has('message'))
            <p class="uppercase text-red-500 bg-red-200 w-auto p-4 text-center">{{ Session::get('message') }}</p>
        @endif
        @if(Session::has('message_success'))
            <p class="uppercase text-green-600 font-bold bg-green-100 w-auto p-4 text-center">{{ Session::get('message_success') }}</p>
        @endif

        <div>
        <section class="container mx-auto p-6 font-mono">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-400 uppercase border-b border-secondary">
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Service</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Fees</th>
                </tr>
                </thead>
                <tbody class="">
                
                @forelse ($transactions as $transaction)
                    <tr class="text-gray-400">
                        <td class="px-4 py-3 border">
                            <p class="font-semibold">{{ $transaction['type'] }}</p>
                        </td>
                        <td class="px-4 py-3 border text-md font-semibold">
                            <p class="font-semibold">{{ $transaction['service'] }}</p>
                        </td>
                        <td class="px-4 py-3 border text-md font-semibold">
                            <p class="font-semibold">{{ $transaction['amount'] }}</p>
                        </td>
                        <td class="px-4 py-3 border text-md font-semibold">
                            <p class="font-semibold">{{ $transaction['status'] }}</p>
                        </td>
                        <td class="px-4 py-3 border text-md font-semibold">
                            <p class="font-semibold">{{ $transaction['fees']}}</p>
                        </td>
                    </tr>
                @empty
                    No Financial Data available as of now
                @endforelse

                </tbody>
            </table>
            
            </div>
        </div>
        </section>
    </div>


    @if($openWithdraw)
        <x-jet-dialog-modal wire:model="openWithdraw">
            <x-slot name="title">
                Withdraw Funds
            </x-slot>

            <x-slot name="content">
                Enter the phone number and amount. Note you will be asked to confirm your password before the withdrawal is made.
                <x-jet-validation-errors class="mb-4" />
                 <div class="mt-2">
                    <x-jet-label class="font-bold" for="name" value="{{ __('Amount') }}" />
                    <x-jet-input id="amount" class="cam-amount block mt-1 w-full border-gray-400 text-gray-800" wire:model="amount" type="text" name="amount" :value="old('amount')" required />
                </div>
                <div class="mt-4">
                    <x-jet-label class="font-bold" for="momo-tel" value="{{ __('Momo Number') }}" />
                    <small class="text-gray-500">Both Orange and MTN are accepted </small>
                    <x-jet-input wire:loading.attr="disabled" wire:loading.class="bg-gray-600 disabled" wire:target="initiatePay()" id="phone" class="cam-tel block mt-1 w-full border-gray-400 text-gray-800" wire:model="phone" type="text" name="phone" :value="old('phone')" required />
                </div>
            </x-slot>

            <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('openWithdraw')" wire:loading.attr="disabled">
                        Nevermind
                    </x-jet-secondary-button>
                <x-jet-confirms-password wire:then="initiateWithdraw()">
                    <x-jet-button class="ml-2" wire:loading.class="bg-transparent">
                        Withdraw {{ $amount }} FCFA
                        <div wire:loading wire:target="initiateWithdraw">
                            <img width="20px" src="{{ asset("images/logo/loading.png") }}" class="animate-spin">
                        </div>
                    </x-jet-button>
                </x-jet-confirms-password>
            </x-slot>
        </x-jet-dialog-modal>
    @endif

     <script>
        window.addEventListener('tel-number', event => {
            var amountsCollection = document.getElementsByClassName("cam-amount");
            var amounts = Array.from(amountsCollection);

            amounts.forEach(function (el) {
                var cleave = new Cleave(el, {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand',
                    numeralPositiveOnly: true,
                    rawValueTrimPrefix: true,
                });
            });
            var cleave = new Cleave('.cam-tel', {
                phone: true,
                phoneRegionCode: 'CM',
                prefix: '+237',
                noImmediatePrefix: true,
            });
        });
    </script>
</div>
