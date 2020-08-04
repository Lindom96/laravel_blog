<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $tableName = 'tags';
    protected $primaryKey = 't_id';
    /**
     * 取得所有标签 $start, $count, $name, $avatar, $query
     */
    static public function getTags()
    {
        // int $start = null, int $count = null

        return self::select(['t_id', 'name'])
            ->orderby('t_id', 'DESC')
            ->get();
    }
    /**
     * 新增标签
     */
    static public function addTag(string $name)
    {
        $tag =  new Tag();
        $tag->name = $name;
        if ($tag->save()) {
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
     * 更新标签
     */
    static public function updateTag(int $t_id, string $name)
    {
        $tag = self::find($t_id);
        $tag->name = $name;
        if ($tag->save()) {
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
}
