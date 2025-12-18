# Quick Setup Guide - Google OAuth

## Prerequisites
- PHP 8.2+
- Composer
- Laravel 11
- MySQL Database

## Step-by-Step Setup

### 1. Install Firebase JWT Library
```bash
composer require firebase/php-jwt
```

### 2. Get Google OAuth Credentials

**Go to Google Cloud Console:**
1. Visit https://console.cloud.google.com/
2. Create a new project or select existing one
3. Enable Google+ API:
   - Go to "APIs & Services" → "Library"
   - Search for "Google+ API"
   - Click "Enable"

4. Create OAuth 2.0 Credentials:
   - Go to "APIs & Services" → "Credentials"
   - Click "Create Credentials" → "OAuth client ID"
   - Choose "Web application"
   - Add Authorized JavaScript origins:
     ```
     http://localhost:8000
     http://127.0.0.1:8000
     http://yourdomain.com
     ```
   - Add Authorized redirect URIs:
     ```
     http://localhost:8000/auth/google/callback
     http://127.0.0.1:8000/auth/google/callback
     http://yourdomain.com/auth/google/callback
     ```
   - Click "Create"
   - Copy Client ID and Client Secret

### 3. Configure .env File

Edit `.env` and add:
```env
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 4. Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
```

### 5. Run Server
```bash
php artisan serve
```

### 6. Test It Out
- Navigate to http://localhost:8000
- Click "Login / Register" in the navbar
- You should see a beautiful modal with Google Sign-In button
- Click the Google button to test

## Testing Users

### For Development:
- Use a real Google account to test
- The system will automatically create a user on first login
- Subsequent logins will authenticate existing user

### Test Credentials:
You can use your personal Google account for testing!

## Features Overview

### Admin Login
- Modern gradient design
- Animated backgrounds
- Enhanced form controls
- Better error handling

### User Authentication Modal
- Beautiful modal dialog
- Tabs for Login/Register
- Google OAuth integration
- Email/Password authentication

### Order PDF
- Professional invoice design
- Gradient headers
- Clear order details
- Company branding

## Troubleshooting

### Google Sign-In Not Working
1. **Check Client ID**: Verify GOOGLE_CLIENT_ID in .env
2. **Check Domain**: Add your domain to Google Console
3. **Browser Console**: Check for JavaScript errors (F12)
4. **Network Tab**: Verify token is being sent to backend

### Token Verification Error
1. **Check Logs**: `tail -f storage/logs/laravel.log`
2. **Verify Library**: Confirm firebase/php-jwt is installed
3. **Token Format**: Ensure token is complete and not truncated

### Modal Not Appearing
1. **Check Bootstrap**: Verify Bootstrap 5 CSS/JS loaded
2. **JavaScript**: Ensure no console errors
3. **Cache**: Clear browser cache (Ctrl+Shift+Del)

### PDF Not Generating
1. **DomPDF**: Verify `barryvdh/laravel-dompdf` is installed
2. **Fonts**: Check if fonts are accessible
3. **Permissions**: Ensure storage/logs directory is writable

## Email Configuration (Optional)

For email notifications with Google account:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=ssl
```

## Security Notes

✅ **JWT Verification**: All Google tokens are verified server-side
✅ **CSRF Protection**: All forms have CSRF tokens
✅ **Password Hashing**: OAuth users get random secure passwords
✅ **Email Verification**: Auto-verified for OAuth users
✅ **Session Management**: Secure session handling

## Performance Tips

1. **Enable Query Caching**: Reduce database calls
2. **Use CDN**: For static assets
3. **Optimize Images**: Compress product images
4. **Cache Views**: Use view caching in production

## Production Checklist

- [ ] GOOGLE_CLIENT_ID set in production .env
- [ ] GOOGLE_CLIENT_SECRET set in production .env
- [ ] APP_DEBUG set to false
- [ ] Database backups configured
- [ ] Email notifications configured
- [ ] SSL/HTTPS enabled
- [ ] Google Console updated with production URLs
- [ ] Error logging configured
- [ ] Rate limiting configured

## Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| Blank page after login | Check APP_KEY is set, clear config cache |
| Google button not showing | Verify script tag for Google Sign-In library |
| "Invalid client_id" error | Check GOOGLE_CLIENT_ID matches in Google Console |
| Token expired | Tokens automatically refresh, check server time |
| Database error | Run migrations: `php artisan migrate` |
| 404 on /auth/google | Check routes are loaded: `php artisan route:list` |

## Next Steps

1. ✅ Set up Google OAuth credentials
2. ✅ Update .env with credentials
3. ✅ Test login functionality
4. ✅ Test registration
5. ✅ Test PDF generation
6. ✅ Deploy to production

## Support

For issues:
1. Check `storage/logs/laravel.log`
2. Run `php artisan tinker` to debug
3. Use browser DevTools (F12) to inspect
4. Check Google Cloud Console for logs

---

**Happy coding! 🚀**
