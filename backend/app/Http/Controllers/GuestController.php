<?php

namespace App\Http\Controllers;

use App\Http\Resources\GuestResource;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $access_token): GuestResource
    {
        // アクセストークンでゲストを取得
        $guest = Guest::with('guestPhotos')
            ->where('access_token', $access_token)
            ->firstOrFail();

        // ゲストのメッセージと写真を返す
        return GuestResource::make($guest->load(['guestPhotos']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
