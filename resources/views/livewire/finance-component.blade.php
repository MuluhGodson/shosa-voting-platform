<div>
     <div>
        <x-jet-button wire:click="openCreate">
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
</div>
