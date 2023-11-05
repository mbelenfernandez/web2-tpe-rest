<?php

require_once 'config.php';

class ComentarioModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }

    function getComentariosByIdCancion($id)
    {
        $query = $this->db->prepare('SELECT * FROM comentario c WHERE c.id_cancion = ? order by id_comentario ASC');
        $query->execute([$id]);

        $comentarios = $query->fetchAll(PDO::FETCH_OBJ);

        return $comentarios;
    }

    function getComentariosOrderBy($id, $field, $order)
    {
        $query = $this->db->prepare('SELECT * FROM comentario c WHERE c.id_cancion = ? order by ? ?');;
        $query->execute([$id, $field, $order]);

        $comentarios = $query->fetchAll(PDO::FETCH_OBJ);

        return $comentarios;
    }
  
    function insertComentario($fecha, $descripcion, $puntaje, $id_cancion)
    {
        $query = $this->db->prepare('INSERT INTO cancion (fecha, descripcion, puntaje, id_cancion) VALUES(?,?,?,?)');
        $query->execute([$fecha, $descripcion, $puntaje, $id_cancion]);
        return $this->db->lastInsertId();
    }

}