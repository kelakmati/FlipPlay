<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;

class UserCollectionController extends Controller
{
    public function index(User $user)
    {
        $user->load('media');
        return new UserResource($user);
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'media_id' => 'required|exists:media,id',
        ]);

        if ($user->media()->where('media_id', $request->media_id)->exists()) {
            return response()->json([
                'message' => 'Media sudah ada di koleksi pengguna'
            ], 409);
        }

        $user->media()->attach($request->media_id);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi'
        ], 201);
    }

    public function destroy(User $user, Media $media)
    {
        $user->media()->detach($media->id);

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi'
        ]);
    }
}
