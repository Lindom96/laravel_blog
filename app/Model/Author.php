<?php

namespace App\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;

// class Author extends Model implements JWTSubject
class Author extends Model
{

    use Notifiable;
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $tablename = 'authors';


    private $user = [];
    /**
     * 验证用户
     */
    static public function checkUser(String $name)
    {
        $res = self::select('id', 'avatar')
            ->where('name', $name)
            ->get();
        return $res[0];
    }
    /**
     * 注册账号
     *
     * @param  array  $data
     * @return Illuminate\Support\Facades\DB
     */
    static public function register(array $data)
    {
        $result = self::insert([
            'name' => $data['username'],
            'password' => $data['password']
        ]);
        return $result;
    }
    /**
     * 添加作者
     */
    static public function addAuthors(string $name, string $password, string $email, string $avatar = null, string $description, int $auth)
    {
        $res = self::insert([
            'name' => $name,
            'password' => $password,
            'email' => $email,
            'avatar' => $avatar,
            'description' => $description,
            'auth' => $auth
        ]);
        if ($res === 0) {
            return 0;
        }
        $output = array(
            'success' => true,
            'message' => '新增成功'
        );
        return $output;
    }

    /**
     * 取得所有作者（除管理员）
     */
    static public function getAuthors(int $id = null)
    {
        if (isset($id)) {
            $where = array('auth' => '8', 'id' => $id);
        } else {
            $where = array('auth' => '8');
        }
        $authors = self::select('id', 'name', 'password', 'email', 'avatar', 'description')
            ->where($where)
            ->get();
        return $authors;
    }
    /**
     * 根据ID取得作者
     */
    static public function getAuthorById($id)
    {
        if (isset($id)) {
            $authors = self::select('id', 'name')
                ->where('auth', '8')
                ->whereIn('id', $id)
                ->orderby('id', 'DESC')
                ->get();
        } else {
            $authors = self::select('id', 'name')
                ->where('auth', '8')
                ->orderby('id', 'DESC')
                ->get();
        }
        $names = null;
        foreach ($authors as $author) {
            $names[$author->id] = $author->name;
        }
        return $names;
    }

    /**
     * 编辑作者
     */
    static public function updateAuthor(int $id, string $email, string $description, int $auth)
    {
        $author = self::find($id);
        $author->email = $email;
        $author->description = $description;
        $author->auth = $auth;
        if ($author->save()) {
            return $output = array(
                'success' => true,
                'message' => '编辑成功'
            );
        }
        return array(
            'success' => false,
            'message' => '编辑失败'
        );
    }

    /**
     * 删除作者
     */
    static public function deleteAuthor(int $id)
    {
        $author = self::destroy($id);
        if ($author) {
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
    /**
     * 修改密码
     */
    static public function updatePassword(int $id, string $password)
    {
        $author = self::find($id);
        $oldPassword = $author->password;
        if ($password === $oldPassword) {
            return array(
                'success' => false,
                'message' => '新密码不能与旧密码一致！'
            );
        }
        $author->password = $password;
        if ($author->save()) {
            return $output = array(
                'success' => true,
                'message' => '修改成功'
            );
        }
        return array(
            'success' => false,
            'message' => '修改失败'
        );
    }
}
