<?php

namespace Plutuss\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Plutuss\Models\PageItem;

trait HasPage
{

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(PageItem::class);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public static function findByName(string $name): mixed
    {
        return self::whereName($name)
            ->with('items')
            ->first();
    }

    /**
     * @param string|null $slug
     * @return mixed
     */
    public static function findBySlug(string $slug = null): mixed
    {
        $requestUrl = request()->route()->uri;

        return self::whereIn('slug', [$slug ?: $requestUrl, '/' . $requestUrl])
            ->with('items')
            ->first();
    }

    /**
     * @param string|null $name
     * @return mixed
     */
    public static function findByRouteName(string $name = null): mixed
    {
        return self::whereName($name ?: request()->route()->getName())
            ->with('items')
            ->first();
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed|string
     */
    public function show(string $key, mixed $default = ''): mixed
    {
        [$blockName, $name] = explode(':', $key);

        return $this->items()
            ->whereName($blockName)
            ->first()
            ->show($name) ?? $default;
    }

    /**
     * @param string $name
     * @param string $slug
     * @param string $template
     * @param string $seo_title
     * @param string $seo_description
     * @return Builder|Model
     */
    public static function add(
        string $name,
        string $slug,
        string $template,
        string $seo_title = '',
        string $seo_description = ''
    ): Model|Builder
    {
        return self::query()->updateOrCreate(
            [
                'slug' => $slug,
                'template' => $template,
            ],
            [
                'name' => $name,
                'seo_title' => $seo_title,
                'seo_description' => $seo_description
            ]
        );
    }
}
