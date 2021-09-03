<div>
	<div class="">
		<div class="my-2 mx-2">
			<small class="font-semibold text-gray-500" for="country">{{ __('Country') }}</small>
			<select class="rblock mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm" wire:model="country" name="" id="">
				<option>{{__('Select a county')}}</option>
				@foreach($countries as $c)
				<option value="{{$c->id}}">{{$c->name}}</option>
				@endforeach
			</select>
		</div>
		
		@if($regions)
			<div class="my-2 mx-2">
				@if(count($regions) > 0)
				<small class="font-semibold text-gray-500" for="region">{{ __('Region') }}</small>
				<select class="rblock mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm" wire:model="region" name="" id="">
					<option>{{__('Select a region')}}</option>
					@foreach($regions as $r)
					<option value="{{$r->id}}">{{$r->name}}</option>
					@endforeach
				</select>
				@endif
			</div>
		@endif
		
		@if($divisions)
			<div class="my-2 mx-2">
				@if(count($divisions) > 0)
				<small class="font-semibold text-gray-500" for="division">{{ __('Division') }}</small>
				<select class="rblock mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm" wire:model="division" name="" id="">
					<option>{{__('Select a division')}}</option>
					@foreach($divisions as $dv)
					<option value="{{$dv->id}}">{{$dv->name}}</option>
					@endforeach
				</select>
				@endif
			</div>
		@endif
		
	</div>
</div>