<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/cancion.model.php';

class CancionApiController extends ApiController
{
    private $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new CancionModel();
    }

    function get($params = [])
    {
        if (empty($params)) {
            $canciones = $this->model->getCanciones();
            $this->view->response($canciones, 200);
        } else {
            $cancion = $this->model->getCancionById($params[':ID']);
            if (!empty($cancion)) {
                if ($params[':subrecurso']) {
                    switch ($params[':subrecurso']) {
                        case 'titulo':
                            $this->view->response($cancion[0]->titulo, 200);
                            break;
                        case 'artista':
                            $this->view->response($cancion[0]->artista, 200);
                            break;
                        case 'duracion':
                            $this->view->response($cancion[0]->duracion, 200);
                            break;
                        case 'letra':
                            $this->view->response($cancion[0]->letra, 200);
                            break;
                        default:
                            $this->view->response(
                                'La canción no contiene ' . $params[':subrecurso'] . '.', 404);
                            break;
                    }
                } else
                    $this->view->response($cancion, 200);
            } else {
                $this->view->response(
                    'La canción con el id ' . $params[':ID'] . ' no existe.', 404);
            }
        }
    }

    
    function create($params = []) {
        $body = $this->getData();
        $titulo = $body->titulo;
        $artista = $body->artista;
        $duracion = $body->duracion;
        $letra = $body->letra;
        $id_genero = $body->id_genero;

        $id = $this->model->insertCancion($titulo, $artista, $duracion, $letra, $id_genero);

        $this->view->response('La canción fue insertada con el id '.$id, 201);
    }
    
    function update($params = []) {
        $id = $params[':ID'];
        $cancion = $this->model->getCancionById($id);

        if($cancion) {
            $body = $this->getData();
            $titulo = $body->titulo;
            $artista = $body->artista;
            $letra = $body->letra;
            $duracion = $body->duracion;
            $id_genero = $body->id_genero;
            $this->model->updateCancion($id, $titulo, $artista, $letra, $duracion, $id_genero);
            $this->view->response('El comentario con id '.$id.' ha sido modificado.', 200);
        } else {
            $this->view->response('El comentario con id '.$id.' no existe.', 404);
        }
    }
}
