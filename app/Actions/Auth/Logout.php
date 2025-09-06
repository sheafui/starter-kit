<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Support\Toast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logout
{
    /**
     * Log the current user out of the application.
    */

    public function __invoke(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Toast::success("You're getting logged out successfully");

        return redirect()->route('home');
    }
}
