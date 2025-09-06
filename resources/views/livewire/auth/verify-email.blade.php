<x-ui.fieldset class="max-w-3xl mx-auto mt-24 border dark:border-blue-500">
    <x-slot name="label">
        <p class="text-md font-semibold text-blue-500">Please Verify your Email:</p>
    </x-slot>
    <div class="mx-auto mt-24  text-center">
        <div class="text-md mb-4 text-gray-400">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm font-medium text-green-400">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-center">
            <button class="inline-flex rounded-md border border-green-500/20 bg-[#1C1D36] px-4 py-1 text-sm text-white"
                wire:click="sendVerification">
                {{ __('Resend Verification Email') }}
            </button>
        </div>
    </div>
</x-ui.fieldset>
