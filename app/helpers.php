<?php

if (!function_exists('img_url')) {
    function img_url($path): string
    {
        return \Illuminate\Support\Facades\Storage::url($path);
    }
}

if (!function_exists('page_img_url')) {
    function page_img_url($file_name) {
        return img_url(\App\Models\Page::IMAGES_PATH . '/' . $file_name);
    }
}

if (!function_exists('logo_url')) {
    function logo_url($type): ?string
    {
        $logo = \App\Models\Setting::getValueByName("{$type}_logo");
        if ($logo) {
            return img_url(\App\Models\Setting::IMAGES_PATH . '/' . $logo);
        } else {
            return null;
        }
    }
}

if (!function_exists('social_img_url')) {
    function social_img_url($file_name): ?string
    {
        return img_url(\App\Models\SocialLink::IMAGES_PATH . '/' . $file_name);
    }
}

if (!function_exists('header_logo_url')) {
    function header_logo_url(): string
    {
        $url = logo_url('header');

        if ($url)
            return $url;

        return asset('images/logo.png');
    }
}

if (!function_exists('footer_logo_url')) {
    function footer_logo_url(): string
    {
        $url = logo_url('footer');

        if ($url)
            return $url;

        return asset('images/logo.png');
    }
}


if (!function_exists('leadership_tool_img_url')) {
    function leadership_tool_img_url($file_name): string
    {
        return img_url(\App\Models\LeadershipTool::IMAGES_PATH . '/' . $file_name);
    }
}
