<?php

namespace App\Http\Controllers\Cat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Model\Cat;

class CatController extends Model
{

    /**
     * 取得所有分類
     *
     * @return Response
     * @author Lindom
     */
    public function getCats(Request $request)
    {
        $start = $request->start ?? 0;
        $count = $request->count ?? 15;
        $name = $request->name;
        $cover = $request->cover;
        // $query = $request->query;
        $cats = Cat::getCats();
        $output = null;
        if (isset($cats)) {
            foreach ($cats as $cat) {
                $output[] = [
                    'id' => $cat->c_id,
                    'name' => $cat->name,
                    'cover' => $cat->cover,
                    'description' => $cat->description
                ];
            }
            return $output;
        }
        return $output = array();
    }

    /**
     * 新增分類
     *
     * @return Response
     * @author Lindom
     */
    public function addCat(Request $request)
    {
        $name = $request->name;
        $cover = $request->cover ?? '//www.google.cn/landing/cnexp/google-search.png';
        $description = $request->description;
        // $createDate = $request->create_date;
        $res = Cat::addCat($name, $description, $cover);
        if (isset($res)) {
            return $res;
        }
        return null;
    }

    /**
     * 修改分類
     *
     * @return Response
     * @author Lindom
     */
    public function setCat(Request $request)
    {
        $cid = $request->id;
        $name = $request->name;
        $cover = $request->cover ?? '//www.google.cn/landing/cnexp/google-search.png';
        $description = $request->description;
        $res = Cat::updateCat($cid, $name, $description, $cover);
        return $res;
    }

    /**
     * 刪除分類
     *
     * @return Response
     * @author Lindom
     */
    public function delCat(Request $request)
    {
        $cid = $request->id;
        $res = Cat::deleteCat($cid);
        return $res;
    }
}
