<?php

namespace Atomstudio\Atomacore;

use Exception;

class Locale
{
    private $locale, $localeFile;

    /**
     * 检查语言对应的翻译文件是否存在
     *
     * @param String $localeFile
     * @param String $locale
     * @return void
     */
    static public function checkLocaleFile($localeFile, $locale)
    {
        return is_file($_ENV['BASE_PATH'] . '/' . $_ENV['Locale']['Path'] . '/' . $locale . '/' . $localeFile . '.php');
    }

    /**
     * 实例化 Locale 对象
     *
     * @param String $localeFile
     * @param String $locale
     * @param String $defaultLocale
     */
    public function __construct($localeFile, $locale = NULL, $defaultLocale = NULL)
    {
        $localeFile = str_replace('.php', '', $localeFile);
        $this->localeFile = $localeFile;
        if (!isset($defaultLocale)) $defaultLocale = $_ENV['Locale']['Default'];
        if (isset($locale)) {
            if (self::checkLocaleFile($localeFile, $locale)) {
                $this->locale = $locale;
                return $this->locale;
            }
        } elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            if (self::checkLocaleFile($localeFile, $_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                $this->locale = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
                return $this->locale;
            }
        } else {
            $this->locale = $defaultLocale;
        }
        if (self::checkLocaleFile($localeFile, $defaultLocale)) {
            $this->locale = $defaultLocale;
            return $this->locale;
        } else {
            throw new Exception('Unknown default locale file ' . $_ENV['BASE_PATH'] . '/' . $_ENV['Locale']['Path'] . '/' . $locale . '/' . $localeFile . '.php' . '.');
        }
    }

    /**
     * 加载语言对应的翻译文件
     *
     * @return void
     */
    public function loadLocaleFile()
    {
        $this->localeList = require $_ENV['BASE_PATH'] . '/' . Escape::UpperFolder($_ENV['Locale']['Path']) . '/' . $this->locale . '/' . $this->localeFile . '.php';
    }

    /**
     * 通过属性方式获取翻译文件中对应的条目
     *
     * @param String $key
     * @return String
     */
    public function __get($key)
    {
        if (!isset($this->localeList)) $this->loadLocaleFile();
        return $this->localeList[$key];
    }
}
