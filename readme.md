**WARNING: PHP 7.1 FEATURES WERE USED! (TO REDO WITH LOWER PHP VERSION PLEASE CONTACT)**

**Setting up**
   -In project root run: composer install
   -Set up database
   -Create .env file (as in .env.example)
   -Run command: php artisan key:generate
   -Run command: php artisan migrate
   -Run command: php artisan db:seed
    
**Running app**
    -Run command: php artisan serve
    -OR: Copy app to your server
    -For quick result output: php artisan display:categories

**Testing**

**Notes**
    -One of solutions could be Nested Set libraries, but I assume I should use vanilla code.
    -Recursive solution: not using Eloquent would be sin. It's so powerful, so writing plain SQL query would be stupid.
    -Recursive solution inside blade: showing the power of blade.
    
**Summary**
    -Tried to show as many solutions as possible to show, that you can accomplish same goal in many ways.
    -If I misunderstood something, please, let me know :)
    