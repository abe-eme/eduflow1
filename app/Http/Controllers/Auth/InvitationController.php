<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InvitationController extends Controller
{
    /**
     * Generate a secure single-use invitation token for a teacher.
     */
    public function sendInvite(Request $request)
    {
        // 1. Validate that the admin provided a proper email address
        $request->validate([
            'email' => 'required|email|unique:users,email|unique:teacher_invitations,email'
        ]);

        // 2. Generate a secure, highly unique cryptographic token
        $token = Str::random(40);

        // 3. Save the token into our database table, expiring in 48 hours
        DB::table('teacher_invitations')->insert([
            'email' => $request->email,
            'token' => $token,
            'expires_at' => Carbon::now()->addDays(2),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // 4. Build the clickable registration link
        $inviteLink = url('/register/teacher?token=' . $token);

        // For now, we will return the link directly so you can test it. 
        // Later, we can connect this to a mailer class to email it out automatically!
        return back()->with([
            'success' => 'Invitation generated successfully!',
            'invite_link' => $inviteLink
        ]);
    }
}