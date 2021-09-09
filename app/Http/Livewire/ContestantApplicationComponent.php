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

class ContestantApplicationComponent extends Component
{
    use WithFileUploads;
    public $data, $coverPath, $candidateNumber, $refs, $p_type, $flutter_data, $pub, $fee, $momo_tel, $name, $bio, $dob, $tel, $cover, $height, $gender, $town, $profession, $slug, $country, $division, $region, $email, $facebook, $instagram, $twitter, $currencies, $fee_amount, $currency;
    public Contest $contest;
    public $h_unit = "m";
    public $fee_payment, $isLocal, $isIntl, $payStatus = false;
    protected $listeners = ['countrySelected', 'regionSelected', 'divisionSelected', 'flutterTrans', 'flutterClose'];


    public function mount()
    {
        $this->currencies = Currency::all();
        $this->currency = $this->contest->currency;
        $this->refs = 'SHOSA-'.Str::random(20);
        $this->pub = config('flutterwave.public');
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
           /* 'dob' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'profession' => 'required',
            'tel' => 'required',*/
            'cover' => 'required|image',
            /*'division' => 'required',
            'height' => 'required',
            'h_unit' => 'required',
            'bio' => 'required',
            'town' => 'required',
            'instagram' => 'sometimes',
            'facebook' => 'sometimes',
            'twitter' => 'sometimes'*/
        ]);

        $coverExt = $this->cover->getClientOriginalExtension();
        $coverName = Str::random(10).'.'.$coverExt;
        $this->coverPath = $this->cover->storePubliclyAs('Contest/Candidates', $coverName, ['disk' => 'public']);
        
        if($this->contest->fee)
        {
            $this->fee_amount = $this->contest->fee_amount;
            $this->fee_payment = true;
        } else {
            $this->register($this->data, null, null);
        }
        
    }

    public function register($data, $payment, $type)
    {
        if($payment == null)
        {
            $candidate = new Candidate;
            $candidate->name = $data['name'];
            /*$candidate->email = $data['email'];
            $candidate->sex = $data['gender'];
            $candidate->tel = $data['tel'];
            $candidate->height = $data['height'].$data['h_unit'];
            $candidate->profession = $data['profession'];
            $candidate->dob = $data['dob'];
            $candidate->town = $data['town'];
            $candidate->bio = $data['bio'];*/
            $candidate->photo = $this->coverPath;
            /*$candidate->division_id = $this->division->id;
            if($data['instagram']) $candidate->ig_link = $data['instagram'];
            if($data['facebook']) $candidate->fb_link = $data['facebook'];
            if($data['twitter']) $candidate->twitter_link = $data['twitter'];*/
            $candidate->save();

            $serial = 'SHOSA-'.Str::random(7);

            
            $this->contest->candidates()->attach($candidate->id, ['serial' => $serial, 'candidate_number' => $this->candidateNumber]);
            $this->fee_payment = false;
            $this->isLocal = false;
            $this->isIntl =false;
            $this->payStatus = false;
            $this->sAlert('Application Succesful', 'success', 'false', 'center');
            Session::flash('message_success', 'Application Succesful'); 
            $this->redirect(route('vote.candidate', $this->contest->slug));
        } else {
            $candidate = new Candidate;
            $candidate->name = $data['name'];
            /*$candidate->email = $data['email'];
            $candidate->sex = $data['gender'];
            $candidate->tel = $data['tel'];
            $candidate->height = $data['height'].$data['h_unit'];
            $candidate->profession = $data['profession'];
            $candidate->dob = $data['dob'];
            $candidate->town = $data['town'];
            $candidate->bio = $data['bio'];*/
            $candidate->photo = $this->coverPath;
            /*$candidate->division_id = $this->division->id;
            if($data['instagram']) $candidate->ig_link = $data['instagram'];
            if($data['facebook']) $candidate->fb_link = $data['facebook'];
            if($data['twitter']) $candidate->twitter_link = $data['twitter'];*/
            $candidate->save();

            $serial = 'SHOSA-'.Str::random(7);

            $this->contest->candidates()->attach($candidate->id, ['paid' => true, 'payment_type' => $type, 'serial' => $serial, 'candidate_number' => $this->candidateNumber]);


            $this->fee_payment = false;
            $this->isLocal = false;
            $this->isIntl =false;
            $this->payStatus = false;
            $this->sAlert('Application Succesful', 'success', 'false', 'center');
            Session::flash('message_success', 'Application Succesful'); 
            $this->redirect(route('vote.candidate', $this->contest->slug));


        }
    }

    public function callFlutter()
    {

        //Initialize new variables for Flutter JS
    	$this->dispatchBrowserEvent('flutterpay', ['nm' => $this->data['name'], 'cr' => $this->currency, 'am' => $this->fee_amount, 'em'=>$this->data['email'], 'des' => $this->contest->name, 'refs' => $this->refs, 'pub' => $this->pub]);
    }

    public function flutterTrans($data)
    {
        $this->flutter_data = $data;
        if ($data['status'] == 'successful') {
            $this->sAlert('Application Succesful', 'success', 'false', 'center');
            $this->payStatus = true;
            $this->register($this->data,true, 'FLUTTER');
        } else {
            Session::flash('message', 'AN ERROR OCCURED WITH THE PAYMENT. PLEASE TRY AGAIN'); 
            $this->redirect('/apply');
        }
    }

    public function flutterClose()
    {
        if($this->flutter_data){
            if ($this->flutter_data['status'] == 'successful') {
                $this->sAlert('Application Succesful', 'success', 'false', 'center');
                Session::flash('message_success', 'Application Succesful'); 
                $this->redirect('/apply');
            }
        }
        else {
            Session::flash('message', 'AN ERROR OCCURED WITH THE PAYMENT. PLEASE TRY AGAIN'); 
            $this->redirect('/apply');
        }
    }

    public function getPaymentType($t)
    {
        $this->p_type = $t;
        if ($t == 1) {
            $this->dispatchBrowserEvent('tel-number');
            $this->momo_tel = $this->tel;
            $this->isLocal = true;
            $this->isIntl = false;
        } elseif ($t == 2) {
             $this->isLocal = false;
             $this->isIntl = true;
        } else {
            abort(403, 'AN ERROR OCCURED');
        }

    }

    public function initiatePay()
    {
        
        if($this->p_type == '1')
        {
            if (!Network::isOrange($this->momo_tel) && !Network::isMTN($this->momo_tel)) {
                abort(403, 'INVALID MTN OR ORANGE PHONE NUMBER');
            } else {
                $phone = preg_replace('/\s*/m', '', $this->momo_tel);
                $type = Network::check($phone);
  
                $payRequest = new Payment($phone, $this->fee_amount);
                $pay = $payRequest->pay();
                if($pay->success){
                    $this->payStatus = true;
                    $this->register($this->data,true, $type);
                } else {
                   abort(403, 'AN ERROR OCCURED WITH THE PAYMENT. PLEASE TRY AGAIN');
                }
            }
        } elseif($this->p_type == '2')
        {
            $this->callFlutter();
        } else {
            abort(403, 'AN ERROR OCCURED WITH THE PAYMENT. PLEASE TRY AGAIN');
        }
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
