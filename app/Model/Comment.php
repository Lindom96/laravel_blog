<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{


    /**
     * 取得所有评论 $start, $count, $name, $avatar, $query
     */
    static public function getComments(int $start = null, int $count = null, string $query = null)
    {
        $where = [
            ['AND', 'nickname', 'REGEXP', $query, 0]
        ];
        return self::select(['id', 'nickname', 'content', 'replyname', 'like', 'website'])
            // ->where($where)
            ->orderby('id', 'DESC')
            ->limit($start, $count)
            ->get();
    }
}
