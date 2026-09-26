<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThinkClear — Password Reset Code</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #F8FAFC;
            margin: 0;
            padding: 0;
            color: #1E293B;
        }
        .email-container {
            max-width: 520px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid #E2E8F0;
        }
        .header {
            background: linear-gradient(135deg, #1E6146 0%, #0F3E2B 100%);
            padding: 32px 24px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 6px 0 0 0;
            font-size: 13px;
            opacity: 0.85;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .content {
            padding: 36px 32px;
            text-align: center;
        }
        .content h2 {
            font-size: 20px;
            font-weight: 700;
            color: #0F172A;
            margin: 0 0 12px 0;
        }
        .content p {
            font-size: 15px;
            color: #475569;
            line-height: 1.6;
            margin: 0 0 24px 0;
        }
        .otp-box {
            background: #ECFDF5;
            border: 2px dashed #10B981;
            border-radius: 12px;
            padding: 20px;
            display: inline-block;
            margin: 10px 0 24px 0;
            letter-spacing: 8px;
            font-size: 32px;
            font-weight: 800;
            color: #1E6146;
            font-family: 'Courier New', Courier, monospace;
        }
        .expiry-notice {
            font-size: 13px;
            color: #64748B;
            background: #F1F5F9;
            padding: 10px 16px;
            border-radius: 8px;
            display: inline-block;
            margin-bottom: 24px;
        }
        .footer {
            border-top: 1px solid #F1F5F9;
            padding: 20px 32px;
            text-align: center;
            font-size: 12px;
            color: #94A3B8;
            background: #FAFBFD;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>ThinkClear</h1>
            <p>Your Judgment Journey</p>
        </div>
        <div class="content">
            <h2>Password Reset Verification</h2>
            <p>Hello{{ !empty($user->name) ? ' ' . $user->name : '' }},</p>
            <p>We received a request to reset your password for your ThinkClear account. Use the verification code below to complete the reset process:</p>
            
            <div class="otp-box">
                {{ $otp }}
            </div>
            
            <div>
                <span class="expiry-notice">⏱️ This code expires in <strong>15 minutes</strong></span>
            </div>

            <p style="font-size: 13px; color: #94A3B8; margin-top: 16px;">
                If you did not request a password reset, please ignore this email or contact support if you suspect unauthorized activity.
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} ThinkClear. All rights reserved.<br>
            Building repeatable habits of clear thinking and sound judgment.
        </div>
    </div>
</body>
</html>
