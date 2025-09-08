<?php


namespace App\Livewire\Concerns;

trait HasToast
{
    /**
     * Dispatch a success toast notification
     */
    public function toastSuccess(string $content): void
    {
        $this->toast($content, 'success');
    }

    /**
     * Dispatch a warning toast notification
     */
    public function toastWarning(string $content): void
    {
        $this->toast($content, 'warning');
    }

    /**
     * Dispatch an error toast notification
     */
    public function toastError(string $content): void
    {
        $this->toast($content, 'error');
    }

    /**
     * Dispatch an info toast notification
     */
    public function toastInfo(string $content): void
    {
        $this->toast($content, 'info');
    }

    /**
     * Dispatch a toast notification
     */
    public function toast(string $content, string $type = 'info'): void
    {
        $this->dispatch(
            'notify',
            content: $content,
            type: $type
        );
    }
}
