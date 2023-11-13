<?php
include_once 'app/model/NoticiasModel.php';
include_once 'app/response/ApiResponse.php';
include_once 'app/filemanager/File.php';

class NoticiasController {
    private $model;
    private $view;
    private $data;
    private $filemanager;

    public function __construct()
    {
        $this->model = new NoticiasModel();
        $this->view = new ApiResponse();
        $this->filemanager = new Filemanager();
        $this->data = file_get_contents("php://input");
    }

    function getData(){ 
        return json_decode($this->data, true); 
    } 

    public function getNoticias(){
        if(!empty($_GET)){
            if(isset($_GET['sort']) && isset($_GET['order'])  && $_GET['sort'] != "" && $_GET['order'] != "" && ($_GET['order'] == "ASC" || $_GET['order'] == "DESC")){
                $sort = $_GET['sort'];
                $order = $_GET['order'];

                return ($this->model->getNoticiasSorted($sort, $order)) ? $this->view->response($this->model->getNoticiasSorted($sort, $order), 200) : $this->view->response(array("error" => "No hay noticias que mostrar"), 404);
            }
            if(isset($_GET['filterBy']) && isset($_GET['filterValue']) && $_GET['filterBy'] != "" && $_GET['filterValue'] != ""){
                $filter = $_GET['filterBy'];
                $filterVal = $_GET['filterValue'];

                return $this->model->getNoticiasFilteredBy($filter, $filterVal) ? $this->view->response($this->model->getNoticiasFilteredBy($filter, $filterVal), 200) : $this->view->response(array("error" => "No hay noticias que mostrar"), 404);
            }
            if(isset($_GET['titleContains']) && $_GET['titleContains'] != ""){
                $contain = $_GET['titleContains'];
                return $this->model->getNoticiasTitleContains($contain) ? $this->view->response($this->model->getNoticiasTitleContains($contain), 200) : $this->view->response(array("error" => "No hay noticias que mostrar"), 404);
            }
        }


        return ($this->model->getNoticias()) ? $this->view->response($this->model->getNoticias(), 200) : $this->view->response(array("error" => "No hay noticias que mostrar"), 404);
    }
    
    public function getNoticia($params = []){
        if(empty($params)) return $this->view->response(array("error" => "Envia un parametro"), 404);
        if(!isset($params[':ID'])) return $this->view->response(array("error" => "No ingresaste un ID correcto"), 404);
        
        $id = $params[':ID'];
        return ($this->model->getNoticia($id)) ? $this->view->response($this->model->getNoticia($id), 200) : $this->view->response(array("error" => "No se encontro un producto con este ID"), 404);
    }

    public function createNoticia(){
        $body = $_POST;

        if(empty($body)) return $this->view->response(array("error" => "No enviaste contenido"), 404);

        if(!isset($body['titulo']) || !isset($body['subtitulo']) || !isset($body['descripcion']) || !isset($body['id_seccion']) || !isset($_FILES['imagen'])) return $this->view->response(array("error" => "No completaste todos los campos"), 404);

        $imagen = $this->filemanager->saveImage($_FILES['imagen']);

        $query = $this->model->createNoticia($body['titulo'], $body['subtitulo'], $body['descripcion'], $body['id_seccion'], $imagen);

        return ($query) ? $this->view->response(array("success" => "Se creo la noticia con exito"), 200) : $this->view->response(array("error" => "No se pudo crear la noticia"), 404);
    }

    public function deleteNoticia($params = []){
        if(empty($params)) return $this->view->response(array("error" => "Envia un parametro"), 404);
        if(!isset($params[':ID'])) return $this->view->response(array("error" => "Envia un ID"), 404);

        $id = $params[':ID'];
        return ($this->model->deleteNoticia($id)) ? $this->view->response(array("success" => "Se elimino la noticia con exito"), 200) : $this->view->response(array("error" => "No se pudo eliminar la noticia"), 404);
    }

    
    public function updateNoticia($params = []){
        if(empty($params)) return $this->view->response(array("error" => "Envia un parametro"), 404);
        if(!isset($params[':ID'])) return $this->view->response(array("error" => "Envia un ID"), 404);

        $id = $params[':ID'];

        $body = $this->getData();
        if(empty($body)) return $this->view->response(array("error" => "No enviaste contenido"), 404);

        if(!isset($body['titulo']) || !isset($body['subtitulo']) || !isset($body['descripcion']) || !isset($body['id_seccion'])) return $this->view->response(array("error" => "No completaste todos los campos"), 404);

        return ($this->model->updateNoticia($id, $body['titulo'], $body['subtitulo'], $body['descripcion'], $body['id_seccion'])) ? $this->view->response(array("success" => "Se actualizo la noticia con exito"), 200) : $this->view->response(array("error" => "No fue posible actualizar la noticia"), 404);
    }

}