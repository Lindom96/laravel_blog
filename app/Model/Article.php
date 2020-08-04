<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $tableName = 'articles';

    /**
     * 取得所有文章
     */
    static public function getArticles(int $start = null, int $count = null, int $authorId, string $catId = null, int $tags = null, int $public = null, int $status = null, int $star = null)
    {
        $where1 = [
            ['AND', 'cat_id', '=', $catId, 0],
            // ['AND', 'title', 'REGEXP', $query, 0],
            ['AND', 'tags', '=', $tags, 0],
            ['AND', 'public', '=', $public, 0],
            ['AND', 'status', '=', $status, 0],
            ['AND', 'star', '=', $star, 0]
        ];
        $where = [
            ['cat_id', $catId, 0],
            ['tags', $tags, 0],
            ['public', $public, 0],
            ['status',  $status, 0],
            ['star',  $star, 0]
        ];
        return self::select(['id', 'cat_id', 'authors', 'title', 'tags', 'description', 'public', 'status', 'star','created_at'])
            // ->where(function ($q) {  //闭包返回的条件会包含在括号中
            //     return $q->Where([]);
            // })
            // ->where($where)
            ->orderby('id', 'DESC')
            // ->limit($start, $count)
            ->get();
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
