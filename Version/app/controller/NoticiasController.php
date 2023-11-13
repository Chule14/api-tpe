<?php
include_once 'app/model/NoticiasModel.php';

class NoticiasController {
    private $model;

    public function __construct()
    {
        $this->model = new NoticiasModel();
    }

    public function getNoticias(){
        return ($this->model->getNoticias()) ? printf(json_encode($this->model->getNoticias())) : false;
    }
    
    public function getNoticia(){
        $res = $_GET['resource'];
        $id = explode('/', $res);

        return ($this->model->getNoticia($id[1])) ? printf(json_encode($this->model->getNoticia($id[1]))) : printf(json_encode($text));
    }


}