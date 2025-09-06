<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        session()->flash('notify', [
            'content' => 'You\'re getting logged out successfully',
            'type' => 'success'
        ]);

        return redirect()->route('guide.show', ['guide' => 'overview']);
    }
}
