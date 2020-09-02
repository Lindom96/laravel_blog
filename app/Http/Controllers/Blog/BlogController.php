<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Blog;

class BlogController extends Controller
{
    /**
     * 取得所有友链
     *
     * @return Response
     * @author Lindom
     */
    public function getFriends(Request $request)
    {
        $start = $request->start ?? 0;
        $count = $request->count ?? 15;
        $name = $request->name;
        $avatar = $request->avatar;
        // $query = $request->query;
        $friends = Blog::getFriends();
        $output = null;
        if (empty($friends)) {
            return array();
        }
        foreach ($friends as $friend) {
            $output[] = [
                'id' => $friend->b_id,
                'name' => $friend->name,
                'avatar' => $friend->avatar,
                'link' => $friend->link
            ];
        }
        return $output;
    }

    /**
     * 新增友链
     *
     * @return Response
     * @author Lindom
     */
    public function addFriend(Request $request)
    {
        $name = $request->name;
        $link = $request->link;
        $avatar = $request->avatar ?? 'www.google.cn/landing/cnexp/google-search.png';
        // $createDate = $request->create_date;
        $res = Blog::addFriend($name, $link, $avatar);
        if (isset($res)) {
            return $res;
        }
        return null;
    }
    /**
     * 更新友链
     *
     * @return Response
     * @author Lindom
     */
    public function setFriend(Request $request)
    {
        $bid = $request->id;
        $name = $request->name;
        $avatar = $request->avatar ?? '//www.google.cn/landing/cnexp/google-search.png';
        $link = $request->link;
        $res = Blog::updateFriend($bid, $name, $link, $avatar);
        return $res;
    }

    /**
     * 刪除友链
     *
     * @return Response
     * @author Lindom
     */
    public function delFriend(Request $request)
    {
        $bid = $request->id;
        $res = Blog::deleteFriend($bid);
        return $res;
    }
}
