<?php

namespace Plutuss\Database\Seeders;

use Illuminate\Database\Seeder;
use Plutuss\Database\Seeders\Contracts\PageItemSeederInterface;
use Plutuss\Database\Seeders\Traits\MakePageItemSeeder;
use Plutuss\Wrapper\StaticTextPageWrapper;
use Plutuss\Wrapper\StaticTextWrapper;

class PageItemSeeder extends Seeder implements PageItemSeederInterface
{

    use MakePageItemSeeder;

    /**
     * @throws \Exception
     */
    public function getSchema(): array
    {
        return [
            [
                'attributes' => (new  StaticTextPageWrapper)
                    ->setAttribute('index', '/', 'index')
                    ->getAttribute(),
                'blocks' => [
                    (new StaticTextWrapper)
                        ->setName('header')
                        ->setData('main_image', '/img/home-dark.png', 'image')
                        ->setData('name_text', 'Hello, my name is ...', 'text')
                        ->setData('all_tel', '+49 423 45 876 100', 'tel')
                        ->setData('laravel', 'laravel', 'text')
                        ->setData('description_text',
                            "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).",
                            'textarea')
                        ->get(false),

                    (new StaticTextWrapper)
                        ->setName('footer')
                        ->setData('name_key', 'footer text', 'text')
                        ->get(),
                ]
            ],

        ];
    }

}
