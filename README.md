<h1>
    Crypto Trading Website
</h1>
<p>
Info:
</p>
<pre>
Web application that allows to buy and sell crypto assets according to latest
prices. Get latest crypto news headlines. Evaluate and browse assets to buy
and sell.
</pre>
<pre>
Tools used:
1. Laravel 9
2. PHP 8.0
3. MySql
</pre>


Api keys needed:
1. https://coinmarketcap.com/
2. https://newscatcherapi.com/


<p>
Setup:
</p>
after cloning project locally
<pre>
<b>composer install</b>
</pre>
<pre>
<b>npm install</b>
</pre>
<ul>
<li>create .env file and add info like in .env.example</li>
<li>in .env file configure database connection</li>
</ul>
---
<pre>
php artisan migrate:fresh
</pre>
<pre>
php artisan serve
</pre>
open another terminal
<pre>
npm run dev
</pre>
open the third terminal
<pre>
php artisan schedule:work
</pre>
<ul>
<li>click on the hosting address that php artisan serve provided in terminal</li>
<li>click in the browser generate api key(upper right corner) and refresh page</li>
</ul>

![Screenshot from 2022-09-15 05-16-49](https://user-images.githubusercontent.com/104777801/190297946-33a981c1-7cfd-409e-bb05-79fe13632fd1.png)
---
![Screenshot from 2022-09-15 05-17-08](https://user-images.githubusercontent.com/104777801/190297954-b506da98-2ae4-4197-8d28-7ca759a3ddb9.png)
---
![Screenshot from 2022-09-15 05-17-17](https://user-images.githubusercontent.com/104777801/190297960-2230e433-7b4b-486c-abc2-7ffda594a3d1.png)
---
![Screenshot from 2022-09-15 05-17-04](https://user-images.githubusercontent.com/104777801/190297968-0fe08aba-36c9-42c3-94a9-100c2b84f1c4.png)
