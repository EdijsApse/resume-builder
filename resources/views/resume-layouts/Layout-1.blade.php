<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $profile->name }} {{ $profile->surname }} - CV</title>
    <link rel="stylesheet" href="{{ public_path('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        html {
            padding: 0px !important;
            margin: 0 !important;
        }
        body {
            padding: 50px !important;
            margin: 0 !important;
        }
        .layout-1 {
            padding: 0 !important;
        }
        .semi-bold {
            font-family: 'Raleway', sans-serif !important;
            font-weight: 700 !important;
        }
        .regular {
            font-family: 'Raleway', sans-serif !important;
            font-weight: 400 !important;
        }
        .light {
            font-family: 'Raleway', sans-serif !important;
            font-weight: 300 !important;
        }
        .pdf-block {
            display: block !important;
        }
        .pdf-col-4 {
            width: 190px !important;
        }
        .pdf-col-8 {
            width: 484px !important;
            max-width: 484px !important;
        }
        .w-50 {
            width: 242px !important;
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
        .grouped-section .heading-2 {
            margin-top: 1rem;
        }
        .border-left {
            padding-left: 20px;
            border-left: 1px solid #313744;
            width: 222px !important;
        }
        .heading-1 {
            font-size: 1.4rem !important;
            color: #2dbabd !important;
            margin-bottom: 1rem !important;
        }
        .heading-2 {
            font-size: 1.3rem !important;
            margin-bottom: 0.5rem !important;
        }
        .text-small {
            font-size: 0.8rem !important;
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
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="pdf-col-4"></td>
                    <td class="spacer"></td>
                    <td class="pdf-col-8">
                        @component('components/certificates', ['certificates' => $certificates])@endcomponent
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="pdf-col-4"></td>
                    <td class="spacer"></td>
                    <td class="pdf-col-8">
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