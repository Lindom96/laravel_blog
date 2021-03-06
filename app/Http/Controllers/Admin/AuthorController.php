<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Author;

class AuthorController extends Controller
{
    /**
     * 取得所有作者（除管理员）
     */
    public function getAuthors(Request $request)
    {
        $id = $request->id;
        $authors = Author::getAuthors($id);
        
        // var_dump($authors);
        foreach ($authors as $author) {
            $output[] = array(
                'id' => $author->id,
                'name' => $author->name,
                'email' => $author->email,
                'avatar' => $author->avatar,
                'description' => $author->description
            );
        }
        return json_encode($output);
    }

    /**
     * 添加作者
     */
    public function addAuthor(Request $request)
    {

        $name = $request->name;
        $password = $request->password;
        $email = $request->email;
        $avatar = $request->avatar ?? '111';
        $description = $request->description;
        $auth = $request->auth;
        $authors = Author::addAuthors($name, $password, $email, $avatar, $description, $auth);
        return $authors;
    }

    /**
     * 修改作者
     *
     * @return Response
     * @author Lindom
     */
    public function setAuthor(Request $request)
    {
        $id = $request->id;
        $email = $request->email;
        $description = $request->description;
        $auth = $request->auth;
        $res = Author::updateAuthor($id, $email, $description, $auth);
        return $res;
    }

    /**
     * 修改头像
     *
     * @return Response
     * @author Lindom
     */
    public function setAvatar(Request $request)
    {

        return array(
            'success' => true
        );
    }
    /**
     * 删除作者
     *
     * @return Response
     * @author Lindom
     */
    public function deleteAuthor(Request $request)
    {
        $id = $request->id;
        $res = Author::deleteAuthor($id);
        return $res;
    }
    /**
     * 修改密码
     *
     * @return Response
     * @author Lindom
     */
    public function updatePassword(Request $request)
    {
        $id = $request->id;
        $newPassword = $request->password;
        $res = Author::updatePassword($id, $newPassword);
        return $res;
    }
}
