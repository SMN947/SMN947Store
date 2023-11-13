# SMN947Store

## DEV setup

### Instaling tools

-   Install Xampp
-   Add `%xampp_dir%/php` to your enviroment **PATH** variable
-   Install _Composer_

### Running app

-   Clone this repository
-   Create a valid `.env` file
-   Run composer install
-   Open Xampp contolr panel and start `apache` and `mysql`
-   Run `php artisan migrate`
-   Run `npm run dev`
-   Run `php artisan serve`
-   Open http://localhost:8000/ to see the development site

## PROD Build
### Before pushing
- Run `npm run build`
- Commit and merge in main

### Firts deploy in server
- Setup the git integration in cpanel
- If no ssh/terminal is available impor manually the `vendor` folder

### After first deploy
- Commit changes
- Merge to main branch
