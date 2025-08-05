<?php

namespace App\Core;

class View
{
    public static function render($template, $data = [], $layout = 'layouts/admin.php')
    {
        extract($data);
        ob_start();
        include __DIR__ . "/../../views/$template";
        $content = ob_get_clean();
        include __DIR__ . "/../../views/$layout";
    }
}
