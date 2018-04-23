**WARNING: PHP 7.1 FEATURES WERE USED! (TO REDO WITH LOWER PHP VERSION, PLEASE, CONTACT ME)**

**Setting up**
<li>In project root run: composer install</li>
<li>Set up database</li>
<li>Create .env file (as in .env.example)</li>
<li>Run command: php artisan key:generate</li>
<li>Run command: php artisan migrate</li>
<li>Run command: php artisan db:seed</li>
    
**Running app**
<li>Run command: php artisan serve</li>
<li><strong>OR</strong>: Copy app to your server</li>
<ul><strong>For quick result output: php artisan display:categories</strong></ul>

**Testing**

**Notes**
<li>One of solutions could be Nested Set libraries, but I assume I should use vanilla code.</li>
<li>Recursive solution: not using Eloquent would be sin. It's so powerful, so writing plain SQL query would be stupid.</li>
<li>Recursive solution inside blade: showing the power of blade.</li>
<li>Wrote basic unit tests to show, that code is easily testable (dependency injection pattern allows mocking ect..)</li>
    
**Summary**
<li>Tried to show as many solutions as possible to show, that you can accomplish same goal in many ways.</li>
<li>If I misunderstood something, please, let me know :)</li>
<li>Front-end is vary basic (on site job description says that you're looking for back-end. I can make it pretty, but 
    I've shown that I understand templating and styes already, so maybe it's overkill? Anyway, let me know if I should
    upgrade front-end part).</li>
    