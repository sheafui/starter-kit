<?php

namespace  App\Support;

use Illuminate\Support\Facades\Session;

final class Toast
{
    public static function success(string $content): void
    {
        static::add($content, 'success');
    }

    public static function warning(string $content): void
    {
        static::add($content, 'warning');
    }

    public static function error(string $content): void
    {
        static::add($content, 'error');
    }

    public static function info(string $content): void
    {
        static::add($content, 'info');
    }

    public static function add(string $content, string $type): void
    {

        Session::flash('notify', [
            'content' => $content,
            'type' => $type
        ]);
    }
}
