<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Article;
use App\Model\Author;
use App\Model\Cat;
use App\Model\Tag;

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
        $authorId = $request->authorId;
        $tagId = $request->tagId;
        $public = $request->publicId;
        $status = $request->statusId;
        $star = $request->starId;

        $articles = Article::getArticles($start, $count, $authorId, $catId, $tagId, $public, $status, $star);

        $output = [];
        if (empty($articles)) {
            return $output;
        }
        //取得作者
        $authorIds = null;
        //取得分类
        $catIds = null;
        //取得标签
        $tagIds = null;
        foreach ($articles as $article) {
            $authorIds[] = $article->authors;
            $catIds[] = $article->cat_id;
            $tagIds[] = $article->tags;
        }
        $authorsName = Author::getAuthorById($authorIds);

        $catsName = Cat::getCatById($catIds);

        $tagsName = Tag::getTagById($tagIds);
        //取得文章
        foreach ($articles as $article) {
            $idx = 'id_' . $article->authors;
            $output[] = [
                'id' => $article->id,
                'authors' => array(
                    ['id' => $article->authors, 'name' => $authorsName] //offset:1问题尚未解决；
                ),
                'category' => array('c_id' => $article->cat_id, 'name' => $catsName[$article->cat_id]),
                'public' => $article->public,
                'star' => $article->star,
                'tags' => array(
                    ['id' => $article->tags, 'name' => $tagsName[$article->tags]]
                ),
                'created_date' => $article->created_at,
                'status' => $article->status,
                'description' => $article->description,
                'title' => $article->title
            ];
        }
        return $output;
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
