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

    function getCancionByGenero($id_genero)
    {
        $query = $this->db->prepare('SELECT id_cancion, titulo, artista FROM cancion where id_genero=? order by id_cancion ASC');
        $query->execute([$id_genero]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function updateCancion($id, $titulo, $artista, $duracion, $id_genero)
    {
        $query = $this->db->prepare('UPDATE cancion SET titulo=?, artista=?, duracion=?, id_genero=? WHERE id_cancion=?');
        $query->execute([$titulo, $artista, $duracion, $id_genero, $id]);
    }

    function updateLetra($id, $letra)
    {
        $query = $this->db->prepare('UPDATE cancion SET letra=? WHERE id_cancion=?');
        $query->execute([$letra, $id]);
    }
}
