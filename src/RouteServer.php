<?php

namespace Atomstudio\Atomacore;

class RouteServer
{
    public $setting = [
        'RootIndexFilename' => 'index.php',
        'indexFilename' => 'index.php',
        'urlSuffix' => '.php',
        'removeSlashSuffix' => false
    ];

    public function __construct($routeDir = 'routes', $reqPath = NULL)
    {
        if (!isset($reqPath)) $reqPath = Escape::UpperFolder($_SERVER['REDIRECT_URL']);
        $this->routeDir = $routeDir;
        $this->reqPath = $reqPath;
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

    public function respond()
    {
        if ($this->setting['removeSlashSuffix']) {
            $this->reqPath = rtrim($this->reqPath, '/');
        }

        if ($this->reqPath) {
            $suffix = substr($this->reqPath, -1, 1);
            if ($suffix == '/') {
                // 访问目录首页
                $this->fullPath = $_ENV['BASE_PATH'] . '/' . $this->routeDir . $this->reqPath . $this->setting['indexFilename'];
            } else {
                // 访问指定路径
                $this->fullPath = $_ENV['BASE_PATH'] . '/' . $this->routeDir . $this->reqPath . $this->setting['urlSuffix'];
            }
        } else {
            // 访问根目录首页
            $this->fullPath = $_ENV['BASE_PATH'] . '/' . $this->routeDir . $this->reqPath . '/' . $this->setting['RootIndexFilename'];
        }

        try {
            include $this->fullPath;
        } catch (\Throwable $th) {
            echo '404';
        }
    }
}
