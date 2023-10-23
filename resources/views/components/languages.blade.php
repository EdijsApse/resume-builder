@if (count($languages))
    <div class="single-group mt-6">
        <p class="heading-2 regular">{{ __('messages.admin.languages') }}</p>
        <ul>
            @foreach ($languages as $language)
                <li class="mt-0">
                    <div class="single-list-item">
                        <p class="item-title semi-bold text-small ">{{ $language->language->name }}:</p>
                        <p class="item-subtitle semi-bold text-small ">{{ __('messages.resume.proficiency') }}: <span class="regular">{{ $language->level->name }}</span></p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif