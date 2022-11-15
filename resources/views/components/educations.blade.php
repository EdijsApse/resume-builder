@if (count($educations))
    <div class="single-section mt-6">
        <h2>Education</h2>
        <ul>
            @foreach ($educations as $edu)
                <li>
                    <div class="single-list-item">
                        <p class="item-title">{{ $edu->school }}</p>
                        <p class="item-subtitle">{{ $edu->degree }} | {{ $edu->field }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif