<?php

namespace App\Http\Controllers\Comment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Model\Comment;

class CommentController extends Model
{
    /**
     * 取得所有評論
     *
     * @return Response
     * @author Lindom
     */
    public function getComms(Request $request)
    {
        $start = $request->start ?? 0;
        $count = $request->count ?? 15;
        $query = $request->query;
        $comms = Comment::getComms($start, $count, $query);
        $output = null;
        if (!isset($comms)) {
            foreach ($comms as $comm) {
                $output[] = [
                    'id' => $comm->id,
                    'nickname' => $comm->nickname,
                    'replyname' => $comm->replyname,
                    'like' => $comm->like,
                    'website' => $comm->website,
                    'content ' => $comm->content
                ];
            }
            return json_decode($output);
        }
    }

    /**
     * 新增評論
     *
     * @return Response
     * @author Lindom
     */
    public function addComm(Request $request)
    {
        // $articleId = $request->article_id;
        $nickname = $request->nickname;
        $replyname = $request->replyname;
        $content = $request->content;
        $website = $request->website;
        $createDate = $request->create_date;
        $res = Comment::addComm($nickname, $replyname, $content, $createDate);
        if (isset($res)) {
            return json_decode($res);
        }
    }

    /**
     * 刪除評論
     *
     * @return Response
     * @author Lindom
     */
    public function delComms(Request $request)
    {
        $commIds = $request->comm_ids;
        $res = Comment::delCats($commIds);
        if (isset($res)) {
            return json_decode($res);
        }
    }
}

