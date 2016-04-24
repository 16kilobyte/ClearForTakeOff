<?php

class View
{

    public static $Title;

    public function __construct($title, $current_page)
    {
        self::$Title = $title;
        F::$CURRENT_PAGE = $current_page;
    }

    public function render($page, $include = true)
    {
        if($include)
        {
            require_once "views" . DS . "header.html";
            require_once "views" . DS . "{$page}.html";
            require_once "views" . DS . "footer.html";
        } else {
            require_once "views" . DS . "{$page}.html";
        }
    }
}
