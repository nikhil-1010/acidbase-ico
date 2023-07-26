<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$mail_subject}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <style type="text/css">
        body {
            background-color: #1d47ff;
            font-family: 'Open Sans', sans-serif !important;
        }

        .iX {
            display: none;
        }

        .email-header {
            max-width: 600px;
            margin: 0px auto;
        }

        .email-logo h1 {
            font-size: 16px;
            margin: 0px;
            background-color: #1d47ff;
            color: #fff;
            padding: 15px 30px;
        }

        .email-header .email-logo img {
            max-height: 64px;
        }

        .theme-email {
            max-width: 600px;
            margin: 0px auto 40px;
            padding: 0px 15px;
        }

        .theme-email .email-content {
            margin: 0px 0px 12px;
            background: #fff;
            padding: 30px 30px 40px;
        }

        .email-content-box .email-content-area {
            margin-bottom: 15px;
        }

        .email-content .email-content-top {
            background-color: transparent;
            margin-bottom: 0;
        }

        .email-content .email-content-top p {
            margin-top: 4px !important;
            font-size: 16px;
        }

        .email-content-box {
            border-top: transparent;
        }

        .email-content-box p {
            margin: 0px 0px 8px;
            font-size: 15px;
            line-height: 1.6;
            color: #444;
            font-weight: 400;
        }

        .email-content-box p:last-child {
            margin-bottom: 0px;
        }

        .email-btn {
            display: inline-block;
            width: auto;
            border-radius: 3px;
            background-color: #0686f7;
            border: 1px solid #0686f7;
            color: #fff !important;
            outline: 0;
            padding: 10px 25px;
            cursor: pointer;
            transition: all 0.5s;
            font-size: 16px;
            box-shadow: 1px 1px 10px rgba(34, 148, 230, 0);
            min-width: 125px;
            text-align: center;
            margin-left: 0px;
            text-decoration: none !important;
            transition: all 0.5s;
            font-weight: 500;
        }

        .email-footer p {
            font-size: 14px;
            margin: 0px;
            text-align: left;
            color: #444;
        }

        .email-footer p b {
            font-weight: 600;
        }

        .email-project-data {
            margin-top: 15px;
        }

        .email-project-data .email-project-data-table {
            width: 100%;
            border: 1px solid #1d47ff;
            border-collapse: collapse;
        }

        .email-project-data .email-project-data-table tr th {
            background-color: #f9f9f9;
            padding: 12px 15px;
            font-size: 15px;
            color: #222;
            font-weight: 600;
            text-align: left;
            border: 1px solid #1d47ff;
        }

        .email-project-data .email-project-data-table tr td {
            padding: 12px 15px;
            font-size: 15px;
            color: #666;
            text-align: left;
            border: 1px solid #1d47ff;
        }
    </style>
</head>

<body style="font-family: 'Open Sans', sans-serif !important;background-color: #eee;padding-top: 30px;">
    <div class="theme-email">
        <div class="email-header">
            <div class="email-logo">
                <h1>{{config('constant.PLATFORM_NAME')}}</h1>
            </div>
        </div>
        <div class="email-content">
            <div class="email-content-top mt-3" style="text-align:center">
                <p class="">Click the following link to reset your password</p>
                <a class="email-btn" href="{{URL::to("admin/forgot-password")}}/{{$forgotpass_token}}">Reset Password </a>
            </div>
        </div>
        <div class="email-footer">
            <p style="padding-bottom: 12px">Copyright©{{date('Y')}} <b>{{config('constant.PLATFORM_NAME')}}</b> All Rights Reserved</p>
        </div>
    </div>
</body>

</html>