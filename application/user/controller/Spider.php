<?php

namespace app\user\controller;

use Snoopy;

include ('Snoopy.php');
class Spider
{
    private $url;
    private $headerArray;
    public function __construct($url)
    {
        $this->url = $url;
        $this->headerArray = array("Content-type:application/json;","Accept:application/json");
    }

    public function getUrl(){
        return file_get_contents($this->url);
    }

    function getsnoopy()
    {
        $snoopy = new Snoopy();
        $snoopy->fetch($this->url);
        $html_source = $snoopy->results;
        return $html_source;
    }

}

$spider_data = new Spider("https://www.baidu.com/s?wd=123");
print_r($spider_data->getsnoopy());