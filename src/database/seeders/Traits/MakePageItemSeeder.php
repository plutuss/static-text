<?php

namespace Plutuss\Database\Seeders\Traits;

use Plutuss\Models\Page;
use Plutuss\Models\PageItem;

trait MakePageItemSeeder
{

    /**
     * @return void
     */
    public function run(): void
    {
        foreach ($this->getSchema() as $pageSchema) {

            $attributes = $pageSchema['attributes'];
            $attributes['seo_title'] = $attributes['name'] . ' | ' . env('APP_NAME');
            $attributes['seo_description'] = $attributes['name'] . ' | ' . env('APP_NAME');

            $page = Page::updateOrCreate(
                [
                    'slug' => $attributes['slug']
                ],
                $attributes
            );

            foreach ($pageSchema['blocks'] as $item) {
                $item['page_id'] = $page->id;
                PageItem::updateOrCreate(
                    [
                        'page_id' => $item['page_id'],
                        'name' => $item['name']
                    ],
                    $item
                );
            }
        }
    }

}
