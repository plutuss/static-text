<?php

namespace Plutuss\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageItemRequest extends FormRequest
{
    public function rules(): array
    {

        $types = config('static-text.types');

        return [
            'name' => ['required', 'string', 'min:3', 'max:100', 'unique:page_items,name'],
            'page_id' => ['required', 'integer', 'exists:pages,id'],
            'data' => ['required', 'array', 'min:1'],
            // data
            'data.title' => ['required', 'string', 'min:2', 'max:100'],
            'data.value' => ['required', 'string', 'min:2', 'max:100'],
            'data.type' => ['required', 'string', 'min:2', 'max:50', 'in:' . implode(',', $types)],

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
