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
                                'La canción no contiene ' . $params[':subrecurso'] . '.',
                                404
                            );
                            break;
                    }
                } else
                    $this->view->response($cancion, 200);
            } else {
                $this->view->response(
                    'La canción con el id ' . $params[':ID'] . ' no existe.',
                    404
                );
            }
        }
    }
}
