<?php

namespace App\Http\Controllers\Tag;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Model\Tag;

class TagController extends Model
{
  /**
   * 取得所有tag
   *
   * @return Response
   * @author Lindom
   */
  public function getTags(Request $request)
  {
    $start = $request->start ?? 0;
    $count = $request->count ?? 15;
    $name = $request->name;
    $query = $request->query;
    $tags = Tag::getTags();
    $output = null;
    if (isset($tags)) {
      foreach ($tags as $tag) {
        $output[] = [
          'id' => $tag->t_id,
          'name' => $tag->name
        ];
      }
      return $output;
    }
    return null;
  }

  /**
   * 新增tag
   *
   * @return Response
   * @author Lindom
   */
  public function addTag(Request $request)
  {
    $name = $request->name;
    $createDate = $request->create_date;
    $res = Tag::addTag($name);
    if (isset($res)) {
      return $res;
    }
  }

  /**
   * 修改tag
   *
   * @return Response
   * @author Lindom
   */
  public function setTag(Request $request)
  {
    $tagId = $request->id;
    $name = $request->name;
    $res = Tag::updateTag($tagId, $name);
    if (isset($res)) {
      return $res;
    }
  }

  /**
   * 刪除tag
   *
   * @return Response
   * @author Lindom
   */
  public function delTag(Request $request)
  {
    $tagIds = $request->id;
    $res = Tag::deleteTag($tagIds);
    if (isset($res)) {
      return $res;
    }
  }
}
