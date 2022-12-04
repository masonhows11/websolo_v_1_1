<?php

namespace App\Http\Livewire;


use App\Models\Contact;
use Livewire\Component;

class ContactUs extends Component
{

    public $name;
    public $email;
    public $message;


    protected $rules = [
        'name' => ['required','min:3','max:25'],
        'email' => ['required','email'],
        'message' => ['required','min:5','max:1500']
    ];

    protected $messages = [
        'name.required' => 'فیلد نام الزامی است',
        'name.min' => 'حداقل ۳ کاراکتر وارد کنید',
        'name.max' => 'حداکثر ۲۵ کاراکتر وارد کنید',

        'email.required' => 'فیلد ایمیل الزامی است',
        'email.email' => 'ایمیل وارد شده معتبر نمی باشد',

        'message.required' => 'فیلد پیام الزامی است',
        'message.min' => 'حداقل ۵ کازاکتر وارد کنید',
        'message.max' => 'حداکثر تعداد کاراکتر وارد شده',
    ];
    public function submit()
    {
        $this->validate();
        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        $this->name = null;
        $this->email = null;
        $this->message = null;
        session()->flash('message', 'دیدگاه شما با موفقیت ثبت شد.');
    }

    public function render()
    {
        return view('livewire.contact-us')
            ->extends('front.include.master')
            ->section('main_content');
    }
}
