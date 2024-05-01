<?php

namespace Plutuss\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plutuss\Traits\HasPageItem;

/**
 * @method static Model|Builder add(string $name, int $page_id, array $data)
 */
class PageItem extends Model
{
    use HasFactory, HasPageItem;

    protected $fillable = [
        'name',
        'page_id',
        'data'
    ];

    protected $casts = [
        'data' => AsCollection::class,
    ];

}
