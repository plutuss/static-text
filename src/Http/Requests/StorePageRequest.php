<?php

namespace Plutuss\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{
    public function rules(Model|null $item = null): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'slug' => ['required', 'unique:pages,slug,' . $item->id ?: $this->id, 'string', 'min:1', 'max:250'],
            'template' => ['required', 'unique:pages,template,' . $item->id ?: $this->id, 'string', 'min:2', 'max:250'],
            'seo_title' => ['nullable', 'string', 'min:3', 'max:70'],
            'seo_description' => ['nullable', 'string', 'min:3', 'max:160'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
