<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Article;

class ArticleController extends Controller
{

    /**
     * 取得所有文章(可根據條件)
     *
     * @return Response
     * @author Lindom
     */
    public function getArticles(Request $request)
    {
        $start = $request->start ?? 0;
        $count = $request->count ?? 15;
        $title = $request->title;
        $catId = $request->categoryId;
        $catId == 0 ? null : $catId;
        $authorId = $request->authorId;
        $authorId == 0 ? null : $authorId;
        $tagId = $request->tagId;
        $tagId == 0 ? null : $tagId;
        $public = $request->publicId;
        $public == 0 ? null : $public;
        $status = $request->statusId;
        $status == 0 ? null : $status;
        $star = $request->starId;
        $star == 0 ? null : $star;
        $query = $request->query;
        $articles = Article::getArticles($start, $count, $authorId, $title, $catId, $tagId, $public, $status, $star);

        $output = null;
        if (!empty($articles)) {
            foreach ($articles as $article) {
                $output[] = [
                    'id' => $article->id,
                    // 'authors' => $article->authors,
                    'authors' => array(
                        ['id' => 1, 'name' => 'admin110']
                    ),
                    'category' => array('c_id' => 1, 'name' => '日记110'),
                    'public' => $article->public,
                    'star' => $article->star,
                    'tags' => array(
                        ['id' => 1, 'name' => 'php']
                    ),
                    'created_date'=>$article->created_at,
                    'status' => $article->status,
                    'description' => $article->description,
                    'title' => $article->title
                ];
            }
            return $output;
        }
        return [];
    }

    /**
     * 新增文章
     *
     * @return Response
     * @author Lindom
     */
    public function addArticle(Request $request)
    {
        $title = $request->title;
        $author = $request->author;
        $description = $request->description;
        $createDate = $request->create_date;
        $cover = $request->cover;
        $content = $request->content;
        $catId = $request->cat_id;
        $tags = $request->tags;
        $public = $request->public;
        $status = $request->status;
        $star = $request->star;
        $res = Article::addArticles($title, $author, $description, $createDate, $cover, $content, $catId, $tags, $public, $status, $star);
        return json_decode($res);
    }

    /**
     * 修改文章
     *
     * @return Response
     * @author Lindom
     */
    public function setArticle(Request $request)
    {
        $title = $request->title;
        $author = $request->author;
        $description = $request->description;
        $createDate = $request->create_date;
        $cover = $request->cover;
        $content = $request->content;
        $catId = $request->cat_id;
        $tags = $request->tags;
        $public = $request->public;
        $status = $request->status;
        $star = $request->star;
        $res = Article::setArticles($title, $author, $description, $createDate, $cover, $content, $catId, $tags, $public, $status, $star);
        return json_decode($res);
    }

    /**
     * 刪除文章
     *
     * @return Response
     * @author Lindom
     */
    public function delArticle(Request $request)
    {
        $articleId = $request->articleId;
        $res = Article::delArticles($articleId);
        return json_decode($res);
    }
    /**
     * 取得文章内容
     *
     * @return Response
     * @author Lindom
     */
    public function getContent(Request $request)
    {
        $articleId = $request->id;
        $res = Article::getContent($articleId);
        return $res[0];
    }
}
