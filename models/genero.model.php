<?php

require_once 'config.php';

class GeneroModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }

    function getGeneros()
    {
        $query = $this->db->prepare('SELECT * FROM genero');
        $query->execute();

        $generos = $query->fetchAll(PDO::FETCH_OBJ);

        return $generos;
    }

    function getGenero($id)
    {
        $query = $this->db->prepare('SELECT * FROM genero WHERE id_genero=?');
        $query->execute([$id]);

        $genero = $query->fetchAll(PDO::FETCH_OBJ);

        return $genero;
    }

    function insertGenero($descripcion)
    {
        $query = $this->db->prepare('INSERT INTO genero (descripcion) VALUES(?)');
        $query->execute([$descripcion]);
        return $this->db->lastInsertId();
    }

    function deleteGenero($id)
    {
        $query = $this->db->prepare('DELETE FROM genero WHERE id_genero=?');
        $query->execute([$id]);
    }

    function updateGenero($id, $descripcion)
    {
        $query = $this->db->prepare('UPDATE genero SET descripcion=? WHERE id_genero=?');
        $query->execute([$descripcion, $id]);
    }

    function verifyGeneroCancion($id)
    {
        $query = $this->db->prepare('SELECT 1 FROM cancion WHERE id_genero=?');
        $query->execute([$id]);
        $existe = $query->fetchAll(PDO::FETCH_OBJ);
        return $existe;
    }
}
