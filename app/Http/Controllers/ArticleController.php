<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Traits\Permission;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    use Permission;

    public const MESSAGES = [
        'store' => 'Article was created successfully!',
        'update' => 'Article was updated successfully!',
        'delete' => 'Article was deleted successfully!',
        'permission' => 'You do not have permission to perform this action!',
    ];

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()
            ->json(Article::getActive()->get(), Response::HTTP_OK);
    }

    /**
     * @param Article $article
     * @return JsonResponse
     */
    public function show(Article $article): JsonResponse
    {
        return response()->json(
            ($article->status === Article::STATUSES['active']) ? $article : [],
            Response::HTTP_OK
        );
    }

    /**
     * @param ArticleRequest $request
     * @return JsonResponse
     */
    public function store(ArticleRequest $request): JsonResponse
    {
        auth()->user()->articles()->create($request->all());

        // TODO: Add event for send email about article created

        return response()->json(self::MESSAGES['store']);
    }

    /**
     * @param ArticleRequest $request
     * @param Article $article
     * @return JsonResponse
     */
    public function update(ArticleRequest $request, Article $article): JsonResponse
    {
        if ($this->check($article)) {
            return response()->json(
                self::MESSAGES['permission'],
                Response::HTTP_FORBIDDEN
            );
        }

        // TODO: Add event for send email about article updated

        $article->update($request->all());

        return response()->json(self::MESSAGES['update']);
    }

    /**
     * @param Article $article
     * @return JsonResponse
     */
    public function destroy(Article $article): JsonResponse
    {
        if (!$this->check($article)) {
            return response()->json(
                self::MESSAGES['permission'],
                Response::HTTP_FORBIDDEN
            );
        }

        $article->delete();

        // TODO: Add event for send email about article deleted

        return response()->json(self::MESSAGES['delete']);
    }
}
