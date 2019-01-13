<?php ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>General Message</title>
</head>

<body style ="font-family: Helvetica,Arial,sans-serif; margin: 0; padding: 0; background-color:white;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#534742" style="border-collapse: collapse; background-color:#534742;">
        <tr>
            <td align="center" bgcolor="white" style="padding: 0 0 20px 0;">
                <a href="{{env('APP_URL')}}"><img src="http://ketogram.co.uk/images/logos/keto-long.png" alt="Ketogram.co.uk Logo" width="600" style="display: block;" /></a>
            </td>
        </tr>

        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="white" style="border-collapse: collapse;">
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" width="400" bgcolor="white" align="center">
                                <tr>
                                    <td><h1 style = "color:#e47833; font-family: Calibri,Arial,sans-serif; text-align: center;">
                                            @if (! empty($greeting))
                                                {{ $greeting }}
                                            @else
                                                @if ($level == 'error')
                                                    Whoops!
                                                @else
                                                    Hello!
                                                @endif
                                            @endif
                                        </h1>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 10px;">
                                        <p style = "color:black; font-family: Calibri,Arial,sans-serif; font-size:large;">
                                            @foreach ($introLines as $line)
                                                {{$line}}
                                            @endforeach
                                        </p>

                                        <?php
                                            switch ($level) {
                                                case 'success':
                                                    $actionColor = 'background-color: #22BC66;';
                                                    break;
                                                case 'error':
                                                    $actionColor = 'background-color: #dc4d2f;';
                                                    break;
                                                default:
                                                    $actionColor = 'background-color: #3869D4;';
                                            }
                                        ?>

                                        <table border="0" cellpadding="0" cellspacing="0" width="200" bgcolor="#e47833" align="center">
                                            <tr>
                                                <td style = "color:white; font-weight: bold; text-align: center; padding: 10px; border-radius: 5px;"><a href="{{ $actionUrl }}" target="_blank" style="color:white; text-decoration: none;"> {{ $actionText }}</a></td>
                                            </tr>
                                        </table>
                                    </td>

                                    <!-- Outro -->
                                    @foreach ($outroLines as $line)
                                        <p style="color:black; font-family: Calibri,Arial,sans-serif; font-size:large;">
                                            {{ $line }}
                                        </p>
                                    @endforeach

                                    <!-- Salutation -->
                                    <p style="color:black; font-family: Calibri,Arial,sans-serif; font-size:large;">
                                        Regards,<br>{{ config('app.name') }}
                                    </p>

                                    <!-- Sub Copy -->
                                    @if (isset($actionText))
                                        <table>
                                            <tr>
                                                <td>
                                                    <p style="color:black; font-family: Calibri,Arial,sans-serif; font-size: 12px;">
                                                        If you’re having trouble clicking the "{{ $actionText }}" button,
                                                        copy and paste the URL below into your web browser:
                                                    </p>

                                                    <p style="color:black; font-family: Calibri,Arial,sans-serif; font-size: 12px;">
                                                        <a href="{{ $actionUrl }}" target="_blank">
                                                            {{ $actionUrl }}
                                                        </a>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                </tr>
                            </table>
                        </td>

                    </tr>
                 </table>
            </td>
        </tr>

        <tr>
            <td align="center" bgcolor="white" style="padding: 20px 0 0 0;">
                <img src="http://ketogram.co.uk/images/4-side.png" alt="Ketogram.co.uk Logo" width="600" style="display: block;" />
            </td>
        </tr>
    </table>
</body>