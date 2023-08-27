<?php

namespace App\Http\Controllers;

use App\services\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        $attributes = request()->validate([
            'email' => 'required|email'
        ]);



        try {
            $newsletter->subscribe($attributes['email']);

        } catch (Exception $e) {

            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter.'
            ]);

        }


        return to_route('home')
            ->with('success', 'You are now signed up for our newsletter!');
    }
}
