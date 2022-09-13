<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Contest;
use App\Models\Utils\Division;
use App\Models\Utils\Currency;
use Illuminate\Support\Str;
use Purifier;

class ContestComponent extends Component
{
    use WithFileUploads;
    public $createContest, $editContest, $viewContest, $showText = false;
    public $text_words = 50;
    public $active = true;
    public $fee = true;
    public $tarrif = true;
    public $vote_count = 1;
    public $name, $description, $amount, $b_date, $e_date, $cover, $contests, $currency, $currencies, $vote_fee, $event_photo, $slug;
    public Contest $contest;

    public function mount()
    {
        $this->currencies = Currency::all();
    }

    public function render()
    {
        $this->contests = Contest::all();
        return view('livewire.contest-component');
    }

    public function openCreate()
    {
        $this->dispatchBrowserEvent('summer-editor');
        $this->dispatchBrowserEvent('enter-amount');
        $this->viewContest = false;
        $this->editContest = false;
        $this->createContest = true;
    }

    public function openEdit(Contest $contest)
    {
        $this->viewContest = false;
        $this->createContest = false;
        $this->name = $contest->name;
        $this->fee = $contest->fee;
        $this->active = $contest->active;
        $this->currency = $contest->currency;
        $this->amount = $contest->fee_amount;
        $this->tarrif = $contest->vote_tarrif;
        $this->vote_count = $contest->vote_count;
        $this->vote_fee = $contest->vote_fee;
        $this->description = $contest->description;
        $this->b_date = $contest->beginning_date;
        $this->e_date = $contest->ending_date;
        $this->slug = $contest->slug;
        //$this->cover = $contest->cover_image;
        $this->editContest = true;
    }

    public function openView(Contest $contest)
    {
        $this->editContest = false;
        $this->createContest = false;

        $this->name = $contest->name;
        $this->slug = $contest->slug;
        $this->fee = $contest->fee;
        $this->active = $contest->active;
        $this->currency = $contest->currency;
        $this->amount = currency_format((float)$contest->fee_amount, $contest->currency);
        $this->tarrif = $contest->vote_tarrif;
        $this->vote_count = $contest->vote_count;
        $this->vote_fee = currency_format((float)$contest->vote_fee,$contest->currency); 
        $this->description = $contest->description;
        $this->b_date = $contest->beginning_date;
        $this->e_date = $contest->ending_date;
        $this->event_photo = $contest->cover_image;
        
        $this->viewContest = true;
    }

    public function openText(Contest $contest,$type)
    {
        $this->description = $contest->description;
        $this->slug = $contest->slug;
        if($type == 'y')
        {
            $this->showText = true;
            $this->text_words = Str::wordCount($this->description);
            
        }
        else {
            $this->showText = false;
            $this->text_words = 50;
            
        }
    }

    protected $messages = [
        'name.required' => 'The name of this contest cannot be empty',
        'description.required' => 'The description of this contest cannot be empty.',
        'b_date.before' => 'The Beginning Date must be a date before the ending Date.',
        'e_date.after' => 'The Ending Date must be a date after the beginning date.',
        'b_date.required' => 'Please set a beginning date.',
        'e_date.required' => 'Please set an ending date.',
        'cover.required' => 'Please upload a cover art for the contest.',
        'vote_fee.required_if' => 'The amount of money per vote is required when the Pay to Vote checkbox is ticked.',
    ];


    public function create()
    {
        $data = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'active' => 'sometimes',
            'fee' => 'sometimes',
            'amount' =>  'required_if:fee,true',
            'currency' => 'required',
            'b_date' => 'required|date|before_or_equal:e_date',
            'e_date' => 'required|date|after_or_equal:b_date',
            'cover' => 'required|image',
            'tarrif' => 'sometimes',
            'vote_count' => 'required_if:tarrif,true|numeric',
            'vote_fee' => 'required_if:tarrif,true'
        ]);


        $coverExt = $this->cover->getClientOriginalExtension();
        $coverName = Str::random(10).'.'.$coverExt;
        $coverPath = $this->cover->storePubliclyAs('Contest/Images', $coverName, ['disk' => 'public']);


        $contest = new Contest;
        $contest->name = $data['name'];
        $contest->fee = $data['fee'];
        $contest->active = $data['active'];
        $contest->currency = $data['currency'];
        $contest->fee_amount = preg_replace( '/[^0-9]/', '', $data['amount']);
        $contest->vote_tarrif = $data['tarrif'];
        $contest->vote_count = $data['vote_count'];
        $contest->vote_fee = preg_replace( '/[^0-9]/', '', $data['vote_fee']);
        $contest->description = Purifier::clean($data['description']);
        $contest->beginning_date = $data['b_date'];
        $contest->ending_date = $data['e_date'];
        $contest->cover_image = $coverPath;
        $contest->save();
        $this->sAlert('Created', 'success', 'true', 'top-end');
        $this->createContest = false;
    }

    public function update(Contest $contest)
    {

        $data = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'active' => 'sometimes',
            'fee' => 'sometimes',
            'currency' => 'required',
            'b_date' => 'required|date|before_or_equal:e_date',
            'e_date' => 'required|date|after_or_equal:b_date',
            'tarrif' => 'sometimes',
            //'vote_count' => 'required_if:tarrif,true|numeric',
            //'vote_fee' => 'required_if:tarrif,true'
        ]);

       

        
        if($this->cover){
            $this->validate(['cover' => 'image']);
            $coverExt = $this->cover->getClientOriginalExtension();
            $coverName = Str::random(10).'.'.$coverExt;
            $coverPath = $this->cover->storePubliclyAs('Contest/Images', $coverName, ['disk' => 'public']);
        }
        else {
            $coverPath = $contest->cover_image;
        }


        $contest->name = $data['name'];
        $contest->fee = $data['fee'];
        $contest->active = $data['active'];
        $contest->currency = $data['currency'];
        
        $contest->vote_tarrif = $data['tarrif'];
        
        $contest->description = Purifier::clean($data['description']);
        $contest->beginning_date = $data['b_date'];
        $contest->ending_date = $data['e_date'];
        $contest->cover_image = $coverPath;

        if($this->fee)
        {
           $amount = $this->validate(['amount' => 'required|numeric']);
           $contest->fee_amount = preg_replace( '/[^0-9]/', '', $amount['amount']);
        }

        if($this->tarrif)
        {
            $vote = $this->validate(['vote_fee' => 'required|numeric', 'vote_count' => 'required|numeric']);
            $contest->vote_count = $vote['vote_count'];
            $contest->vote_fee = preg_replace( '/[^0-9]/', '', $vote['vote_fee']);
        }

        $contest->save();
        $this->sAlert('Updated', 'success', 'true', 'top-end');
        $this->editContest = false;
        $this->render();
    }

    public function delete(Contest $contest)
    {
        $contest->delete();
        $this->viewContest = false;
        $this->editContest = false;
        $this->createContest = false;
        $this->sAlert('Deleted', 'success', 'true', 'top-end');
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
