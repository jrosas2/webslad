<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMediaRequest;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class MediaController extends Controller
{
    public function index(): View
    {
        return view('admin.media.index', [
            'mediaItems' => Media::query()->latest()->paginate(18),
        ]);
    }

    public function store(StoreMediaRequest $request): RedirectResponse
    {
        $image = $request->file('image');
        $path = $image->store('site', 'public');

        if ($path === false) {
            throw new RuntimeException('No fue posible guardar la imagen.');
        }

        Media::query()->create([
            'disk' => 'public',
            'path' => $path,
            'filename' => basename($path),
            'alt_text' => $request->string('alt_text')->toString() ?: null,
            'mime_type' => $image->getMimeType(),
            'size' => $image->getSize(),
        ]);

        return back()->with('status', 'Imagen cargada correctamente.');
    }

    public function destroy(Media $media): RedirectResponse
    {
        $disk = Storage::disk($media->disk);

        if ($disk->exists($media->path) && ! $disk->delete($media->path)) {
            return back()->with('error', 'No fue posible eliminar la imagen.');
        }

        $media->delete();

        return back()->with('status', 'Imagen eliminada correctamente.');
    }
}
