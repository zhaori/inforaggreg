<?php

namespace app\user\controller;

use app\user\model\ClassifyModel;
use app\user\model\SearchEngineModel;
use think\Controller;
use think\Exception;

class UserController extends Controller{
    public function index(){
        $data = ClassifyModel::column("class_name");
        $search_data = SearchEngineModel::all();
        return $this->fetch("user/index",[
            "title"             => "知了网-比你更懂你-属于软件开发者的搜索聚合导航网站",
            "navbar_data"       => $data,
            "search_data"       => $search_data
        ]);
    }

    public function search(){
        $search_name = $this->request->param("search_name");
        $search_text = $this->request->get("search_value");
        try {
            $search_api = SearchEngineModel::where("search_name", $search_name)->value("search_api");
            return $search_api.$search_text;
        }catch (Exception $e){
            $this->error($e, "/user/user");
        }
    }

    public function test(){
        foreach (SearchEngineModel::all() as $key=>$value){
            print_r($value["search_name"]);
        }
    }
}