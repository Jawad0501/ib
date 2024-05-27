<x-mail::message>
{{-- # New Quote --}}

{{-- Create a quote for you by {{ config('app.name') }} admin. Please upload your documents & payment now. --}}
# Hi {{$user->name}},

We have created a new account for you for accessing our dashboard as {{$user->role->name}}. <br>

Your credentials for logging in to our dashboard is given below <br>

Email: {{$user->email}} <br>
Password: {{decrypt($user->encrypted)}} <br>

You can log in using this <a href="{{route('admin.login')}}">url</a>.

Feel free to contact us if you have any inquiries or questions or need additional options.

Regards,<br>
Immersive Brands<br><br><br><br>
Phone: <a href=”tel:+4402030053217“ style="color:black">+44 0203 005 3217</a>   <span style="font-weight:600; margin-left: 10px">Email:</span> <a href="mailto:info@immersivebrands.co.uk" style="color: black; text-decoration: none">info@immersivebrands.co.uk</a> <br>
Floor 14, 25 Cabot Square, London E14 4QZ
<br>
<br>


<img src="https://software.immersivebrands.co.uk/storage/app/public/setting/emailLogos.png" width="250px" alt="Logo" srcset="" class="img-fluid" style="margin-left: 130px;">
</x-mail::message>
