<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request) {
    //
});


App::after(function ($request, $response) {
    Event::fire('cors', [$request, $response]);
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function () {
    if (Auth::guest()) {
        if (Request::ajax()) {
            return Response::make('Unauthorized', 401);
        } else {
            return Redirect::guest('login');
        }
    }
});


Route::filter('auth.basic', function () {
    return Auth::basic();
});


/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function () {
    if (Auth::check()) {
        return Redirect::to('/');
    }
});


/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function ($route, $request) {

    /*
    | Raises an exception if a request isn't verified. Checks:
    |
    | * is it a GET or HEAD request? Gets should be safe and idempotent
    | * Does the Session CSRF token match the given token value from the input '_token' ?
    | * Does the X-CSRF-Token header match the Session CSRF token
    |
    */

    if (
        $request->isMethod('get') || $request->isMethod('head') ||
        Session::token() == Input::get('_token') || Session::token() == $request->header('X-CSRF-Token')
    ) {
        // do nothing
    } else {
        // Choose one of this three settings:

        /*
        | Provides an empty session during request but doesn't reset it completely. You should use it as default
        */
        Session::flush();

        /*
        | Resets the session. Useful for API.
        */
        // Session::flush();
        // Session::regenerate(true);

        /*
        | Raises Exception. Laravel default setting
        */
        // throw new Illuminate\Session\TokenMismatchException;
    }
});


/*
| Verify that we aren't serving an unauthorized cross-origin JavaScript response.
|
| GET requests are not protected since they don't have side effects like writing
| to the database and don't leak sensitive information. JavaScript requests are
| an exception: a third-party site can use a <script> tag to reference a JavaScript
| URL on your site. When your JavaScript response loads on their site, it executes.
| With carefully crafted JavaScript on their end, sensitive data in your JavaScript
| response may be extracted. To prevent this, only XmlHttpRequest (known as XHR or
| Ajax) requests are allowed to make GET requests for JavaScript responses.
|
*/

Event::listen('cors', function ($request, $response) {
    if (
        $request->isMethod('get') &&
        $request->getFormat($response->headers->get('Content-Type')) == 'js' &&
        ! $request->ajax()
    ) {
        $cross_origin_javascript_warning = "Security warning: an embedded " .
            "<script> tag on another site requested protected JavaScript. " .
            "If you know what you're doing, go ahead and disable CSRF " .
            "protection on this action to permit cross-origin JavaScript embedding.";

        Log::warning($cross_origin_javascript_warning);
        throw new \Exception($cross_origin_javascript_warning);
    }
});
