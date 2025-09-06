<x-slot:title>
    Forgot Password
</x-slot>

@if (session('status'))
    <div class="rounded border border-gray-700 bg-slate-900 p-4">
        <h2 class="mb-4 text-center text-lg font-bold">Reset your password</h2>
        <p class="rounded bg-emerald-400/20 p-3 text-center">An email has been sent to your mailbox.</p>
    </div>
@else
    <form wire:submit="sendPasswordResetLink"
          class="mx-auto flex w-full max-w-md flex-col gap-y-4">
        <div class="flex flex-col gap-y-1">
            <x-ui.field required>
                <x-ui.label>email address</x-ui.label>
                <x-ui.input 
                    wire:model.blur="email" 
                />
                <x-ui.error name="email" />
            </x-ui.field>
        </div>

        {{-- Action button --}}
        <x-ui.button class="w-full"
                     type="submit"
                     wire:loading.class="opacity-50 duration-300 transition"
                     wire:target="sendPasswordResetLink">
            Send link to email
            <div class="hidden"
                 wire:loading
                 wire:target="sendPasswordResetLink">
                <x-filament::loading-indicator class="h-5 w-5" />
            </div>
        </x-ui.button>

        <a class="text-base-200 text-sm underline"
           href="{{ route('login') }}">Return to login? <span class="font-bold">Log in</span></a>
    </form>
@endif
