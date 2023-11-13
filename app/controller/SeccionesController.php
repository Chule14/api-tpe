<?php
include_once 'app/model/SeccionesModel.php';
include_once 'app/response/ApiResponse.php';

class SeccionesController {
    private $model;
    private $view;
    private $data;

    public function __construct()
    {
        $this->model = new SeccionesModel();
        $this->view = new ApiResponse();
        $this->data = file_get_contents("php://input");
    }

    function getData(){ 
        return json_decode($this->data, true); 
    } 

    public function getSecciones(){
        if(!empty($_GET)){
            if(isset($_GET['sort']) && isset($_GET['order']) && $_GET['sort'] != "" && $_GET['order'] != "" && ($_GET['order'] == "ASC" || $_GET['order'] == "DESC")){
                $sort = $_GET['sort'];
                $order = $_GET['order'];

                return ($this->model->getSeccionesSorted($sort, $order)) ? $this->view->response($this->model->getSeccionesSorted($sort, $order), 200) : $this->view->response(array("error" => "No hay noticias que mostrar"), 404);
            }
            if(isset($_GET['filterBy']) && isset($_GET['filterValue']) && $_GET['filterBy'] != "" && $_GET['filterValue'] != ""){
                $filter = $_GET['filterBy'];
                $filterVal = $_GET['filterValue'];

                return $this->model->getSeccionesFilteredBy($filter, $filterVal) ? $this->view->response($this->model->getSeccionesFilteredBy($filter, $filterVal), 200) : $this->view->response(array("error" => "No hay noticias que mostrar"), 404);
            }
        }


        return ($this->model->getSecciones()) ? $this->view->response($this->model->getSecciones(), 200) : $this->view->response(array("error" => "No hay noticias que mostrar"), 404);
    }
    
    public function getSeccion($params = []){
        if(empty($params)) return $this->view->response(array("error" => "Envia un parametro"), 404);
        if(!isset($params[':ID'])) return $this->view->response(array("error" => "No ingresaste un ID correcto"), 404);
        
        $id = $params[':ID'];
        return ($this->model->getSeccion($id)) ? $this->view->response($this->model->getSeccion($id), 200) : $this->view->response(array("error" => "No se encontro un producto con este ID"), 404);
    }

    public function createSeccion(){
        $body = $this->getData();

        if(empty($body)) return $this->view->response(array("error" => "No enviaste contenido"), 404);

        if(!isset($body['tipo']) || $body['tipo'] == "") return $this->view->response(array("error" => "No completaste todos los campos"), 404);

        $query = $this->model->createSeccion($body['tipo']);

        return ($query) ? $this->view->response(array("success" => "Se creo la seccion con exito"), 200) : $this->view->response(array("error" => "No se pudo crear la seccion"), 404);
    }

    public function deleteSeccion($params = []){
        if(empty($params)) return $this->view->response(array("error" => "Envia un parametro"), 404);
        if(!isset($params[':ID'])) return $this->view->response(array("error" => "Envia un ID"), 404);

        $id = $params[':ID'];
        return ($this->model->deleteSeccion($id)) ? $this->view->response(array("success" => "Se elimino la noticia con exito"), 200) : $this->view->response(array("error" => "No se pudo eliminar la noticia"), 404);
    }

    
    public function updateSeccion($params = []){
        if(empty($params)) return $this->view->response(array("error" => "Envia un parametro"), 404);
        if(!isset($params[':ID'])) return $this->view->response(array("error" => "Envia un ID"), 404);

        $id = $params[':ID'];

        $body = $this->getData();
        if(empty($body)) return $this->view->response(array("error" => "No enviaste contenido"), 404);

        if(!isset($body['tipo']) || $body['tipo'] == "") return $this->view->response(array("error" => "No completaste todos los campos"), 404);

        return ($this->model->updateSeccion($id, $body['tipo'])) ? $this->view->response(array("success" => "Se actualizo la noticia con exito"), 200) : $this->view->response(array("error" => "No fue posible actualizar la noticia"), 404);
    }
}