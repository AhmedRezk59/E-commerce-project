@component('mail::message')
# Welcome {{$data['data']->name}}

Here is you reset password email
@component('mail::button', ['url' => url("/admin/resetpassword/{$data['token']}") ])
Reset password
@endcomponent

Or copy this link <br>
<a href="{{url("/user/resetpassword/{$data['token']}")}}">{{url("/user/resetpassword/{$data['token']}")}}</a>

<p class="small">This mail is only avaliable for 2 hours only</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
