<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        return MediaResource::collection($query->paginate(10));
    }

    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());

        return (new MediaResource($media))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Media $media)
    {
        $media->load('users');
        return new MediaResource($media);
    }

    public function update(UpdateMediaRequest $request, Media $media)
    {
        $media->update($request->validated());
        return new MediaResource($media);
    }

    public function destroy(Media $media)
    {
        $media->delete();
        return response()->json(['message' => 'Media berhasil dihapus']);
    }
}
