@if ($softSkills && count($softSkills->list))
    <div class="contact-section mt-3 single-group skills-group">
        <p class="heading-2 regular">{{ __('messages.resume.soft_skills') }}</p>
        <ul>
            @foreach ($softSkills->list as $skill)
                <li class="mt-2 light text-small ">- {{ $skill }}</li>
            @endforeach
        </ul>
    </div>
@endif