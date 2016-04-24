<?php

class Index
{
    public function index()
    {
        header("Location: ".ROOT_URL."home/", 301);
    }

}
