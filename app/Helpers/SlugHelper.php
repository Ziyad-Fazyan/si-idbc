<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class SlugHelper
{
    public static function generate(string $name, string $modelClass = \App\Models\newsCategory::class, string $column = 'slug', ?int $id = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        // Cek apakah slug sudah ada di model
        while (self::slugExists($slug, $modelClass, $column, $id)) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }

    protected static function slugExists(string $slug, string $modelClass, string $column, ?int $id = null): bool
    {
        $query = $modelClass::where($column, $slug);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        return $query->exists();
    }
}
