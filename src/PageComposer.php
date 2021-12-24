<?php

namespace Atomstudio\Atomacore;

use Exception;

class PageComposer
{
    public $template, $setting = [
        'cacheFolder' => 'cache'
    ], $var = [];

    /**
     * 实例化页面构建者对象
     *
     * @param String $template 模板路径 若为相对路径则需设置 relativePath
     */
    public function __construct($template = NULL)
    {
        $this->template = $template;
    }

    /**
     * 设置参数
     *
     * @param String $key 参数名
     * @param Mixed $value 参数值
     * @return void
     */
    public function set($key, $value = NULL)
    {
        if (is_array($key)) {
            foreach ($key as $row) {
                $this->setting[$row[0]] = $row[1];
            }
        } else {
            if (!isset($value)) return false;
            $this->setting[$key] = $value;
        }
    }

    /**
     * 设置变量
     *
     * @param String $key
     * @param Mixed $value
     * @return Void|Mixed
     */
    public function var($key, $value = NULL)
    {
        if ($value) {
            $this->var[$key] = $value;
        } else {
            return $this->var[$key];
        }
    }

    /**
     * 通过属性设置变量
     *
     * @param String $key
     * @return Mixed
     */
    public function __set($key, $value)
    {
        $this->var[$key] = $value;
    }

    /**
     * 通过属性获取变量
     *
     * @param String $key
     * @return Mixed
     */
    public function __get($key)
    {
        return $this->var[$key];
    }

    /**
     * 从路径引入页面
     *
     * @param String $path 页面路径 若为相对路径则需设置 relativePath
     * @return String
     */
    public function import($path)
    {
        if (strpos($path, DIRECTORY_SEPARATOR) !== 0) {
            if (isset($_ENV['BASE_PATH'])) {
                $path = $_ENV['BASE_PATH'] . '/' . $path;
            } else {
                throw new Exception('Unknown base path.');
            }
        }
        try {
            include $path;
        } catch (\Throwable $th) {
            return false;
        }
        return $path;
    }

    /**
     * 构造最终页面
     *
     * @return void
     */
    public function construct()
    {
        if ($this->template) $this->import($this->template);
    }
}
