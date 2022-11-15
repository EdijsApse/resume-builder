@if (count($certificates))
    <div class="single-section mt-6">
        <h2>Additional educations</h2>
        <ul>
            @foreach ($certificates as $cert)
                <li>
                    <div class="single-list-item">
                        <p class="item-title">{{ $cert->organization }}</p>
                        <p class="item-subtitle">Certificate | {{ $cert->name }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif