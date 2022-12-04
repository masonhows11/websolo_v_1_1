@component('mail::message')
ابمیل فعال سازی حساب کاربری
<div>
    {{ $user->email }}    : کاربر گرامی
</div>
@component('mail::button', ['url' =>  route('email.verify',[$id,$encrypted])  ])
برای فعال سازی حساب کاربری خود کلیک کنید
@endcomponent

با تشکر<br>
{{ config('app.name') }}
@endcomponent
