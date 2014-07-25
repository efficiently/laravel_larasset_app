Init Laravel with Larasset demo application
===========================================

[![Build Status](https://travis-ci.org/efficiently/laravel_larasset_app.svg?branch=master)](https://travis-ci.org/efficiently/laravel_larasset_app)

1. Get a copy of this demo on your computer

  ```sh
  git clone https://github.com/efficiently/laravel_larasset_app.git
  cd laravel_larasset_app/
  composer install
  ```

2. Setup your local environment within the `bootstrap/start.php` file

  You may determine your computer name using the `hostname` terminal command, then add it like this:

  ```php
  <?php

  $env = $app->detectEnvironment(array(
      'local' => array('your-computer-name'),
  ));
  ```

3. Install the Node.js module of this package

  ```sh
  npm install -g vendor/efficiently/larasset
  ```

6. Run your Laravel application and the assets servers

  ```sh
  php artisan server
  ```

  Then open this URL in your Web browser: [http://localhost:8000/messages](http://localhost:8000/messages)

  You can read how this demo was build [HERE](https://github.com/efficiently/larasset/wiki/Server-generated-JavaScript-Responses).
