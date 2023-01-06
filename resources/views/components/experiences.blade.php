@if (count($experiences))
    <div class="single-section mt-6">
        <p class="heading-2 regular">{{ __('messages.resume.work_experience') }}</p>
        <ul>
            @foreach ($experiences as $exp)
                <li>
                    <div class="single-list-item">
                        <p class="item-title semi-bold text-small ">{{ $exp->jobtitle }}</p>
                        <p class="item-subtitle semi-bold text-small ">{{ $exp->employer }} | {{ $exp->date_from_for_humans }} - {{ $exp->date_to_for_humans }}</p>
                        @if ($exp->duties)
                            <p class="item-description light text-small mb-2">{{ $exp->duties }}</p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif