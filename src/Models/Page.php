<?php

namespace Plutuss\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Plutuss\Traits\HasPage;

/**
 * @method static Model|Builder add(string $name, string $slug, string $template, string $seo_title = '', string $seo_description = '',)
 */
class Page extends Model
{
    use HasFactory, HasPage;

    protected $fillable = [
        'name',
        'slug',
        'template',
        'seo_title',
        'seo_description'
    ];

}
