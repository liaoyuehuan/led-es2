<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-15
 * Time: 15:31
 */

namespace App\Utils;


class FileUtils
{
    static public function get_dir_files($scam_path, $pattern = null)
    {
        $dir_files = [];
        $files = scandir($scam_path);
        $files = array_diff($files, ['.', '..']);
        foreach ($files as $file) {
            $file_path = ltrim(rtrim($scam_path, '/') . '/' . $file, '(./)');
            if (is_dir($file_path)) {
                $dir_files = array_merge($dir_files, get_dir_files($file_path));
            } else {
                $dir_files[] = $file_path;
            }
        }
        if ($pattern !== null) {
            $dir_files = preg_grep($pattern, $dir_files);
        }
        return $dir_files;
    }
}