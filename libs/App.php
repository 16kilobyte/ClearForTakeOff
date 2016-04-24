<?php
//require("")
class App {

    public function __construct()
    {
        $url = isset($_GET["url"])?rtrim($_GET["url"], "/"):null;
        if(is_null($url))
        {
            require_once "controllers" . DS . "index.php";
            $controller = new Index();
            $controller->index();
            return false;
        }
        $url = explode("/", $url);
        //print_r($url);

        $file = "controllers" . DS . "{$url[0]}.php";
        if(file_exists($file)) {
            require($file);
            if(class_exists($url[0]))
            {
                $controller = new $url[0];
                $controller->loadModel($url[0]);

                if(!isset($url[1]))
                {
                    if(method_exists($controller, 'index'))
                    {
                        $controller->index();
                    } else {
                        $this->error()->_404();
                    }
                } else {
                    if(method_exists($controller, $url[1]))
                    {
                        $controller->{$url[1]}();
                    } else {
                        $this->error()->_404();
                    }
                }
            } else {
                $this->error()->_404();
            }
        } else {
            $this->error()->_404();
        }
    }

    public function error()
    {
        require("controllers" . DS . "error.php");
        return $error = new Error();
        return $this;
    }

}
