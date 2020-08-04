<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'files';
    /**
     * 重定义主键
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * 新增文档
     */
    static public function addFiles(string $name, string $type, int $size, string $fileUrl)
    {
        $files = self::insert([
            'name' => $name,
            'type' => $type,
            'size' => $size,
            'file_url' => $fileUrl
        ]);
        if ($files === 0) {
            return $output[] = array(
                'success' => false,
                'message' => '新增失败'
            );
        }
        // $fileId = self::lastInsertId();
        return $files;
    }
}
