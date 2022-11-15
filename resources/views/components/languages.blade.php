@if (count($languages))
    <div class="w-50 single-group">
        <h2>Languages</h2>
        <ul>
            @foreach ($languages as $language)
                <li>
                    <div class="single-list-item">
                        <p class="item-title">{{ $language->language->name }}:</p>
                        <p class="item-subtitle">Proficiency: <span class="regular">{{ $language->level->name }}</span></p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif