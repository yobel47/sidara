<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SI DARA</title>
</head>

<body style="margin:0;padding:0;background-color:#fdf2f8;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#fdf2f8;padding:40px 16px;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:520px;">

                    {{-- HEADER --}}
                    <tr>
                        <td
                            style="background:linear-gradient(135deg,#ec4899,#f43f5e);border-radius:20px 20px 0 0;padding:32px;text-align:center;">
                            <img src="https://sidara.kurobell.my.id/icon-500x500.png" style="weight:10px;height:100px"
                                alt="Logo">
                            <p style="margin:0;font-size:26px;font-weight:800;color:white;letter-spacing:-0.5px;">SI
                                DARA</p>
                        </td>
                    </tr>

                    {{-- BODY --}}
                    <tr>
                        <td
                            style="background-color:white;padding:36px 32px 32px;border-radius:0 0 20px 20px;box-shadow:0 8px 30px rgba(236,72,153,0.12);">

                            <p style="margin:0 0 6px;font-size:20px;font-weight:700;color:#111827;">
                                Halo, {{ $notifiable->name }}!
                            </p>
                            <p style="margin:0 0 28px;font-size:14px;color:#6b7280;line-height:1.7;">
                                Kami menerima permintaan <strong style="color:#374151;">reset password</strong>
                                untuk akun SI DARA kamu. Klik tombol di bawah untuk membuat password baru.
                            </p>

                            {{-- CTA BUTTON --}}
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding-bottom:28px;">
                                        <a href="{{ $url }}" style="display:inline-block;background-color:#ec4899;color:white;
                                            text-decoration:none;font-size:14px;font-weight:700;
                                            letter-spacing:1.5px;text-transform:uppercase;
                                            padding:15px 40px;border-radius:14px;
                                            box-shadow:0 4px 14px rgba(236,72,153,0.35);">
                                            Reset Password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            {{-- EXPIRY NOTE --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
                                <tr>
                                    <td style="background-color:#fff1f5;border-left:3px solid #ec4899;
                                           border-radius:0 10px 10px 0;padding:12px 16px;">
                                        <p style="margin:0;font-size:12px;color:#9d174d;line-height:1.6;">
                                            Link ini akan <strong>kedaluwarsa dalam {{ $expireMinutes }} menit</strong>.
                                            Jika sudah kedaluwarsa, kamu perlu meminta link baru.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            {{-- URL FALLBACK --}}
                            <p style="margin:0 0 4px;font-size:12px;color:#9ca3af;">
                                Jika tombol tidak berfungsi, salin link berikut ke browser:
                            </p>
                            <p
                                style="margin:0 0 28px;font-size:11px;color:#6b7280;word-break:break-all;line-height:1.6;">
                                {{ $url }}
                            </p>

                            {{-- DISCLAIMER --}}
                            <p style="margin:0;font-size:12px;color:#9ca3af;line-height:1.7;
                                  border-top:1px solid #f3f4f6;padding-top:22px;">
                                Jika kamu <strong>tidak</strong> meminta reset password, abaikan email ini.
                                Password kamu tidak akan berubah dan akun kamu tetap aman.
                            </p>

                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td style="text-align:center;padding:24px 0 0;">
                            <p style="margin:0;font-size:12px;color:#d1d5db;">
                                &copy; {{ date('Y') }} SI DARA &nbsp;&middot;&nbsp; Semua hak dilindungi.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>