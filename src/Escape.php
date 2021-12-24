<?php

namespace Atomstudio\Atomacore;

class Escape
{
    static public function UpperFolder($path)
    {
        return str_replace('..', '', $path);
    }
}
