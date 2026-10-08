<!DOCTYPE html>
<html>
<body style="margin:0;padding:0;background:#eef3f1;font-family:Segoe UI,Arial,sans-serif;color:#0d1f1f;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#eef3f1;padding:28px 12px;">
  <tr><td align="center">
    <table role="presentation" width="560" cellpadding="0" cellspacing="0" style="max-width:560px;width:100%;background:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #dbe6e2;">
      <tr>
        <td style="background:#0e8c74;background:linear-gradient(120deg,#0e8c74,#157f96);padding:22px 28px;color:#ffffff;">
          <div style="font-size:12px;letter-spacing:2px;text-transform:uppercase;opacity:.85;">CV website · New message</div>
          <div style="font-size:22px;font-weight:700;margin-top:6px;">{{ $sender_name }} sent you a message</div>
        </td>
      </tr>
      <tr>
        <td style="padding:24px 28px 8px;">
          <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:14px;line-height:1.6;">
            <tr><td style="color:#6b7f7c;padding-right:14px;">Name</td><td style="font-weight:600;">{{ $sender_name }}</td></tr>
            <tr><td style="color:#6b7f7c;padding-right:14px;">Email</td><td><a href="mailto:{{ $sender_email }}" style="color:#0e8c74;font-weight:600;">{{ $sender_email }}</a></td></tr>
            <tr><td style="color:#6b7f7c;padding-right:14px;">Sent</td><td>{{ $sent_at }}</td></tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="padding:12px 28px 24px;">
          <div style="background:#f6f3ec;border-left:4px solid #e6c27a;border-radius:8px;padding:16px 18px;font-size:15px;line-height:1.65;white-space:pre-wrap;">{{ $body_text }}</div>
        </td>
      </tr>
      <tr>
        <td style="padding:0 28px 28px;">
          <a href="mailto:{{ $sender_email }}?subject=Re:%20Your%20message" style="display:inline-block;background:#0e8c74;color:#ffffff;text-decoration:none;font-weight:700;padding:12px 22px;border-radius:999px;">Reply to {{ $sender_name }}</a>
          <div style="font-size:12px;color:#8a9a97;margin-top:14px;">Tip: just press Reply in your mail app — it goes straight to {{ $sender_email }}.</div>
        </td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
