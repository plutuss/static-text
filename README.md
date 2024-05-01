## Installed packages

## Laravel:

- [GitHub](https://github.com/plutuss/getid3).

```shell
 composer require plutuss/static-text-laravel
```

#### config/filesystems.php
```php
   'page-files' => [
            'driver' => 'local',
            'root' => storage_path('app/public/page-files'),
            'url' => env('APP_URL').'/storage/page-files',
            'visibility' => 'public',
        ],
```


```php
<?php

use Plutuss\Models\Page;

class PageController extends Controller
{
    public function index()
    {
    
         $page = Page::findByName('name_page');
         
         return view('welcome', compact('page'))
  
    }

}

```
####  resources/views/welcome.blade.php
```php

{{ $page->show('header:main_image') }}

```
