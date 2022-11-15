@if ($profile)
    <div class="pdf-block">
        <table>
            <tr class="align-top">
                <td class="pdf-col-4 section-border-bottom">
                    <div class="resume-photo-wrapper no-border">
                        <div class="resume-photo">
                            <img src="{{ public_path($profile->photo) }}" />
                        </div>
                    </div>
                </td>
                <td class="spacer"></td>
                <td class="pdf-col-8 section-border-bottom">
                    <div class="basic-details-wrapper no-border">
                        <h1 class="tests">{{ $profile->name }} {{ $profile->surname }}</h1>
                        <h2>{{ $profile->occupation }}</h2>
                        <p>{{ $profile->professional_summary }}</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
@endif