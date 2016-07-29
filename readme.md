Init Laravel with [Larasset](https://github.com/efficiently/larasset/tree/1.2) demo application
===========================================

[![Build Status](https://travis-ci.org/efficiently/laravel_larasset_app.svg?branch=turbo5-l5.1)](https://travis-ci.org/efficiently/laravel_larasset_app)

This demo will show you how to give to your Laravel 5.1 application some Ajax requests quickly and easily!

Prerequisites
-------------

You must [install Node.js](http://nodejs.org) on your computer <small>(development environment only)</small>.

Laravel 5.1 is **only** compatible with **PHP >= 5.5**.


Installation
------------

1. Get a copy of this demo on your computer

  ```sh
  git clone https://github.com/efficiently/laravel_larasset_app.git --branch turbo5-l5.1
  cd laravel_larasset_app
  composer install
  ```

2. Install the Node.js module of this package

  ```sh
  npm install -g larasset-js
  ```

3. Run your Laravel application and the assets servers

  ```sh
  php artisan server
  ```

  Then open this URL in your Web browser: [http://localhost:8000/messages](http://localhost:8000/messages)

  You can read how this demo was build [HERE](https://github.com/efficiently/larasset/wiki/Server-generated-JavaScript-Responses).
