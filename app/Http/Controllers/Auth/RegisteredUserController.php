<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\EmployerProfile;
use App\Models\Jobseeker;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // auto create employer
        if ($user->role === 'employer') {
            EmployerProfile::create([
                'user_id' => $user->id,
                'company_name' => 'New Company'
            ]);
        }

        // auto create jobseeker
        if ($user->role === 'jobseeker') {
            Jobseeker::create([
                'user_id' => $user->id,
                'display_name' => $request->name,
                'display_email' => $request->email,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // redirect to employer dashboard
        if ($user->role === 'employer') {
            return redirect('/employer/dashboard');
        }

        return redirect(route('dashboard', absolute: false));
    }
}
