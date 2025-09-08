<?php

namespace App\Livewire\Settings;

use App\Models\User;
use App\Support\Toast;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Livewire\Concerns\HasToast;

class Account extends Component
{
    use HasToast;

    #[Validate('required|string|min:3|max:12')]
    public string $name = '';

    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string|current_password')]
    public string $current_password = '';

    #[Validate('required|string|confirmed|min:8')]
    public string $password = '';

    public string $password_confirmation = '';

    public function mount(#[CurrentUser] User $user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function saveChanges(#[CurrentUser] User $user)
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:12'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ]);

        $user->fill($validated);

        // If the email changed we need to make it unverified, for security reasons 
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();


        $this->toastSuccess('Your account has been updated.');
    }

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(#[CurrentUser] $user): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->toastSuccess('Your password has been updated.');
    }
    public function render()
    {
        return view('livewire.settings.account');
    }
}
