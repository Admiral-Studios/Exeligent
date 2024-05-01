<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{

    public static function getByName($name): ?Setting
    {
        return Setting::where('name', $name)->first();
    }

    public static function getValueByName($name): mixed
    {
        if ($setting = self::getByName($name))
            return $setting->value;

        return null;
    }



    /** Custom funcs */
    public static function canRegister(): bool
    {
        return boolval(self::getValueByName('can_register'));
    }

}
