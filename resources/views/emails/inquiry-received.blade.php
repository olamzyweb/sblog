<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Inquiry — AKSO PHARMA</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4faf7; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #0D3D22, #1A6B3C); padding: 24px 32px; }
        .header h1 { color: #fff; margin: 0; font-size: 20px; }
        .body { padding: 32px; }
        .field { margin-bottom: 16px; }
        .label { font-weight: bold; color: #0D3D22; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; }
        .value { color: #3F3F40; font-size: 15px; margin-top: 4px; }
        .message-box { background: #f4faf7; border-left: 3px solid #2CA0A1; padding: 16px; border-radius: 4px; margin-top: 8px; }
        .footer { padding: 20px 32px; background: #f9fafb; text-align: center; font-size: 12px; color: #6B7280; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📩 New Inquiry Received</h1>
        </div>
        <div class="body">
            <div class="field">
                <div class="label">Full Name</div>
                <div class="value">{{ $inquiry->full_name }}</div>
            </div>

            @if($inquiry->company_name)
            <div class="field">
                <div class="label">Company</div>
                <div class="value">{{ $inquiry->company_name }}</div>
            </div>
            @endif

            <div class="field">
                <div class="label">Email</div>
                <div class="value">{{ $inquiry->email }}</div>
            </div>

            <div class="field">
                <div class="label">Phone</div>
                <div class="value">{{ $inquiry->phone }}</div>
            </div>

            <div class="field">
                <div class="label">State</div>
                <div class="value">{{ $inquiry->state }}</div>
            </div>

            @if($inquiry->products_interest)
            <div class="field">
                <div class="label">Products of Interest</div>
                <div class="value">{{ $inquiry->products_interest }}</div>
            </div>
            @endif

            <div class="field">
                <div class="label">Message</div>
                <div class="message-box">{{ $inquiry->message }}</div>
            </div>
        </div>
        <div class="footer">
            This inquiry was submitted via the AKSO PHARMA website contact form.<br>
            © {{ date('Y') }} AKSO PHARMA NIGERIA LIMITED
        </div>
    </div>
</body>
</html>
