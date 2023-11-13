<?php 

// La clase modelo se comunica con la BD y realiza las consultas
class SeccionesModel {
    private $PDO;

    public function __construct () { 
        include_once 'app/database/db.php';
        $conex = new Database(); // Instacia de la clase DB
        $this->PDO = $conex->conexion(); // Metodo conexion.
    } // El constructor crea la conexion a la BD y la guarda en el PDO

    public function getSecciones(){
        $statement = $this->PDO->prepare('SELECT * FROM secciones');

        return ($statement->execute()) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
    
    public function getSeccion($id){
        $statement = $this->PDO->prepare('SELECT * FROM secciones WHERE id = ?');

        return ($statement->execute([$id])) ? $statement->fetch(PDO::FETCH_ASSOC) : false;
    }
    
    public function createSeccion($tipo){
        $statement = $this->PDO->prepare('INSERT INTO secciones(tipo) VALUES(?)');

        return ($statement->execute([$tipo])) ? true : false;
    }

    public function deleteSeccion($id){
        $statement = $this->PDO->prepare('DELETE FROM secciones WHERE id = ?');

        return ($statement->execute([$id])) ? true : false;
    }
    
    public function updateSeccion($id, $tipo){
        $statement = $this->PDO->prepare('UPDATE secciones SET tipo = ? WHERE id = ?');

        return ($statement->execute([$tipo, $id])) ? true : false;
    }

    public function getSeccionesFilteredBy ($filter, $val) {
        $statement = $this->PDO->prepare('SELECT * FROM secciones WHERE '.$filter.' = ?');

        return ($statement->execute([$val])) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function getSeccionesSorted ($sort, $order){
        $statement = $this->PDO->prepare('SELECT * FROM secciones ORDER BY '.$sort.' '.$order.'');

        return ($statement->execute()) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}










?>