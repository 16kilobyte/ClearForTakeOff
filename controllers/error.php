<?php

class Error extends Controller
{

    public function __construct()
    {
        parent::__construct();//$this->view("404 Not Found - Clear to Take Off")->render("error/index");
    }

    public function _404()
    {
        $this->view("404 Not Found - Clear to Take Off")->render("error" . DS . "404");
    }

}
