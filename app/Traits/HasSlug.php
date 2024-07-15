<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(Model $model): void
    {        
        static::creating(function(Model $model) {
            if (!$model->{$model->slugKey()}) {
                $model->{$model->slugKey()} = static::generateUniqueSlug($model->sluggable());
            }
        });
    }

    public static function generateUniqueSlug(?string $sluggableString): string
    {
        if (!$sluggableString) {
            return null;
        }

        $counter = 1;
        $slug = Str::slug($sluggableString);

        while (static::whereSlug($slug)->exists()) {
            $slug = Str::slug($sluggableString) . '-' . $counter++;
        }

        return $slug;
    }
}
