@if ($profile)
    <div class="contact-section mt-6">
        <p class="heading-2 regular">Contact</p>
        <ul>
            <li>
                <div class="single-contact">
                    <p class="contact-type semi-bold text-small ">Mobile</p>
                    <p class="contact-value light text-small ">{{ $profile->phone }}</p>
                </div>
            </li>
            <li>
                <div class="single-contact">
                    <p class="contact-type semi-bold text-small ">Email</p>
                    <p class="contact-value light text-small ">{{ $user->email }}</p>
                </div>
            </li>
            @if ($profile->website)
                <li>
                    <div class="single-contact">
                        <p class="contact-type semi-bold text-small ">Website</p>
                        <p class="contact-value light text-small ">Portfolio can be viewed <a href="{{ $profile->website }}">here</a></p>
                    </div>
                </li>
            @endif
            @if ($profile->address)
                <li>
                    <div class="single-contact">
                        <p class="contact-type semi-bold text-small ">Address</p>
                        <p class="contact-value light text-small ">{{ $profile->address }}</p>
                    </div>
                </li>
            @endif
        </ul>
    </div>
@endif