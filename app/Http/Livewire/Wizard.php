<?php

namespace App\Http\Livewire;

use App\Models\members;
use Livewire\Component;
use App\Mail\WichtelMail;
use App\Models\memberlink;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Wizard extends Component
{
    public $currentStep = 1;
    public $total_members = 0;
    public $members = array();
    public $successMsg = '';
    private $takenMembers = array();

    public function firstStepSubmit()
    {
        $this->validate([
            'total_members' => 'required|numeric|min:3',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            "members"               => "array|min:".$this->total_members,
            "members.*.name"        => "required|string|min:3",
            "members.*.email"       => "required|email",
        ]);

        $this->currentStep = 3;
    }

    public function submitForm()
    {

        members::truncate();
        memberlink::truncate();

        for ($i = 1; $i <= count($this->members); $i++) {
            $m = members::create([
                        'name' => $this->members[$i]["name"],
                        'email' => $this->members[$i]["email"]
                    ]);
            $ml = memberlink::create([
                        'name' => $this->members[$i]["name"],
                        'email' => $this->members[$i]["email"]
                    ]);
        }

        $this->wichteln();

        $this->successMsg = 'Jeder Mitarbeiter hat eine E-Mail bekommen mit einer zugeteilten Person!';

        $this->clearForm();

        $this->currentStep = 1;

    }

    public function wichteln() {

            $allMembers = members::all();

            foreach($allMembers as $am){
                $email = $am->email;
                Mail::to($email)->send(new WichtelMail($this->selectMember($email)));
            }
            return 'success';
    }

    public function selectMember($email){

        $selectedMember = memberlink::inRandomOrder()->where([['taken', '=', false],[ 'email', '!=', $email ]])->first();

        $selectedMember->taken = true;
        $selectedMember->save();



        return $selectedMember->name;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function clearForm()
    {
        $this->members = array();
        $this->total_members = 0;
        $this->selectedMembers = array();
    }

    public function render()
    {
        return view('livewire.wizard');
    }
}
