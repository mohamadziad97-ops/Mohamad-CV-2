<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CvController extends Controller
{
    /**
     * Show the CV / portfolio page.
     */
    public function index()
    {
        return view('cv.index', ['cv' => config('cv')]);
    }

    /**
     * Handle the contact form: validate, then email the message using config/smtp.php.
     */
    public function contact(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:120'],
            'email'   => ['required', 'email', 'max:180'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
            'website' => ['nullable', 'max:0'], // honeypot — bots fill this in
        ]);

        $smtp = config('smtp');

        // Build a dedicated "cv_smtp" mailer from config/smtp.php (no .env editing needed).
        config([
            'mail.mailers.cv_smtp' => [
                'transport'  => 'smtp',
                'scheme'     => $smtp['encryption'] === 'ssl' ? 'smtps' : 'smtp',
                'host'       => $smtp['host'],
                'port'       => $smtp['port'],
                'username'   => $smtp['username'],
                'password'   => str_replace(' ', '', $smtp['password']),
                'timeout'    => $smtp['timeout'] ?? 15,
            ],
            'mail.from' => ['address' => $smtp['from_email'], 'name' => $smtp['from_name']],
        ]);

        $html = view('emails.contact', [
            'sender_name'  => $data['name'],
            'sender_email' => $data['email'],
            'body_text'    => $data['message'],
            'sent_at'      => now()->format('D, d M Y H:i'),
        ])->render();

        try {
            Mail::mailer('cv_smtp')->html($html, function ($m) use ($smtp, $data) {
                $m->to($smtp['to'])
                  ->replyTo($data['email'], $data['name'])
                  ->subject('CV website: message from '.$data['name']);
            });
        } catch (\Throwable $e) {
            Log::error('CV contact mail failed: '.$e->getMessage(), $data);

            return redirect()->to(url('/').'#contact')
                ->withInput()
                ->with('mail_error', 'Sorry, your message could not be sent right now. Please email me directly at '.config('cv.contact.email').'.');
        }

        Log::info('CV contact message sent', ['name' => $data['name'], 'email' => $data['email']]);

        return redirect()->to(url('/').'#contact')
            ->with('status', "Thanks! Your message has been sent — I'll get back to you soon.");
    }
}
