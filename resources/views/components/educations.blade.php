@if (count($educations))
    <div class="single-section mt-6">
        <p class="heading-2 regular">{{ __('messages.resume.education') }}</p>
        <ul>
            @foreach ($educations as $edu)
                <li>
                    <div class="single-list-item">
                        <p class="item-title semi-bold text-small ">{{ $edu->school }}</p>
                        <p class="item-subtitle semi-bold text-small ">{{ $edu->degree }} | {{ $edu->field }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif