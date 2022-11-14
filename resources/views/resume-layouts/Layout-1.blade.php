<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resume</title>
    <link rel="stylesheet" href="{{ public_path('css/style.css') }}">
    <style>
        .layout-1 {
            width: 703px;
            padding: 0 !important;
            overflow: hidden
        }
        .pdf-block {
            display: block !important;
        }
        .pdf-col-4 {
            width: 190px !important;
        }
        .pdf-col-8 {
            width: 493px !important;
        }
        .w-50 {
            width: 246.5px !important;
        }
        .spacer {
            width: 20px;
        }
        .align-top {
            vertical-align: top;
        }
        .no-border {
            border-bottom: none !important;
        }
        .section-border-bottom {
            border-bottom: 1px solid #313744;
        }
        .grouped-section {
            display: block;
        }
        .border-left {
            padding-left: 1.5rem;
            border-left: 1px solid #313744;
        }
    </style>
</head>
<body>
    <div class="layout-1">
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
        <div class="pdf-block">
            <table>
                <tr class="align-top">
                    <td class="pdf-col-4">
                        @if ($profile)
                            <div class="contact-section mt-6">
                                <h2>Contact</h2>
                                <ul>
                                    <li>
                                        <div class="single-contact">
                                            <p class="contact-type">Mobile</p>
                                            <p class="contact-value">{{ $profile->phone }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-contact">
                                            <p class="contact-type">Email</p>
                                            <p class="contact-value">{{ $user->email }}</p>
                                        </div>
                                    </li>
                                    @if ($profile->website)
                                        <li>
                                            <div class="single-contact">
                                                <p class="contact-type">Website</p>
                                                <p class="contact-value">Portfolio can be viewed <a href="{{ $profile->website }}">here</a></p>
                                            </div>
                                        </li>
                                    @endif
                                    @if ($profile->address)
                                        <li>
                                            <div class="single-contact">
                                                <p class="contact-type">Address</p>
                                                <p class="contact-value">{{ $profile->address }}</p>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </td>
                    <td class="spacer">
                    </td>
                    <td class="pdf-col-8">
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
                        @if (count($certificates))
                            <div class="single-section mt-6">
                                <h2>Additional educations</h2>
                                <ul>
                                    @foreach ($certificates as $cert)
                                        <li>
                                            <div class="single-list-item">
                                                <p class="item-title">{{ $cert->organization }}</p>
                                                <p class="item-subtitle">Certificate | {{ $cert->name }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="grouped-section">
                            <table>
                                <tr class="align-top">
                                    @if ($skills && count($skills->list))
                                        <td class="w-50 single-group">
                                            <h2>Skills</h2>
                                            <ul>
                                                @foreach ($skills->list as $skill)
                                                    <li>- {{ $skill }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    @endif
                                    @if (count($languages))
                                        <td class="w-50 single-group {{ $skills && count($skills->list) ? 'border-left' : '' }}">
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
                                        </td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>