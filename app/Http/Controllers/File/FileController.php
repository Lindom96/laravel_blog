<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\File;

class FileController extends Controller
{

    public function __construct()
    {
    }
    /**
     * 添加图片
     */
    public function addFiles(Request $request)
    {
        $var = 'file';
        // $files = $request->file('file');
        if (!isset($_FILES[$var])) {
            return $output = array(
                'success' => false,
                'message' => '上传失败'
            );
        }
        $this->_checkDir('upload/');
        $file = $this->_getFile($var);
        $fileUrl = '';
        // $fileExt = $this->_getFileExts($_FILES[$var]['name']);
        if (file_exists("upload/" . $file["name"])) {
            $fileUrl = "upload/" . $file["name"];
        } else {
            move_uploaded_file(
                $file["tmp_name"],
                "upload/" . $file["name"]
            );
            $fileUrl = "upload/" . $file["name"];
        }

        // $name = $request->name;
        // $type = $request->type;
        // $size = $request->size;
        // $fileData = $request->file_data;
        $fileId = File::addFiles($file["name"], $file["type"], $file["size"], $fileUrl);
        if (!isset($fileId)) {
            return $output = array(
                'success' => false,
                'type' => 'database',
                'message' => '上传失败'
            );
        }
        return $output = array($fileUrl);
    }
    /**
     * 檢查目錄是否存在，不存在就建立
     * @param string $dirName 路徑
     * @param int $rights 權限
     */
    private function _checkDir(string $dirName, $rights = 0777)
    {
        $dirs = explode('/', $dirName);
        $dir = '';
        foreach ($dirs as $part) {
            $dir .= $part . '/';
            if (!is_dir($dir) && strlen($dir) > 0) {
                mkdir($dir, $rights);
            }
        }
    }
    /**
     * gat ext of files
     * @param array $fileNames file names
     * @return array
     */
    private function _getFileExts(string $fileNames): array
    {
        $exts = [];
        // foreach ($fileNames as $name) {
        //     $exts[] = pathinfo($name, PATHINFO_EXTENSION);
        // }
        $exts[] = pathinfo($fileNames, PATHINFO_EXTENSION);
        return array_unique($exts);
    }

    /**
     * 取得上傳的檔案，將原本用陣列的方式改成類物件的方式
     * @param string $var 檔案上傳時的參數名稱
     * @return array 檔案資料
     */
    private function _getFile(string $var): array
    {
        return [
            'name' => $_FILES[$var]['name'],
            'tmp_name' => $_FILES[$var]['tmp_name'],
            'type' => $_FILES[$var]['type'],
            'size' => $_FILES[$var]['size'],
            'error' => $_FILES[$var]['error'],
        ];
    }
}
