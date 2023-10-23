@if ($profile)
    <div class="contact-section mt-6">
        <p class="heading-2 regular">{{ __('messages.resume.contact') }}</p>
        <ul>
            <li>
                <div class="single-contact">
                    <p class="contact-type semi-bold text-small ">{{ __('messages.resume.mobile') }}</p>
                    <p class="contact-value light text-small ">{{ $profile->phone }}</p>
                </div>
            </li>
            <li>
                <div class="single-contact">
                    <p class="contact-type semi-bold text-small ">{{ __('messages.resume.email') }}</p>
                    <p class="contact-value light text-small ">{{ $user->email }}</p>
                </div>
            </li>
            @if ($profile->website)
                <li>
                    <div class="single-contact">
                        <p class="contact-type semi-bold text-small ">{{ __('messages.resume.website') }}</p>
                        <p class="contact-value light text-small ">{{ __('messages.resume.portfolio_can_be_viewed') }} <a href="{{ $profile->website }}">{{ __('messages.resume.here') }}</a></p>
                    </div>
                </li>
            @endif
            @if ($profile->linkedin_url)
                <li>
                    <div class="single-contact">
                        <p class="contact-type semi-bold text-small ">{{ __('messages.resume.linkedin') }}</p>
                        <p class="contact-value light text-small ">{{ __('messages.resume.linkedin_profile_can_be_viewed') }} <a href="{{ $profile->linkedin_url }}">{{ __('messages.resume.here') }}</a></p>
                    </div>
                </li>
            @endif
            @if ($profile->address)
                <li>
                    <div class="single-contact">
                        <p class="contact-type semi-bold text-small ">{{ __('messages.resume.address') }}</p>
                        <p class="contact-value light text-small ">{{ $profile->address }}</p>
                    </div>
                </li>
            @endif
        </ul>
    </div>
@endif