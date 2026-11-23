<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaRequest extends FormRequest
{
   public function authorize(): bool
{
    return true;
}

public function rules(): array
{
    $mediaId = $this->route('media')?->id;

    return [
        'title'        => 'sometimes|string|max:255|unique:media,title,' . $mediaId,
        'type'         => 'sometimes|string|max:100',
        'genre'        => 'sometimes|string|max:255',
        'description'  => 'nullable|string',
        'release_year' => 'nullable|integer|min:1900|max:2030',
    ];
}
}
