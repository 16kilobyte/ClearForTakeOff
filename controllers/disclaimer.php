<?php

/**
 *
 */
class Disclaimer extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view("Disclaimer - Blue Skies", "")->render("disclaimer" . DS . "index");
    }
}
