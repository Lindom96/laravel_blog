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
            // ->where(function ($q) {  //闭包返回的条件会包含在括号中
            //     return $q->Where([]);
            // })
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
     * 取得文章内容
     */
    static public function getContent(int $articleId)
    {

        return self::select('content')
            ->where('id', $articleId)
            ->get();
    }
}
