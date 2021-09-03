<?php

namespace App\Http\Livewire\Utils;

use Livewire\Component;
use App\Models\Utils\Country;
use App\Models\Utils\Region;
use App\Models\Utils\Division;

class Location extends Component
{

    public $country;
    public $regions, $divisions, $region, $division, $subdivision;
 

    public function mount($lt)
    {
        
        if($lt){
            $this->division = $lt;
            $dv = Division::find($lt);
            $this->region = $dv->region_id;
            $rg = Region::find($this->region);
            $this->country = $rg->country_id;
        }
    }

    public function render()
    {
        if(!empty($this->country)){
            $this->regions = Region::where('country_id', $this->country)->get();
                if(!empty($this->region)){
                    $this->divisions = Division::where('region_id', $this->region)->get();
                }
        }
        return view('livewire.utils.location')->withCountries(Country::orderBy('name')->get());
    }

    public function updatedCountry()
    {
        $this->emit('countrySelected', $this->country);
    }

    public function updatedRegion()
    {
        $this->emit('regionSelected', $this->region);
    }

    public function updatedDivision()
    {
        $this->emit('divisionSelected', $this->division);
    }

}
