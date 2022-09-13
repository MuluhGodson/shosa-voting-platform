<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Contest;
use App\Models\Candidate;
use App\Models\Utils\Country;
use App\Models\Utils\Region;
use App\Models\Utils\Division;
use App\Models\Utils\Currency;
use Illuminate\Support\Str;
use Malico\MeSomb\Payment;
use Malico\MobileCM\Network;
use Session;
use App\Helpers\Paymooney;

class ContestantApplicationComponent extends Component
{
    use WithFileUploads;
    public $data, $coverPath, $candidateNumber, $refs, $p_type, $fee, $momo_tel, $name, $bio, $dob, $tel;
    public $cover, $height, $gender, $town, $profession, $slug, $country, $division, $region, $email, $facebook;
    public $instagram, $twitter, $currencies, $fee_amount, $currency, $contestant;
    public Contest $contest;
    public $h_unit = "m";
    public $fee_payment, $isLocal, $isIntl, $payStatus = false;
    protected $listeners = ['countrySelected', 'regionSelected', 'divisionSelected', 'flutterTrans', 'flutterClose'];


    public function mount()
    {
        $this->currencies = Currency::all();
        $this->currency = 'XAF';
        $this->refs = 'SHOSA-'.Str::random(20);
    }

    public function render()
    {
        return view('livewire.contestant-application-component');
    }

    public function countrySelected($id)
    {
        $this->country = Country::find($id);
    }

    public function regionSelected($id)
    {
        $this->region = Region::find($id);
    }

    public function divisionSelected($id)
    {
        $this->division = Division::find($id);
    }

    public function updatedCurrency()
    {
        $this->fee_amount = currency($this->contest->fee_amount, $from = $this->contest->currency, $to = $this->currency, $format = false);
        if($this->fee_amount < '1') $this->fee_amount = '1';
    }


    public function apply(Contest $contest)
    {
        $totCandidates = $contest->loadCount('candidates')->candidates_count;
        $this->candidateNumber = $totCandidates + 1;
        $this->data = $this->validate([
            'name' => 'required',
            'dob' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'profession' => 'required',
            'tel' => 'required',
            'cover' => 'required|image',
            /*'division' => 'required',*/
            'height' => 'required',
            'h_unit' => 'required',
            'bio' => 'required',
            'town' => 'required',
            'instagram' => 'sometimes',
            'facebook' => 'sometimes',
            'twitter' => 'sometimes'
        ]);

        $coverExt = $this->cover->getClientOriginalExtension();
        $coverName = Str::random(10).'.'.$coverExt;
        $this->coverPath = $this->cover->storePubliclyAs('Contest/Candidates', $coverName, ['disk' => 'public']);
        
        $this->contestant = $this->register($this->data);

        if($this->contest->fee)
        {
            $this->fee_amount = $this->contest->fee_amount;
            $this->fee_payment = true;

        } else {
            $this->attachCandidate($this->contestant);
        }
        
    }

    public function register($data)
    {
       
            $candidate = new Candidate;
            $candidate->name = $data['name'];
            $candidate->email = $data['email'];
            $candidate->sex = $data['gender'];
            $candidate->tel = $data['tel'];
            $candidate->height = $data['height'].$data['h_unit'];
            $candidate->profession = $data['profession'];
            $candidate->dob = $data['dob'];
            $candidate->town = $data['town'];
            $candidate->bio = $data['bio'];
            $candidate->photo = $this->coverPath;
            /*$candidate->division_id = $this->division->id;*/
            if($data['instagram']) $candidate->ig_link = $data['instagram'];
            if($data['facebook']) $candidate->fb_link = $data['facebook'];
            if($data['twitter']) $candidate->twitter_link = $data['twitter'];
            $candidate->save();
            return $candidate;
    }

    public function attachCandidate($candidate)
    {

        $serial = 'SHOSA-S-'.Str::random(7);
        $this->contest->candidates()->attach($candidate->id, ['serial' => $serial, 'candidate_number' => $this->candidateNumber]);
        $this->fee_payment = false;
        $this->sAlert('Application Succesful', 'success', 'false', 'center');
        Session::flash('message_success', 'Application Succesful'); 
        $this->redirect(route('vote.candidate', $this->contest->slug));
    }


    public function initiatePay()
    {
            $ref = 'SHOSA-R'.$this->contestant->id.'-'.Str::random(20);
            $payment = new Paymooney();
            $payment_url = $payment->generatePaymentUrl($this->fee_amount, $this->currency, $this->contestant->id, $ref);
            return redirect($payment_url);
        
    }

    public function sAlert($title, $icon, $toast, $position)
    {
        $this->dispatchBrowserEvent('swal', [
            'title'=> $title,
            'icon'=> $icon,
            'toast'=> $toast,
            'position'=> $position,
            'persistent' => false,
        ]);
    }

}
