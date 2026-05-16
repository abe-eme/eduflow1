<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Check if this incoming registration request is from a teacher using an invite token
        if ($request->has('token')) {
            return $this->registerAsTeacher($request);
        }

        // --- Standard Student Registration Route ---
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // AUTOMATED RESTRUCTURING RULE:
        // Automatically approve students signing up with a certified institutional domain.
        $isSchoolEmail = Str::endsWith(strtolower($request->email), '@student.nexuslearn.edu');
        $status = $isSchoolEmail ? 'approved' : 'pending';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            // IMPORTANT FOR YOUR SYSTEM
            'role' => 'student',
            'status' => $status,
        ]);

        event(new Registered($user));

        Auth::logout(); // important: do NOT auto login

        // Redirect pending accounts with an informative notification or send approved users straight to sign in
        if ($status === 'pending') {
            return redirect('/login')->withErrors([
                'email' => 'Account created successfully! Access is pending administrator review.'
            ]);
        }

        return redirect('/login');
    }

    /**
     * Securely register an instructor using a verified single-use invitation token.
     */
    protected function registerAsTeacher(Request $request): RedirectResponse
    {
        // Lookup the invitation token and verify it is not expired or used
        $invite = DB::table('teacher_invitations')
            ->where('token', $request->token)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$invite) {
            return redirect('/login')->withErrors([
                'email' => 'This teacher invitation link is invalid, expired, or has already been used.'
            ]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create the user pre-approved with the instructor role
        $user = User::create([
            'name' => $request->name,
            'email' => $invite->email, // Enforce the exact email the admin invited
            'password' => Hash::make($request->password),
            'role' => 'instructor',
            'status' => 'approved', 
        ]);

        event(new Registered($user));

        // Consume the token so it cannot be reused
        DB::table('teacher_invitations')
            ->where('id', $invite->id)
            ->update([
                'is_used' => true, 
                'updated_at' => Carbon::now()
            ]);

        // Log the teacher in directly since they are already verified by the admin
        Auth::login($user);

        return redirect('/teacher/dashboard');
    }
}