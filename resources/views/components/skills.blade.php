@if ($skills && count($skills->list))
    <div class="w-50 single-group">
        <p class="heading-2 regular">{{ __('messages.resume.skills') }}</p>
        <ul>
            @foreach ($skills->list as $skill)
                <li class="light text-small ">- {{ $skill }}</li>
            @endforeach
        </ul>
    </div>
@endif