<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $tableName = 'articles';

    /**
     * 取得所有文章
     */
    static public function getArticles(int $start = null, int $count = null, int $authorId, int $catId, int $tags, int $public, int $status, int $star)
    {
        $author = $authorId == 0 ? null : ['authors' => $authorId];
        $cat = $catId == 0 ? null : ['cat_id' => $catId];
        $tag = $tags == 0 ? null : ['tags' => $tags];
        $pub = $public == 0 ? null : ['public' => $public];
        $statu = $status == 0 ? null : ['status' =>  $status];
        $s = $star == 0 ? null : ['star' => $star];
        $articles = self::select(['id', 'cat_id', 'authors', 'title', 'tags', 'description', 'public', 'status', 'star', 'created_at'])
            ->where($author)
            ->where($cat)
            ->where($tag)
            ->where($pub)
            ->where($statu)
            ->where($s)
            ->orderby('id', 'DESC')
            // ->limit($start, $count)
            ->get();
        return $articles;
    }
    /**
     * 添加文章
     */
    static public function addArticle(string $title, string $author, string $description, string $createDate, string $cover = null, string $content, string $catId, string $tags, int $public, int $status, int $star)
    {
        $res = self::insert([
            'title' => $title,
            'cat_id' => $catId,
            'authors' => $author,
            'tags' => $tags,
            'description' => $description,
            'public' => $public,
            'status' => $status,
            'star' => $star,
            'created_at' => $createDate,
            'content' => $content,
            'cover' => $cover
        ]);
        if ($res === 0) {
            return 0;
        }
        $output = array(
            'success' => true,
            'message' => '新增成功'
        );
        return $output;
    }
    static public function setArticles(int $id, string $title, string $author, string $description, string $createDate = null, string $cover = null, string $content, string $catId, string $tags, int $public, int $status, int $star)
    {


        $article = self::find($id);
        $article->title = $title;
        $article->cat_id = $catId;
        $article->authors = $author;
        $article->tags = $tags;
        $article->description = $description;
        $article->public = $public;
        $article->status = $status;
        $article->star = $star;
        $article->created_at = $createDate;
        $article->cover = $cover;
        $article->content = $content;

        if ($article->save()) {
            return array(
                'success' => true,
                'message' => '编辑成功'
            );
        }
        return array(
            'success' => false,
            'message' => '编辑失败'
        );
    }

    /**
     * 取得文章内容
     */
    static public function getContent(int $articleId)
    {

        return self::select('content')
            ->where('id', $articleId)
            ->get();
    }


    /**
     * 设置精选
     */
    static public function setStar(int $id, int $star)
    {
        $article = self::find($id);
        $article->star = $star;
        if ($article->save()) {
            return array(
                'success' => true,
                'message' => '设置成功'
            );
        }
        return array(
            'success' => false,
            'message' => '设置失败'
        );
    }
    /**
     * 设置公开
     */
    static public function setPublic(int $id, int $public)
    {
        $article = self::find($id);
        $article->star = $public;
        if ($article->save()) {
            return array(
                'success' => true,
                'message' => '设置成功'
            );
        }
        return array(
            'success' => false,
            'message' => '设置失败'
        );
    }
    /**
     * 设置状态
     */
    static public function setStatus(int $id, int $status)
    {
        $article = self::find($id);
        $article->status = $status;
        if ($article->save()) {
            return $output = array(
                'success' => true,
                'message' => '设置成功'
            );
        }
        return array(
            'success' => false,
            'message' => '设置失败'
        );
    }
    /**
     * 删除文章
     */
    static public function delArticle(int $id)
    {
        $article = self::destroy($id);
        if ($article) {
            return array(
                'success' => true,
                'message' => '删除成功'
            );
        }
        return array(
            'success' => false,
            'message' => '删除失败'
        );
    }
}
