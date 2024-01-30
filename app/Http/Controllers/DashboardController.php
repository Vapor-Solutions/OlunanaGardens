<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public static function maintenance_false()
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'MAINTENANCE_MODE=true',
                'MAINTENANCE_MODE=false',
                file_get_contents($path)
            ));

            // dd(file_get_contents($path));
        }
    }
    public static function maintenance_true()
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'MAINTENANCE_MODE=false',
                'MAINTENANCE_MODE=true',
                file_get_contents($path)
            ));
        }
    }
}
