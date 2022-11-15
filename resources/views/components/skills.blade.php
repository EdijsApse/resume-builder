@if ($skills && count($skills->list))
    <div class="w-50 single-group">
        <h2>Skills</h2>
        <ul>
            @foreach ($skills->list as $skill)
                <li>- {{ $skill }}</li>
            @endforeach
        </ul>
    </div>
@endif