## Installed packages

## Laravel:
- [GitHub](https://github.com/plutuss/static-text).

The "**Static Text Laravel**" package provides a simple and effective solution for managing static text and images on your website directly from the Laravel admin panel. With its capabilities, you can update your site's content without the need for developer intervention, making content management more flexible and convenient.

Key Features:

1. **Static Text Management**: Allows site administrators to easily update textual content such as headers, paragraphs, lists, and other elements without altering code or reloading the page.
2. **Image Editing**: Enables uploading new images and updating existing ones directly from the administrative panel. This is convenient for updating banners, logos, and other visual elements of the site.
3. **Multilingual Support**: Provides the ability to manage content in multiple languages, particularly useful for multilingual sites.
4. **Access Control**: Offers flexible access settings for administrators and content editors, restricting access to functionality based on user roles.
5. **Laravel Integration**: Fully compatible with the Laravel framework and utilizes best development practices such as migrations, seeders, and service providers.

```shell
 composer require plutuss/static-text-laravel
```

```shell
php artisan vendor:publish --provider="Plutuss\Providers\StaticTextServiceProvider"
```

```shell
php artisan migrate
```



```php
<?php

use Plutuss\Models\Page;
use Plutuss\Http\Requests\StorePageRequest;
use Plutuss\Http\Requests\StorePageItemRequest;

class PageController extends Controller
{
    public function index()
    {
         $page = Page::findByName('name_page');
         
         return view('welcome', compact('page'))
    }
    
    public function addPage(StorePageRequest $request)
    {
          $page = Page::add(
                name: 'home',
                slug: '/',
                template: 'main',
                seo_title: 'seo_title', // this field can be empty
                seo_description: 'seo_description' // this field can be empty
          ); 
    }
    
        
    public function addPageItem(StorePageItemRequest $request)
    {
          $page = Page::findByName('home');
    
          $pageItem = PageItem::add(
            name: 'header',
            page_id: $page->id,
            data: [
                [
                    'key' => 'h1',
                    'value' => 'Installed packages Laravel',
                    'type' => 'text',
                ],
                [
                    'key' => 'image-bg',
                    'value' => 'path/image.jpg', // path image or file
                    'type' => 'image',  // or file
                ]
            ]);
    }
    
    public function addPageItemWithLocale()
    {
           $pageItem = PageItem::add(
                name: 'header',
                page_id: $page->id,
                data: [
                    [
                        'key' => 'h3_en', // You can specify a key with the available localisations in the application
                        'value' => 'Installed packages Laravel',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'h3_de',  // You can specify a key with the available localisations in the application
                        'value' => 'Installierte Pakete Laravel',
                        'type' => 'text',
                    ]
                ]);
    }

}

```
###  resources/views/*.blade.php
```php

    <h1> {{ $page->show('header:h1') }} </h1>
    
    // You can specify a default value
    // if the required value is not found in the database.
   {{ $page->show('header:description_text','default value') }}
   
    // Call to a view without specifying a locale
    <h3> {{ $page->show('header:h3') }} </h3>

```


### You can use the wrapping class
```php

    $page = Page::query()->first();

    $wrapper = new  StaticTextWrapper();

    $wrapper->setName('header');
    $wrapper->setPageId($page->id);
    $wrapper->setData('h1_title', 'packages', 'text');
    $wrapper->setData('description', 'Installed packages laravel', 'text');
    $wrapper->setData('package_url', 'https://github.com/plutuss/static-text', 'url');

    $pageItem = PageItem::addWithWrapper($wrapper);
    
    // Or  *************************************
    
    $page = Page::query()->first();

    $wrapper = (new  StaticTextWrapper())->setName('header')
        ->setPageId($page->id)
        ->setData('h1_title', 'packages', 'text')
        ->setData('description', 'Installed packages laravel', 'text')
        ->setData('package_url', 'https://github.com/plutuss/static-text', 'url');

    $pageItem = PageItem::addWithWrapper($wrapper);

```

### You can also get a ready array of data to save 
 - use a method  **get()**
```php
    $page = Page::query()->first();

    $wrapper = (new  StaticTextWrapper())->setName('header')
        ->setPageId($page->id)
        ->setData('h1_title', 'packages', 'text')
        ->setData('description', 'Installed packages laravel', 'text')
        ->setData('package_url', 'https://github.com/plutuss/static-text', 'url')
        ->get();
        
    $pageItem = PageItem::create($wrapper);

```
- then call in the **blade**
```php

   {{ $page->show('header:h1_title') }}

   {{ $page->show('header:description') }}
   
   {{ $page->show('header:package_url') }}
```
