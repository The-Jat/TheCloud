<?php

namespace Botble\Cloudify\Http\Requests;

use Botble\Support\Http\Requests\Request;

class StoreMediaFileRequest extends Request
{
    public function rules(): array
    {
        return [
            'file' => ['required', 'file'],
            'folder_id' => ['nullable', 'string'],
            'folder_slug' => ['nullable', 'string', 'max:191'],
            'is_public' => ['nullable', 'boolean'],
        ];
    }
}
