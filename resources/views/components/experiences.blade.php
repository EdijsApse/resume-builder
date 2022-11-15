@if (count($experiences))
    <div class="single-section mt-6">
        <h2>Work experience</h2>
        <ul>
            @foreach ($experiences as $exp)
                <li>
                    <div class="single-list-item">
                        <p class="item-title">{{ $exp->jobtitle }}</p>
                        <p class="item-subtitle">{{ $exp->employer }} | {{ $exp->from }} - {{ $exp->to }}</p>
                        @if ($exp->duties)
                            <p class="item-description">{{ $exp->duties }}</p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif