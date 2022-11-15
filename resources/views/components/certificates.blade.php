@if (count($certificates))
    <div class="single-section mt-6">
        <p class="heading-2 regular">Additional educations</p>
        <ul>
            @foreach ($certificates as $cert)
                <li>
                    <div class="single-list-item">
                        <p class="text-small item-title semi-bold">{{ $cert->organization }}</p>
                        <p class="text-small item-subtitle semi-bold">Certificate | {{ $cert->name }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif