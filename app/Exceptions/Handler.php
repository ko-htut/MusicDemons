<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //$method_names = get_class_methods($this);
        //return response()->view("errors.index",compact('exception','method_names'),403);

        $code = $this->isHttpException($exception)
              ? $exception->getStatusCode()
              : 500;
    
				$breadcrumb = array(
						"Home"         =>  route('home.index'),
						"Error $code"  =>  null
				);
        
        //$method_names = get_class_methods($exception);
        //return response()->view("errors.index",compact('breadcrumb','exception','method_names'),403);

        if (view()->exists("errors.$code")) {
            return response()->view("errors.$code", compact('breadcrumb'), $code);
        } else {
            return parent::render($request, $exception);
        }
    }
    
    protected function unauthenticated($request, AuthenticationException $exception)
    {
				$breadcrumb = array(
						"Home"         =>  route('home.index'),
						"Error $code"  =>  null
				);
        
        return redirect()->guest(route('login'));
        if (view()->exists("errors.401")) {
            return response()->view("errors.401", compact('breadcrumb'), 401);
        } else {
            return parent::render($request, $exception);
        }
    }
}
