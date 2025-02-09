<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;


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
        // Original Line
        // return parent::render($request, $exception);

        // Moded Line
        if ($exception instanceof TokenMismatchException){
            return redirect('tienda/login')->with("message", "Su sesión ha expirado, recarge la página e intente logearse nuevamente");
        }
        
        if($this->isHttpException($exception))
        {
            switch($exception->getStatusCode())
            {
                case 404:
                    return redirect()->route('404');
                    break;
                case '500':
                    return redirect()->route('404');
                    break;
                default: 
                    return $this->renderHttpException($exception);
                    break;
            }
        }
        return parent::render($request, $exception);
    }

    
}
