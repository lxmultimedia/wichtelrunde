<?php

namespace App\Http\Livewire;

use App\Models\members;
use Livewire\Component;
use App\Mail\WichtelMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Wizard extends Component
{
    public $currentStep = 1;
    public $total_members = 0;
    public $members = array();
    public $emails = array();
    public $successMsg = '';
    public $selectedMembers = array();


    protected $rules = [
        'total_members' => 'min:1|numeric',
        'members' => 'required|min:6',
        'emails' => 'required|email',
    ];



    /**
     * Write code on Method
     */
    public function firstStepSubmit()
    {
        $this->validate([
            'total_members' => 'required|numeric|min:3',
        ]);

        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
        $this->validate([
            "members"    => "required|array|min:".$this->total_members,
            "members.*.name"    => "required|string|min:3",
            "emails"    => "required|array|min:".$this->total_members,
            "emails.*.email"    => "required|email",
        ]);

        $this->currentStep = 3;
    }

    /**
     * Write code on Method
     */
    public function submitForm()
    {

        members::truncate();

        $this->selectedMembers = $this->members;

        for ($i = 1; $i <= count($this->members); $i++) {
            members::create([
                        'name' => $this->members[$i],
                        'email' => $this->emails[$i]
                    ]);
            $this->wichteln($this->emails[$i]);
        }



        $this->successMsg = 'Jeder Mitarbeiter hat eine E-Mail bekommen mit einer zugeteilten Person!';

        $this->clearForm();

        $this->currentStep = 1;

    }

    /**
     * Write code on Method
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     */
    public function clearForm()
    {
        $this->members = array();
        $this->emails = array();
        $this->total_members = 0;
        $this->selectedMembers = array();
    }

    public function render()
    {
        return view('livewire.wizard');
    }

    public function wichteln($email) {
            $name = $this->selectMember();
            Mail::to($email)->send(new WichtelMail($name));

            return 'Email sent Successfully';
    }

    public function selectMember(){

        shuffle($this->selectedMembers);

        return array_pop($this->selectedMembers);
    }
}
