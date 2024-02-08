<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be resent if the user did not receive the original email message.
    |
     */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     */
    public function show()
    {

    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        
        if ($request->route('id') == $request->user()->getKey() &&
            $request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        $request->user()->update([
            'email_verified' => 1,
            'email_verification_token' => $request->signature,
            'email_verified_at' => now()
        ]);

        Session::put('verify', 'success');
        Session::put('message', 'Email verified!');
        return view('auth/verify');
        // return response()->json('Email verified!');
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->email_verified == 1) {
            Session::put('verify', 'verified');
            Session::put('message', 'User already have verified email!');
            return view('auth/verify');
            // return response()->json('User already have verified email!', 422);
        }

        $request->user()->sendEmailVerificationNotification();
        Session::put('verify', 'resent');
        Session::put('message', 'The notification email has been sent');
        return view('auth/verify');
        // return response()->json('The notification has been resubmitted');
    }

}
