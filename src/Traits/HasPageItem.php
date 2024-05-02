<?php

namespace Plutuss\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Plutuss\Models\Page;
use Plutuss\Wrapper\StaticTextWrapperInterface;

trait HasPageItem
{

    /**
     * @return BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed|string
     */
    public function show(string $name, mixed $default = ''): mixed
    {

        $dataNameLocale = $name . '_' . app()->getLocale();

        $data = $this->data->whereIn('key', [$name, $dataNameLocale])->first();

        if (!isset($data['value']) || empty($data)) {
            return $default;
        }

        return $data['value'];
    }

    /**
     * @param string $name
     * @param int $page_id
     * @param array $data
     * @return Builder|Model
     */
    public static function add(
        string $name,
        int    $page_id,
        array  $data
    ): Model|Builder
    {
        return self::query()->updateOrCreate(
            [
                'name' => $name,
            ],
            [
                'page_id' => $page_id,
                'data' => $data
            ]
        );
    }

    /**
     * @param StaticTextWrapperInterface $staticTextWrapper
     * @return Model|Builder
     */
    public static function addWithWrapper(StaticTextWrapperInterface $staticTextWrapper): Model|Builder
    {
        return self::query()->updateOrCreate(
            [
                'name' => $staticTextWrapper->getName(),
                'page_id' => $staticTextWrapper->getPageId(),
            ],
            [
                'data' => $staticTextWrapper->getData()
            ]
        );
    }

}
