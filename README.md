# Mohammad Ghaith — CV Website (Laravel)

A one-page personal CV/portfolio site built with Laravel and Blade. It has light and dark themes, scroll animations, a working contact form, and a "Download CV" button.

## Install

These files go into a standard Laravel 11/12 project.

```bash
# 1. Create a fresh Laravel app
composer create-project laravel/laravel ghaith-cv
cd ghaith-cv

# 2. Copy everything from this folder into it (overwrite routes/web.php)
#    app/  config/  public/  resources/  routes/

# 3. Run it
php artisan serve
```

Then open http://127.0.0.1:8000

## Editing your content

All the text lives in **`config/cv.php`**: summary, jobs, skills, education, languages and contact details. Edit that file and refresh the page. You don't need to touch the HTML.

- Photo: replace `public/images/profile.jpg`
- CV PDF: replace `public/files/Mohammad_Ghaith_CV.pdf`
- LinkedIn/GitHub: add them to the `socials` array in `config/cv.php`
- Colours: edit the CSS variables at the top of `public/css/cv.css`

If you change `config/cv.php` after running `php artisan config:cache`, run `php artisan config:clear`.

## Contact form

Messages are validated, rate-limited to 5 per minute, protected by a honeypot field, and written to `storage/logs/laravel.log`.

To receive them by email, set the `MAIL_*` values in `.env`. For Gmail, use an App Password:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=mohamad.ziad97@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=mohamad.ziad97@gmail.com
MAIL_FROM_NAME="CV Website"
```

## File map

```
app/Http/Controllers/CvController.php   page + contact form
config/cv.php                           all CV content
routes/web.php                          GET /  and  POST /contact
resources/views/cv/index.blade.php      page layout
resources/views/partials/*.blade.php    nav, hero, about, experience, skills, education, contact
public/css/cv.css  public/js/cv.js      styling and interactions
public/images/profile.jpg               photo
public/files/Mohammad_Ghaith_CV.pdf     downloadable CV
```
