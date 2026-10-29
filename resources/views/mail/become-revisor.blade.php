<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('ui.userRequestedToWorkWithUs', [], 'it') }} | Kintsugi</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f1ec; font-family: Arial, Helvetica, sans-serif; color: #292724;">
    <div style="display: none; max-height: 0; overflow: hidden; opacity: 0;">
        {{ __('ui.userRequestedToWorkWithUs', [], 'it') }}
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f1ec;">
        <tr>
            <td align="center" style="padding: 40px 16px;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0"
                    style="width: 100%; max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden;">
                    <tr>
                        <td style="padding: 26px 36px; background-color: #292724; border-bottom: 4px solid #c59b56;">
                            <span style="color: #ffffff; font-size: 18px; font-weight: bold; letter-spacing: 3px;">
                                KINTSUGI
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 38px 36px 18px;">
                            <h1 style="margin: 0 0 12px; color: #292724; font-size: 26px; line-height: 1.3;">
                                {{ __('ui.userRequestedToWorkWithUs', [], 'it') }}
                            </h1>
                            <p style="margin: 0; color: #6c6861; font-size: 16px; line-height: 1.6;">
                                {{ __('ui.hereAreTheirDetails', [], 'it') }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 36px 24px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="background-color: #f8f6f2; border: 1px solid #e9e3d9; border-radius: 8px;">
                                <tr>
                                    <td style="padding: 16px 18px 8px; color: #81796d; font-size: 12px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase;">
                                        {{ __('ui.name', [], 'it') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 18px 16px; color: #292724; font-size: 16px; line-height: 1.5;">
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 18px 8px; color: #81796d; font-size: 12px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase;">
                                        {{ __('ui.email', [], 'it') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 18px 16px; color: #292724; font-size: 16px; line-height: 1.5; word-break: break-word;">
                                        <p style="color: #82622d; text-decoration: underline;">
                                            {{ $user->email }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px 38px;">
                            <p style="margin: 0 0 22px; color: #6c6861; font-size: 15px; line-height: 1.6;">
                                {{ __('ui.makeUserReviewer', [], 'it') }}
                            </p>
                            <a href="{{ URL::temporarySignedRoute('make.revisor', now()->addDay(), ['user' => $user]) }}"
                                style="display: inline-block; padding: 14px 24px; background-color: #a77d3e; border-radius: 6px; color: #ffffff; font-size: 15px; font-weight: bold; text-decoration: none;">
                                {{ __('ui.makeReviewer', [], 'it') }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 18px 36px; background-color: #f8f6f2; border-top: 1px solid #e9e3d9; color: #81796d; font-size: 12px; line-height: 1.5;">
                            Kintsugi
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
