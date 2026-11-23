<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
{
    return true;
}

public function rules(): array
{
    return [
        'title'        => 'required|string|max:255|unique:media,title',
        'type'         => 'required|string|max:100',
        'genre'        => 'required|string|max:255',
        'description'  => 'nullable|string',
        'release_year' => 'nullable|integer|min:1900|max:2030',
    ];
}
}
