<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Contest;
use App\Models\Candidate;
use App\Models\Utils\Country;
use App\Models\Utils\Region;
use App\Models\Utils\Division;
use Illuminate\Support\Str;

class CandidateComponent extends Component
{
    use WithFileUploads;
    public Contest $contest;
    public Candidate $candidate;
    public $candidates, $data, $coverPath, $name, $bio, $dob, $tel, $cover, $height, $gender, $town, $profession, $slug, $country, $division, $region, $email, $facebook, $instagram, $twitter;
    public $h_unit = "m";
    public $text_words = 50;
    public $editCandidate, $viewCandidate, $showText = false;
    protected $listeners = ['countrySelected', 'regionSelected', 'divisionSelected'];


    public function render()
    {
        return view('livewire.candidate-component');
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

    public function openCandidate(Candidate $candidate)
    {
        $this->candidate = $candidate;
        $this->viewCandidate = true;
    }

   /* public function openText(Candidate $candidate,$type)
    {
        $this->bio = $candidate->bio;
        if($type == 'y')
        {
            $this->showText = true;
            $this->text_words = Str::wordCount($this->bio);
            
        }
        else {
            $this->showText = false;
            $this->text_words = 50;
            
        }
    }*/

    public function openEdit(Candidate $candidate)
    {
        $this->viewCandidate = false;
        $this->slug = $candidate->slug;
        $this->name = $candidate->name;
        /*$this->bio = $candidate->bio;
        $this->email = $candidate->email;
        $this->division = $candidate->division_id;
        $this->tel = $candidate->tel;
        $this->dob = $candidate->dob;
        $this->town = $candidate->town;
        $this->height = Str::remove(['m', 'cm'], $candidate->height);
        $this->gender = $candidate->sex;
        $this->profession = $candidate->profession;
        $this->facebook = $candidate->fb_link;
        $this->instagram = $candidate->ig_link;
        $this->twitter = $candidate->twitter_link;*/
        $this->editCandidate = true;
    }

    public function update(Candidate $candidate)
    {
        $data = $this->validate([
            'name' => 'required',
            /*'dob' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'profession' => 'required',
            'tel' => 'required',
            'division' => 'required',
            'height' => 'required',
            'h_unit' => 'required',
            'bio' => 'required',
            'town' => 'required',
            'instagram' => 'sometimes',
            'facebook' => 'sometimes',
            'twitter' => 'sometimes'*/
        ]);

        if($this->cover)
        {
            $this->validate(['cover' => 'required|image']);
            $coverExt = $this->cover->getClientOriginalExtension();
            $coverName = Str::random(10).'.'.$coverExt;
            $this->coverPath = $this->cover->storePubliclyAs('Contest/Candidates', $coverName, ['disk' => 'public']);
        } else {
            $this->coverPath = $candidate->photo;
        }
        
        $candidate->name = $data['name'];
        $candidate->photo = $this->coverPath;
        /*$candidate->email = $data['email'];
        $candidate->sex = $data['gender'];
        $candidate->tel = $data['tel'];
        $candidate->height = $data['height'].$data['h_unit'];
        $candidate->profession = $data['profession'];
        $candidate->dob = $data['dob'];
        $candidate->town = $data['town'];
        $candidate->bio = $data['bio'];
        $candidate->division_id = $data['division'];
        if($data['instagram']) $candidate->ig_link = $data['instagram'];
        if($data['facebook']) $candidate->fb_link = $data['facebook'];
        if($data['twitter']) $candidate->twitter_link = $data['twitter'];*/
        $candidate->save();
        $this->editCandidate = false;

        $this->sAlert('Update Succesful', 'success', 'false', 'center');
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
