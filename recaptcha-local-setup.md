# reCAPTCHA Local Development Setup

## Create New reCAPTCHA Site for Local Development

### Step 1: Create New Site
1. Go to [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin)
2. Click "Create"
3. Fill in the form:
   - **Label**: "Samaritan Bayanihan Local Dev"
   - **reCAPTCHA type**: "reCAPTCHA v2" → "I'm not a robot" Checkbox
   - **Domains**: 
     - `localhost`
     - `127.0.0.1`
     - (Do NOT include ports like :8000)
4. Accept Terms of Service
5. Click "Submit"

### Step 2: Get New Keys
After creating the site, you'll get new keys:
- **Site Key**: (copy this)
- **Secret Key**: (copy this)

### Step 3: Update .env File
Replace the current keys in your `.env` file:
```env
RECAPTCHA_SITE_KEY=your_new_site_key_here
RECAPTCHA_SECRET_KEY=your_new_secret_key_here
```

### Step 4: Clear Cache
Run these commands:
```bash
php artisan config:clear
php artisan config:cache
```

### Step 5: Test
Refresh your registration page - reCAPTCHA should now work!
