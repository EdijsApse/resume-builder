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
            width: 230px !important;
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
        @component('components/header', ['profile' => $profile])@endcomponent
        <div class="pdf-block">
            <table>
                <tr class="align-top">
                    <td class="pdf-col-4">
                        @component('components/contacts', ['profile' => $profile, 'user' => $user])@endcomponent
                    </td>
                    <td class="spacer">
                    </td>
                    <td class="pdf-col-8">
                        @component('components/experiences', ['experiences' => $experiences])@endcomponent
                        @component('components/educations', ['educations' => $educations])@endcomponent
                        @component('components/certificates', ['certificates' => $certificates])@endcomponent
                        <div class="grouped-section">
                            <table>
                                <tr class="align-top">
                                    <td>
                                        @component('components/skills', ['skills' => $skills])@endcomponent
                                    </td>
                                    <td class="{{ $skills && count($skills->list) ? 'border-left' : '' }}">
                                        @component('components/languages', ['languages' => $languages])@endcomponent
                                    </td>
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