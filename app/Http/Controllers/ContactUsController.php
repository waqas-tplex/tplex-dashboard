<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Mail;

class ContactUsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactUsRequest $request): Response
    {
        ContactUs::create($request->all());

        Mail::send(['html' => 'contact-email-template'], $request->all(), function($message) {
            $message->to(config('mail.admin.address'), config('mail.admin.name'))
            ->subject('Contact Form Submission');
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });

        return Inertia::render('Contact', [
            'message' => __('contact-form-submitted'),
            'status'  => 'OK',
            'code'    => 200
        ]);
    }
}
