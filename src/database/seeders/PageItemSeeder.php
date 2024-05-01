<?php

namespace Plutuss\Database\Seeders;

use Illuminate\Database\Seeder;
use Plutuss\Models\Page;
use Plutuss\Models\PageItem;

class PageItemSeeder extends Seeder
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


    private function getSchema(): array
    {
        return [
            [
                'attributes' => [
                    'name' => 'index',
                    'slug' => '/',
                    'template' => 'index'
                ],
                'blocks' => [
                    [
                        'name' => 'header',
                        'data' => [
                            [
                                "#" => 1,
                                "key" => "main_image",
                                "value" => "/img/home-dark.png",
                                "type" => "file",
                            ],
                            [
                                "#" => 2,
                                "key" => "name_text",
                                "value" => "Hello, my name is ...",
                                "type" => "text",
                            ],
                            [
                                "#" => 3,
                                "key" => "laravel",
                                "value" => 'Laravel',
                                "type" => "text",

                            ],
                            [
                                "#" => 4,
                                "key" => "description_text",
                                "value" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).",
                                "type" => "textarea",
                            ],

                        ]
                    ],
                ]
            ],

        ];
    }

}
