@if (count($languages))
    <div class="w-50 single-group">
        <p class="heading-2 regular">Languages</p>
        <ul>
            @foreach ($languages as $language)
                <li>
                    <div class="single-list-item">
                        <p class="item-title semi-bold text-small ">{{ $language->language->name }}:</p>
                        <p class="item-subtitle semi-bold text-small ">Proficiency: <span class="regular">{{ $language->level->name }}</span></p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif