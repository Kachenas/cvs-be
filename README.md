## About CVS-BE

- This repository is made for generation of Customer Voucher System.
- First setup Laragon as the working environment and follow the setup installation including DB and extension
- Go to WWW of your Laragon and open a git terminal.
- git clone git@github.com:Kachenas/cvs-be.git
- type cd cvs-be to go inside that folder
- rename .env copy to .env
- run composer install
- run php artisan config:clear && php artisan config:cache && php artisan optimize:clear
- type php artisan:migrate
- type php artisan passport:install
- php artisan db:seed
- php artisan test - to run the test.

*Once testing is done, you can run php artisan serve
- Check your database for the account created by artisan test or register account

