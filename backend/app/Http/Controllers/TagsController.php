<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TagStoreUpdateRequest;
use App\Http\Resources\Tag as TagResource;
use App\Tag;
use App\Article;
use Illuminate\Pagination\LengthAwarePaginator;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'desc')->get();
        return TagResource::collection($tags);
    }

    public function store(TagStoreUpdateRequest $request)
    {
        $this->authorize('admin', auth()->user());
        $tag = Tag::create([
            'name' => $request->name
        ]);

        return new TagResource($tag);
    }

    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    public function update(TagStoreUpdateRequest $request, Tag $tag)
    {
        $this->authorize('admin', auth()->user());
        $tag->fill($request->all());
        $tag->save();
        return new TagResource($tag);
    }

    public function destroy($tag_id)
    {
        $this->authorize('admin', auth()->user());
        Tag::findOrFail($tag_id)->delete();
        return response(null,204);
    }

    public function tag_article_index($tag_id,Request $request)
    {
        $tag = Tag::findOrFail($tag_id);

        $new_tag_articles = [];
        foreach(Article::orderBy('created_at', 'desc')->get() as $article){
            foreach($article->tags as $article_tag){
                if($article_tag->id == $tag->id){
                    $new_tag_articles[] = $article;
                }
            }
        }

        return ["new_tag_articles" => $new_tag_articles,

        ];
    }
}

?>
