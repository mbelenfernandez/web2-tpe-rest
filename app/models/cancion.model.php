<?php

require_once 'config.php';

class CancionModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }

    function getCanciones()
    {
        $query = $this->db->prepare('SELECT c.id_cancion, c.titulo, c.artista, c.duracion, c.letra, g.descripcion, g.id_genero FROM cancion c INNER JOIN genero g ON c.id_genero = g.id_genero order by id_cancion ASC;');
        $query->execute();

        $canciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $canciones;
    }

    function getCancionById($id)
    {
        $query = $this->db->prepare('SELECT * FROM cancion c INNER JOIN genero g ON c.id_genero = g.id_genero WHERE c.id_cancion = ? order by id_cancion ASC');
        $query->execute([$id]);

        $cancion = $query->fetchAll(PDO::FETCH_OBJ);

        return $cancion;
    }

    function getCancionesOrderBy($field, $order)
    {
        $query = $this->db->prepare('SELECT c.id_cancion, c.titulo, c.artista, c.duracion, c.letra, g.descripcion, g.id_genero FROM cancion c INNER JOIN genero g ON c.id_genero = g.id_genero order by ? ?;');
        $query->execute([$field, $order]);

        $canciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $canciones;
    }

    function getCancionByGenero($id_genero)
    {
        $query = $this->db->prepare('SELECT id_cancion, titulo, artista FROM cancion where id_genero=? order by id_cancion ASC');
        $query->execute([$id_genero]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getCancionesFiltered($filter, $value)
    {
        $query = $this->db->prepare('SELECT c.id_cancion, c.titulo, c.artista, c.duracion, c.letra, g.descripcion, g.id_genero FROM cancion c INNER JOIN genero g ON c.id_genero = g.id_genero WHERE ? = ?;');
        $query->execute([$filter, $value]);

        $canciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $canciones;
    }
    
    function getCancionesPaginated($page, $size)
    {
        $query = $this->db->prepare("SELECT c.id_cancion, c.titulo, c.artista, c.duracion, c.letra, g.descripcion, g.id_genero FROM cancion c INNER JOIN genero g ON c.id_genero = g.id_genero ORDER BY id_cancion ASC LIMIT $page, $size;");
        $query->execute();

        $canciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $canciones;
    }

    function insertCancion($titulo, $artista, $duracion, $letra, $id_genero)
    {
        $query = $this->db->prepare('INSERT INTO cancion (titulo, artista, duracion, letra, id_genero) VALUES(?,?,?,?,?)');
        $query->execute([$titulo, $artista, $duracion, $letra, $id_genero]);
        return $this->db->lastInsertId();
    }

    function deleteCancion($id)
    {
        $query = $this->db->prepare('DELETE FROM cancion WHERE id_cancion=?');
        $query->execute([$id]);
    }

    function updateCancion($id, $titulo, $artista, $letra, $duracion, $id_genero)
    {
        $query = $this->db->prepare('UPDATE cancion SET titulo=?, artista=?, letra=?, duracion=?, id_genero=? WHERE id_cancion=?');
        $query->execute([$titulo, $artista, $letra, $duracion, $id_genero, $id]);
    }
}
