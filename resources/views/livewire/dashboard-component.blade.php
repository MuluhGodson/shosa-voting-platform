<div>
    <div wire:poll.1000ms>
    	<div class="grid md:grid-cols-3 gap-4 place-content-center">   			

	    	<div class="bg-secondary text-white w-full rounded shadow-lg">    			
	    		<div class="flex flex-row justify-between content-center p-4">
	    			<div class="self-center">
	    				<i class="fas fa-calendar-alt text-6xl"></i>
	    			</div>
	    			<div class="text-center">
	    				<h1 class="text-3xl font-semi-bold"> {{now()->format('g:i:s A')}}</h1>
	    				<h1 class="text-3xl font-semi-bold"> {{now()->format('F jS Y')}}</h1>
	    				<h1 class="text-xl">Date/Time</h1>	    				
	    			</div>	    			
	    		</div>			
	    	</div>
            <div class="bg-secondary text-white w-full rounded shadow-lg">    			
	    		<div class="flex flex-row justify-between content-center p-4">
	    			<div class="self-center">
	    				<i class="fas fa-trophy text-6xl"></i>
	    			</div>
	    			<div class="text-center">
	    				<h1 class="text-3xl font-semi-bold"> {{count(\App\Models\Contest::where('active',1)->get())}}</h1>
	    				<h1 class="text-xl">Active Contest</h1>	    				
	    			</div>	    			
	    		</div>			
	    	</div>
            <div class="bg-secondary text-white w-full rounded shadow-lg">    			
	    		<div class="flex flex-row justify-between content-center p-4">
	    			<div class="self-center">
	    				<i class="fas fa-users text-6xl"></i>
	    			</div>
	    			<div class="text-center">
	    				<h1 class="text-3xl font-semi-bold"> {{\App\Models\Contest::withCount('candidates')->where('active',1)->first()->candidates_count}}</h1>
	    				<h1 class="text-xl">Total Contestants</h1>	    				
	    			</div>	    			
	    		</div>			
	    	</div>
        </div>


        <div class="my-2" style="height: 32rem;">
            <livewire:livewire-column-chart
                :column-chart-model="$generalStat"
            />	
        </div>
    </div>
</div>
