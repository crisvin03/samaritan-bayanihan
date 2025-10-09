# reCAPTCHA Troubleshooting Guide

## Current Issue: "ERROR for site owner: Invalid site key"

### Step 1: Verify reCAPTCHA Site Configuration

1. **Go to [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin)**
2. **Find your site** with key: `6Lc6LeUieMrAAAAAP_rVIr4Zt1dJ_PaQvVEuDYqa-Q2`
3. **Check the domains section** - it should contain:
   - `localhost`
   - `127.0.0.1`
4. **Make sure NO other domains** are listed that might conflict

### Step 2: Create a New reCAPTCHA Site (Recommended)

Since the existing site might have issues, create a fresh one:

1. **Go to [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin)**
2. **Click "Create"**
3. **Fill in exactly:**
   - **Label**: "Samaritan Bayanihan Local"
   - **reCAPTCHA type**: "reCAPTCHA v2" → "I'm not a robot" Checkbox
   - **Domains**: 
     - `localhost`
     - `127.0.0.1`
4. **Accept Terms of Service**
5. **Click "Submit"**
6. **Copy the NEW keys**

### Step 3: Update .env File

Replace the keys in your `.env` file:
```env
RECAPTCHA_SITE_KEY=your_new_site_key_here
RECAPTCHA_SECRET_KEY=your_new_secret_key_here
```

### Step 4: Clear Laravel Cache

```bash
php artisan config:clear
php artisan config:cache
```

### Step 5: Test Different URLs

Try these URLs to see which one works:
- `http://localhost:8000/register`
- `http://127.0.0.1:8000/register`
- `http://localhost/register`
- `http://127.0.0.1/register`

### Step 6: Browser Cache

1. **Clear browser cache** (Ctrl+Shift+Delete)
2. **Try incognito/private mode**
3. **Try different browser**

### Step 7: Check Browser Console

1. **Open browser developer tools** (F12)
2. **Go to Console tab**
3. **Look for JavaScript errors**
4. **Check Network tab** for failed requests

### Step 8: Alternative - Use Test Keys

For development, you can use Google's test keys:

```env
RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

**Note**: Test keys always pass validation but don't provide real security.

### Step 9: Debug Mode

Add this to your registration form to debug:

```html
<script>
console.log('reCAPTCHA Site Key:', '{{ config('services.recaptcha.site_key') }}');
console.log('Current URL:', window.location.hostname);
</script>
```

### Common Issues:

1. **Domain mismatch** - Most common cause
2. **Cached configuration** - Clear Laravel cache
3. **Browser cache** - Clear browser cache
4. **Wrong reCAPTCHA type** - Must be v2 checkbox
5. **Key format issues** - Keys should be 40 characters long

### Final Solution:

If nothing works, create a completely new reCAPTCHA site with a different Google account or wait 24 hours for the current site to reset.
