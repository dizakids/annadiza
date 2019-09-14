<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhotoStoreRequest;
use App\Http\Requests\PhotoUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Photo;
use Redis;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Photo as PhotoResource;
use Illuminate\Support\Collection;


class PhotosController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        $new_photos = Photo::orderBy('created_at', 'desc')->take(3)->get();

        return [
          "photos" => PhotoResource::collection($photos),
          "new"    => PhotoResource::collection($new_photos),
        ];
    }

    public function store(PhotoStoreRequest $request)
    {

        $file = $request->file('image');
        $name = $file->hashName();
        $image = file_get_contents($file->getRealPath());
        $image_main = \Image::make($file)->resize(450,350)->encode();
        $image_thumb_main = \Image::make($file)->resize(380,320)->encode();
        $image_thumb_sub = \Image::make($file)->resize(120,80)->encode();
        $disk = Storage::disk('public');
        $disk->put($name, $image);
        $disk->put('main_'.$name, (string)$image_main);
         $disk->put('thumb_main_'.$name, (string)$image_thumb_main);
        $disk->put('thumb_sub_'.$name, (string)$image_thumb_sub);
        $this->authorize('admin', auth()->user());

        $photo = Photo::create([
            'title' => $request->title,
            'image' => $name,
        ]);

        return new PhotoResource($photo);
    }

    public function show(Photo $photo)
    {
        $new_photos = Photo::orderBy('created_at', 'desc')->take(2)->get();

        return [ "main"  => new PhotoResource($photo),
                 "new"   => PhotoResource::collection($new_photos),
        ];
    }

    public function update(PhotoUpdateRequest $request,Photo $photo)
    {
        $this->authorize('admin', auth()->user());

        $photo->title = $request->title;

        if(isset($request->image)){

            $file = $request->file('image');
            $name = $file->hashName();
            $image = file_get_contents($file->getRealPath());
            $image_main = \Image::make($file)->resize(450,350)->encode();
            $image_thumb_main = \Image::make($file)->resize(380,320)->encode();
            $image_thumb_sub = \Image::make($file)->resize(120,80)->encode();
            $disk = Storage::disk('public');
            $disk->put($name, $image);
            $disk->put('main_'.$name, (string)$image_main);
            $disk->put('thumb_main_'.$name, (string)$image_thumb_main);
            $disk->put('thumb_sub_'.$name, (string)$image_thumb_sub);
            $photo->image = $name;
        }

        $photo->save();

        return new PhotoResource($photo);
    }

    public function destroy($photo_id)
    {
        $this->authorize('admin', auth()->user());

        Photo::findOrFail($photo_id)->delete();
        return response(null,204);
    }


    public function new_foto()
    {
        $photos = Photo::orderBy('created_at', 'desc')->get();//->paginate(5);

        return PhotoResource::collection($photos);
    }

    public function list_photos()
    {
        $photos = Photo::orderBy('created_at', 'desc')->get();//->paginate(5);

        return PhotoResource::collection($photos);
    }

    public function show_image($filename)
    {
        $disk = Storage::disk('public');
        try {
            $contents = $disk->get($filename);
            $mimeType = $disk->mimeType($filename);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 404);
        }
        return response($contents)->header('Content-Type', $mimeType);
    }

}
?>

