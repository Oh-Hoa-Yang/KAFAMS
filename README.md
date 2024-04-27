## How to Start

1. Clone this repository
2. Put the files in xampp/htdocs
3. Install Composer (https://getcomposer.org/) & latest php version in xampp\php
4. Rename .env.exampe to .env

Open XAMPP from here on (Apache & MySQL services)

5. Run "php artisan key:generate" in terminal
6. Change DB_CONNECTION=mysql in .env // remove # on lines starting with DB
7. Run "php artisan migrate:fresh" in terminal
8. Run "npm install -g pnpm" on your PC's command prompt/terminal/powershell (Ensure you have npm installed in PC)
9. Run "pnpm i" in terminal
10. Run "pnpm run dev" in terminal
11. Run "php artisan serve" to run local server
