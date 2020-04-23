<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\Admin\ArticleResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticlesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('article_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArticleResource(Article::all());

    }

    public function store(StoreArticleRequest $request)
    {

        /** @var Article $article */
        $article = Article::create($request->validated());

        if ($request->file('thumbnail', false)) {
            $article->addMedia($request->file('thumbnail'))->toMediaCollection('thumbnail');
        }

        $article = $article->fresh();

        return new ArticleResource($article);

    }

    public function show(Article $article)
    {
        abort_if(Gate::denies('article_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArticleResource($article);

    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->all());

        if ($request->input('thumbnail', false)) {
            if (!$article->thumbnail || $request->input('thumbnail') !== $article->thumbnail->file_name) {
                $article->addMedia(storage_path('tmp/uploads/' . $request->input('thumbnail')))->toMediaCollection('thumbnail');
            }

        } elseif ($article->thumbnail) {
            $article->thumbnail->delete();
        }

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Article $article)
    {
        abort_if(Gate::denies('article_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $article->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
