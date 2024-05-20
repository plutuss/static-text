<?php

namespace Plutuss\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class StorePageItemRequest extends FormRequest
{
    public function rules(Model|null $item = null): array
    {

        return [
            'name' => ['required', 'string', 'min:3', 'max:100', 'unique:page_items,name,' . $item->id ?: $this->id],
            'page_id' => ['required', 'integer', 'exists:pages,id'],
            'data' => ['required', 'array', 'min:1'],
            // data
            'data.*.key' => ['required', 'string', 'min:2', 'max:100'],
            'data.*.value' => ['required', 'string', 'min:2', 'max:100'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
