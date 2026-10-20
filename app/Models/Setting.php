<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'site_name',
    'phone',
    'whatsapp',
    'email',
    'address',
    'logo',
    'home_banner',
    'about_banner',
    'contact_banner',
    'catalogo_banner',
    'services_banner',
    'brands_banner',
    'facebook_url',
    'instagram_url',
    'linkedin_url',
])]
class Setting extends Model
{
    protected static function booted(): void
    {
        static::updating(function ($setting) {
            $imageFields = [
                'logo',
                'home_banner',
                'about_banner',
                'contact_banner',
                'catalogo_banner',
                'services_banner',
                'brands_banner',
            ];

            foreach ($imageFields as $field) {
                if ($setting->isDirty($field) && $setting->getOriginal($field)) {
                    Storage::disk('public')->delete($setting->getOriginal($field));
                }
            }
        });

        static::deleting(function ($setting) {
            $imageFields = [
                'logo',
                'home_banner',
                'about_banner',
                'contact_banner',
                'catalogo_banner',
                'services_banner',
                'brands_banner',
            ];

            foreach ($imageFields as $field) {
                if ($setting->$field) {
                    Storage::disk('public')->delete($setting->$field);
                }
            }
        });
    }
}