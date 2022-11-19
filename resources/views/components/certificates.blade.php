@if (count($certificates))
    <div class="single-section mt-6">
        <p class="heading-2 regular">{{ __('messages.resume.additional_educations') }}</p>
        <ul>
            @foreach ($certificates as $cert)
                <li>
                    <div class="single-list-item">
                        <p class="text-small item-title semi-bold">{{ $cert->organization }}</p>
                        <p class="text-small item-subtitle semi-bold">{{ __('messages.resume.certificate') }} | {{ $cert->name }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif