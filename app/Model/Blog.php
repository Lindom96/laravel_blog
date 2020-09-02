<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $tableName = 'blogs';
    protected $primaryKey = 'b_id';
    /**
     * 取得所有友链
     */
    static public function getFriends()
    {
        return self::select('b_id', 'name', 'link', 'avatar')
            ->get();
    }

    /**
     * 新增友链
     */
    static public function addFriend($name, $link, $avatar)
    {
        $blg =  new Blog();
        $blg->name = $name;
        $blg->link = $link;
        $blg->avatar = $avatar;
        if ($blg->save()) {
            return $output = array(
                'success' => true,
                'message' => '新增成功'
            );
        }
        return $output = array(
            'success' => false,
            'message' => '新增失败'
        );
    }


    /**
     * 更新友链
     */
    static public function updateFriend(int $b_id, string $name, string $link, string $avatar)
    {
        $blg = self::find($b_id);
        $blg->name = $name;
        $blg->link = $link;
        $blg->avatar = $avatar;
        if ($blg->save()) {
            return $output = array(
                'success' => true,
                'message' => '编辑成功'
            );
        }
        return $output = array(
            'success' => false,
            'message' => '编辑失败'
        );
    }

    /**
     * 删除友链
     */
    static public function deleteFriend(int $b_id)
    {
        $blg = self::destroy($b_id);
        if ($blg) {
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
