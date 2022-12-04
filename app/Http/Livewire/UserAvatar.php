<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserAvatar extends Component
{
    use WithFileUploads;

    public $avatar;



    protected $rules =
        [
            'avatar' => ['required','mimes:png,jpg,jpeg', 'image', 'max:1999', 'dimensions:min_width=300,min_height=300'],
        ];

    protected $messages =
        [
            'avatar.required' => 'یک تصویر انتخاب کنید.',
            'avatar.mimes' => 'فایل انتخاب شده معتبر نمی باشد',
            'avatar.image' => 'فایل انتخاب شده معتبر نمی باشد',
            'avatar.max' => 'حداکثز حجم فایل ۲ مگابایت',
            'avatar.min_width' => 'حداقل عرض تصویر ۵۰۰ پیکسل',
            'avatar.max_height' => 'حداقل ارتفاع تصویر ۵۰۰ پیکسل',
        ];


    public function save()
    {
        $this->validate();
        $image_name_save = 'UIMG' . date('YmdHis') . uniqid('', true) . '.jpg';
        $this->avatar->storeAs('users', $image_name_save, 'public');

        // delete old image if exists
        $user = User::findOrFail(Auth::id());
        if ($user->image_path != null) {
            if (Storage::disk('public')->exists('users/' . $user->image_path)) {
                Storage::disk('public')->delete('users/' . $user->image_path);
            }
        }
        User::where('id', Auth::id())
            ->update(['image_path' => $image_name_save]);
    }

    public function render()
    {
        return view('livewire.user-avatar')
            ->with(['user' => Auth::user()]);
    }
}
