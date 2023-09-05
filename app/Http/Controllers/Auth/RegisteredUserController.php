<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {   
        $instructor_id = session('instructor_id') ?? request()->instructor_id;

        request()->merge(['instructor_id'  => $instructor_id]); 

        session()->forget('instructor_id');
        $request->validate([
            'instructor_id' => ['required' , 'integer', Rule::exists('instructors', 'id')],
            'nickname' => ['required', 'string', 'max:255', Rule::unique('users', 'nickname')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = User::create([
            'nickname' => $request->nickname,
            'user_id' => $instructor_id,
            'password' => password_hash($request->password, PASSWORD_ARGON2ID, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]),
        ]);

         event(new Registered($user));


        return redirect('/');
    }
}
