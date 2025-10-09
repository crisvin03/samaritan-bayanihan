# Security Testing Guide

## Pre-Testing Checklist
- [ ] reCAPTCHA keys configured
- [ ] Email service working
- [ ] Database migrations run
- [ ] Security middleware active

## Test Scenarios

### 1. Normal Registration Flow
1. Go to `/register`
2. Fill out the form with valid data
3. Complete reCAPTCHA
4. Submit registration
5. Check email for verification link
6. Click verification link
7. Verify account is created with "pending" status

### 2. Bot Protection Test
1. Try to register without completing reCAPTCHA
2. Should show error: "Please complete the reCAPTCHA verification"
3. Try rapid registration attempts
4. Should be blocked after 3 attempts

### 3. Email Verification Test
1. Register with invalid email format
2. Should show validation error
3. Register with valid email
4. Check spam folder for verification email
5. Click verification link
6. Should redirect to login with success message

### 4. Phone Verification Test
1. After email verification, go to phone verification
2. Enter phone number in format: +63 912 345 6789
3. Request verification code
4. Enter the code (check console/logs for test code)
5. Should verify successfully

### 5. Document Upload Test
1. Upload valid document (JPG, PNG, PDF)
2. Check file is stored in `storage/app/documents/verification/`
3. Verify document appears in admin dashboard

### 6. Admin Verification Test
1. Login as admin
2. Go to verification dashboard
3. Review pending users
4. Approve/reject users
5. Check user status changes

## Common Issues & Solutions

### reCAPTCHA Not Working
- Check if keys are correct in .env
- Verify domain is added to reCAPTCHA settings
- Clear browser cache

### Email Not Sending
- Check MAIL_* settings in .env
- Test with `php artisan tinker`
- Check spam folder

### SMS Not Working
- Verify Twilio credentials
- Check phone number format
- Test with console logs

### File Upload Issues
- Check storage permissions
- Verify file size limits
- Check allowed file types
