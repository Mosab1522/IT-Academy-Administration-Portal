<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Gate::denies('admin')) {
            $user = \App\Models\Instructor::find(auth()->user()->user_id); 
            if ($user) {
                // Only mark as read if 'notifications_accessed' is set in the session
                if ($request->session()->pull('notifications_accessed', false)) {
                    $user->unreadNotifications->markAsRead();
                }
            }
        } else {
            if ($request->session()->pull('notifications_accessed', false)) {
                $instructors = \App\Models\Instructor::all();

                foreach ($instructors as $i) {
                    // Check if there are any unread notifications
                    if ($i->notifications->count() > 0) {
                        // Loop through each unread notification
                        foreach ($i->notifications as $notification) {
                            // Retrieve and modify the notification data
                            if($notification->data['admin'] == false)
                            {
                                $data = $notification->data;
                            $data['admin'] = true;  // Set the 'admin' field to true

                            // Update the notification data and save
                            $notification->data = $data;
                            $notification->save();
                            }
                            
                        }
                    }
                }
            }
        }


        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
