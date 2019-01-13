<?php ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>General Message</title>
</head>

<style>
    h1{
        font-weight: normal;
    }
</style>

<body style ="font-family: Helvetica,Arial,sans-serif; margin: 0; padding: 0; background-color:white;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#534742" style="border-collapse: collapse; background-color:#534742;">
        <tr>
            <td align="center" bgcolor="white" style="padding: 0 0 20px 0;">
                <a href="{{env('APP_URL')}}"><img src="https://ketogram.co.uk/images/email-header.jpg" alt="Ketogram.co.uk Logo" width="600" style="display: block;" /></a>
            </td>
        </tr>

        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="white" style="border-collapse: collapse;">
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" width="400" bgcolor="white" align="center"  style="max-width:400px;">
                                <tr>
                                    <td><h1 style = "color:#e47833; font-family: Calibri,Arial,sans-serif; text-align: center;">{{$title}}</h1></td>
                                </tr>

                                <tr>
                                    <td style="padding: 10px;">
                                        {!! $text !!}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" width="200" bgcolor="#e47833" align="center">
                                            <tr>
                                                <td style = "color:white; font-weight: bold; text-align: center; padding: 10px; border-radius: 5px;"><a href="{{env('APP_URL')}}/subscriptions" style="color:white; text-decoration: none;">Subscribe Now</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style = "color:black; font-family: Calibri,Arial,sans-serif; font-style: italic; margin-top: 10px;">To unsubscribe from future newsletters. Please visit the following page. <a href="{{env('APP_URL')}}/cancel-newsletter">Unsubscribe</a></p>
                                    </td>
                                </tr>

                            </table>
                        </td>

                    </tr>
                 </table>
            </td>
        </tr>

        <tr>
            <td align="center" bgcolor="white" style="padding: 20px 0 0 0;">
                <img src="https://ketogram.co.uk/images/email-footer.jpg" alt="Ketogram.co.uk Logo" width="600" style="display: block;" />
            </td>
        </tr>
    </table>
</body>