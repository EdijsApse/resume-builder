@if ($profile)
    <div class="contact-section mt-6">
        <h2>Contact</h2>
        <ul>
            <li>
                <div class="single-contact">
                    <p class="contact-type">Mobile</p>
                    <p class="contact-value">{{ $profile->phone }}</p>
                </div>
            </li>
            <li>
                <div class="single-contact">
                    <p class="contact-type">Email</p>
                    <p class="contact-value">{{ $user->email }}</p>
                </div>
            </li>
            @if ($profile->website)
                <li>
                    <div class="single-contact">
                        <p class="contact-type">Website</p>
                        <p class="contact-value">Portfolio can be viewed <a href="{{ $profile->website }}">here</a></p>
                    </div>
                </li>
            @endif
            @if ($profile->address)
                <li>
                    <div class="single-contact">
                        <p class="contact-type">Address</p>
                        <p class="contact-value">{{ $profile->address }}</p>
                    </div>
                </li>
            @endif
        </ul>
    </div>
@endif