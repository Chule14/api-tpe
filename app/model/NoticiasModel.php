<?php 

// La clase modelo se comunica con la BD y realiza las consultas
class NoticiasModel {
    private $PDO;

    public function __construct () { 
        include_once 'app/database/db.php';
        $conex = new Database(); // Instacia de la clase DB
        $this->PDO = $conex->conexion(); // Metodo conexion.
    } // El constructor crea la conexion a la BD y la guarda en el PDO

    public function createNoticia ($titulo, $subtitulo, $descripcion, $seccion, $imagen) {
        $statement = $this->PDO->prepare('INSERT INTO noticias (titulo, subtitulo, descripcion, id_seccion, imagen) VALUES ("'.$titulo.'", "'.$subtitulo.'", "'.$descripcion.'", "'.$seccion.'", "'.$imagen.'")');
        //Statement es una variable donde almacenamos la query que posteriormente ejecutaremos.
        return ($statement->execute()) ? true : false;
        //En este caso es un condicional ternario, retorna el valor final de la ejecucion, si sale exitosa da true sino false.
        //Como queremos mostrar datos solo enviamos true o false para que el controlador sepa que devolver.
    }


    public function getNoticias () {
        $statement = $this->PDO->prepare('SELECT noticias.*, secciones.tipo FROM noticias INNER JOIN secciones ON noticias.id_seccion = secciones.id');

        return ($statement->execute()) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
        //Aqui si mostramos datos ya que cargamos todas las filas y columnas de la tabla noticias
    }

    public function getNoticia ($id) {
        $statement = $this->PDO->prepare('SELECT noticias.*, secciones.*
        FROM noticias
        INNER JOIN secciones ON noticias.id_seccion = secciones.id
        WHERE noticias.id = '.$id.'');
        // Un inner join hace una interseccion entre las tablas y nos devuelve los datos donde haya una relacion entre tablas.

        return ($statement->execute()) ? $statement->fetch(PDO::FETCH_ASSOC) : false;
        //Aqui solamente retorna el fetch de una fila, ya que busca especificamente una fila.
    }

    public function deleteNoticia ($id) {
        $statement = $this->PDO->prepare('DELETE FROM noticias WHERE id = '.$id.'');

        return ($statement->execute()) ? true : false;
    }

    public function updateNoticia ($id, $titulo, $subtitulo, $descripcion, $seccion) {
        $statement = $this->PDO->prepare('UPDATE noticias SET titulo = ?, subtitulo = ?, descripcion = ?, id_seccion = ? WHERE id = ?');

        return ($statement->execute([$titulo, $subtitulo, $descripcion, $seccion, $id])) ? true : false;
    }

    public function getNoticiasFilteredBy ($filter, $val) {
        $statement = $this->PDO->prepare('SELECT noticias.*, secciones.tipo FROM noticias INNER JOIN secciones ON noticias.id_seccion = secciones.id WHERE '.$filter.' = ?');

        return ($statement->execute([$val])) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function getNoticiasSorted($sort, $order){
        $statement = $this->PDO->prepare('SELECT noticias.*, secciones.tipo FROM noticias INNER JOIN secciones ON noticias.id_seccion = secciones.id ORDER BY '.$sort.' '.$order.'');

        return ($statement->execute()) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function getNoticiasTitleContains($contain){
        $statement = $this->PDO->prepare('SELECT noticias.*, secciones.tipo FROM noticias INNER JOIN secciones ON noticias.id_seccion = secciones.id WHERE titulo LIKE "%'.$contain.'%"');

        return ($statement->execute()) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

}


?>