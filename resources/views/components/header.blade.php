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
                        <p class="heading-1 regular">{{ $profile->name }} {{ $profile->surname }}</p>
                        <p class="heading-2 regular">{{ $profile->occupation }}</p>
                        <p class="light text-small">{{ $profile->professional_summary }}</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
@endif