<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cat extends Model
{


    protected $tableName = 'cats';
    protected $primaryKey = 'c_id';

    /**
     * 取得所有分类 $start, $count, $name, $cover, $query
     * int $start = null, int $count = null, string $name = null, string $cover = null, string $query
     */
    static public function getCats()
    {
        return self::select('c_id', 'name', 'cover', 'description')
            // ->limit($start, $count)
            ->get();
    }


    /**
     * 根据ID取得作者
     */
    static public function getCatById($id)
    {
        if (isset($id)) {
            $where = array('c_id' => $id);
        } else {
            $where = null;
        }
        $cats = self::select('c_id', 'name')
            ->where($where)
            ->orderby('c_id', 'DESC')
            ->get();
        $names = null;
        foreach ($cats as $cat) {
            $names[$cat->c_id] = $cat->name;
        }
        return $names;
    }

    /**
     * 新增分类 
     */
    static public function addCat(string $name, string $description, string $cover)
    {
        $cat =  new Cat();
        $cat->name = $name;
        $cat->description = $description;
        $cat->cover = $cover;
        if ($cat->save()) {
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
     * 更新分类 
     */
    static public function updateCat(int $c_id, string $name, string $description, string $cover)
    {
        $where = [
            // ['AND', 'name', '=', $name, 0],
            // ['AND', 'title', 'REGEXP', $query, 0],
            // ['AND', 'cover', '=', $cover, 0]
        ];
        $cat = self::find($c_id);
        $cat->name = $name;
        $cat->description = $description;
        $cat->cover = $cover;
        if ($cat->save()) {
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
     * 删除分类
     */
    static public function deleteCat(int $id)
    {
        $cat = self::destroy($id);
        if ($cat) {
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
