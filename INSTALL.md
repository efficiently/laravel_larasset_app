Larasset demo application
=========================

Installation
------------

1. So just make a new app 

    ```sh
    composer create-project laravel/laravel laravel_larasset_app --prefer-dist
    ```

2. Go inside your new app path

    ```sh
    cd laravel_larasset_app
    ```

3. Follow the Larasset installation steps: https://github.com/efficiently/larasset/blob/master/README.md#installation

4. Run the Larasset server

    ```sh
    php artisan larasset:serve
	```
  
5. Open this URL in your Web browser:

    http://localhost:3000/assets/application.js

    You should see a JavaScript file with jQuery.