<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/comentario.model.php';

class ComentarioApiController extends ApiController
{
    private $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new ComentarioModel();
    }

    function get($params = [])
    {
        if (empty($params)) {
            $this->view->response(
                'Se debe indicar un id canción',
                404
            );
        } else {
            $comentarios = $this->model->getComentariosByIdCancion($params[':ID']);
            if (!empty($comentarios)) {
                if ($params[':subrecurso']) {
                    switch ($params[':subrecurso']) {
                        case 'titulo':
                            $this->view->response($comentarios[0]->fecha, 200);
                            break;
                        case 'artista':
                            $this->view->response($comentarios[0]->descripcion, 200);
                            break;
                        case 'duracion':
                            $this->view->response($comentarios[0]->puntaje, 200);
                            break;
                        case 'letra':
                            $this->view->response($comentarios[0]->id_cancion, 200);
                            break;
                        default:
                            $this->view->response(
                                'El comentario no contiene ' . $params[':subrecurso'] . '.',
                                404
                            );
                            break;
                    }
                } else
                    $this->view->response($comentarios, 200);
            } else {
                $this->view->response(
                    'La canción con el id ' . $params[':ID'] . ' no existe.',
                    404
                );
            }
        }
    }
}
