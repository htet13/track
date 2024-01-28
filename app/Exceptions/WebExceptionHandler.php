<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WebExceptionHandler extends Exception
{
    public function render(Exception $exception)
    {
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return redirect()
            ->back() // Redirect back to the previous page
            ->withErrors($exception->validator->getMessageBag()) // Pass the validation errors
            ->withInput(); // Keep the old input data 
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return redirect()->route('login');
        }
        
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $message = "Not found what you are searching for!";
            $code = $exception->getStatusCode();
            return redirect()->route('login');
        }

        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            toast('The requested record was not found!','error');
            return redirect()->back();
        }
        
        if ($exception instanceof \Illuminate\Database\QueryException) {
            if ($exception->getCode() == '23000') {
                toast($exception->getMessage());
                return redirect()->back();
            }
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return response()->view('error',compact('message','code'));
        }        

        $message = config('app.env') === 'local' ? $exception : 'Please contact to admin';
        $code = 500;
        return response()->view('error',compact('message','code'));
    }
}