<?php

namespace App\Helpers;

trait roleTrait
{
    private function setPrefix()
    {
        $rawType = auth()->user()->raw_type;
        switch ($rawType) {
            case 1:
                return 'finance.';
            case 2:
                return 'absen.';
            case 3:
                return 'academic.';
            case 4:
                return 'musyrif.';
            case 5:
                return 'support.';
            case 6:
                return 'sitemanager.';
            default:
                return 'web-admin.';
        }
    }
}
