<?php

namespace App\Support;

class Assets
{
    /**
     * URL for a file in /public with a version taken from its modified time.
     *
     * The browser can cache it until the file actually changes, unlike a
     * time() or rand() query string which forces a fresh download every load.
     */
    public static function v(string $path): string
    {
        $path = ltrim($path, '/');
        $file = public_path($path);
        $version = is_file($file) ? filemtime($file) : null;

        return '/' . $path . ($version ? '?v=' . $version : '');
    }
}
