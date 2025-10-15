<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f8f9fa;">
    <div style="background-color: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); text-align: center;">
        <h2 style="color: #224abe; font-weight: bold; margin-bottom: 25px;">Reset Your Password</h2>
        
        <p style="margin-bottom: 15px;">Hello!</p>
        
        <p style="margin-bottom: 20px;">You are receiving this email because we received a password reset request for your account.</p>
        
        <a href="{{ route('password.reset', $token) }}" 
           style="display: inline-block; 
                  padding: 12px 30px; 
                  background-color: #4e73df; 
                  color: white !important; 
                  text-decoration: none; 
                  border-radius: 10px; 
                  margin: 25px 0; 
                  font-weight: 600; 
                  font-size: 16px; 
                  letter-spacing: 0.5px;">
            Reset Password
        </a>
        
        <p style="margin-bottom: 10px;">This password reset link will expire in 60 minutes.</p>
        
        <p style="margin-bottom: 20px;">If you did not request a password reset, no further action is required.</p>
        
        <div style="margin-top: 30px; padding-top: 20px; font-size: 12px; color: #666; border-top: 1px solid #eee;">
            <p style="margin-bottom: 10px;">If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
            <p style="word-break: break-all; color: #4e73df;">{{ route('password.reset', $token) }}</p>
        </div>
    </div>
</body>
</html>