<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Tag;
use App\Photo;
use App\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\Photo as PhotoResource;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\ArticleShow as ArticleShowResource;
use Illuminate\Support\Collection;


class ArticlesController extends Controller
{
    public function index()
    {

        $new_articles = Article::orderBy('created_at', 'desc')->take(6)->where('status', '=', 'true')->get();
        $home_articles = Article::orderBy('created_at', 'desc')->take(6)->where('home', '=', 'home')->get();
        $new_photos = Photo::all();
        $main_categories = Category::all();
        $main_photos = Photo::orderBy('created_at', 'desc')->take(10)->get();

        return [
            "new"    => ArticleResource::collection($new_articles),
            "home"    => ArticleResource::collection($home_articles),
            "photos" => PhotoResource::collection($new_photos),
            "catm" => CategoryResource::collection($main_categories),
            "gall" => PhotoResource::collection($main_photos),
        ];
    }

    public function store(ArticleStoreRequest $request)
    {
        $file = $request->file('image');
        $name = $file->hashName();
        $image = file_get_contents($file->getRealPath());
        $image_main = \Image::make($file)->resize(450,350)->encode();
        $image_thumb_main = \Image::make($file)->resize(380,320)->encode();
        $image_thumb_sub = \Image::make($file)->resize(120,80)->encode();
        $image_swiper = \Image::make($file)->resize(370,250)->encode();
        $disk = Storage::disk('public');
        $disk->put($name, $image);
        $disk->put('main_'.$name, (string)$image_main);
        $disk->put('thumb_main_'.$name, (string)$image_thumb_main);
        $disk->put('thumb_sub_'.$name, (string)$image_thumb_sub);
        $disk->put('swiper_'.$name, (string)$image_swiper);
        $this->authorize('admin', auth()->user());

        $article = Article::create([
            'title' => $request->title,
            'body'  => $request->body,
            'image' => $name,
            'author' => $request->author,
            'text' => $request->text,
            'home' => $request->home,
            'status' => $request->status,
            'category_id' => $request->category_id,

        ]);

        $article->tags()->sync(request()->tags);

        return new ArticleResource($article);
    }

    public function show(Article $article)
    {

        $new_articles = Article::orderBy('created_at', 'desc')->take(3)->get();

        return [ "main"  => new ArticleShowResource($article),
                 "new"   => ArticleShowResource::collection($new_articles),
        ];
    }

    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $this->authorize('admin', auth()->user());

        $article->title = $request->title;
        $article->body = $request->body;
        $article->text = $request->text;
        $article->author = $request->author;
        $article->home = $request->home;
        $article->status = $request->status;
        $article->category_id = $request->category_id;


        if(isset($request->image)){

            $file = $request->file('image');
            $name = $file->hashName();
            $image = file_get_contents($file->getRealPath());
            $image_main = \Image::make($file)->resize(450,350)->encode();
            $image_thumb_main = \Image::make($file)->resize(380,320)->encode();
            $image_thumb_sub = \Image::make($file)->resize(120,80)->encode();
            $image_swiper = \Image::make($file)->resize(370,250)->encode();
            $disk = Storage::disk('public');
            $disk->put($name, $image);
            $disk->put('main_'.$name, (string)$image_main);
            $disk->put('thumb_main_'.$name, (string)$image_thumb_main);
            $disk->put('thumb_sub_'.$name, (string)$image_thumb_sub);
            $disk->put('swiper_'.$name, (string)$image_swiper);
            $article->image = $name;
        }

        $article->save();

        $article->tags()->sync(request()->tags);

        return new ArticleResource($article);
    }

    public function destroy($article_id)
    {
        $this->authorize('admin', auth()->user());

        Article::findOrFail($article_id)->delete();
        return response(null,204);
    }

    public function new_arrivals_index()
    {
        $articles = Article::orderBy('created_at', 'desc')->where('status', '=', '1')->get();

        return ArticleResource::collection($articles);
    }

    public function list_articles()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();

        return ArticleResource::collection($articles);
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