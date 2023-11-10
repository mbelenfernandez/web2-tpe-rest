<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/comentario.model.php';

class ComentarioApiController extends ApiController
{
    private $model;
    private $authHelper;

    function __construct()
    {
        parent::__construct();
        $this->model = new ComentarioModel();
        $this->authHelper = new AuthHelper();
    }

    function get($params = [])
    {
        if (empty($params)) {
            $this->view->response('Se debe indicar un id canción', 404);
            return;
        } else {
            $comentarios = $this->model->getComentariosByIdCancion($params[':ID']);

            if (!empty($comentarios)) {
                    $this->view->response($comentarios, 200);
                    return;
            } else {
                $this->view->response('La canción con el id ' . $params[':ID'] . ' no existe.', 404);
                return;
            }
        }
    }

    function create($params = [])
    {

        $user = $this->authHelper->currentUser();
        if (!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }
        $body = $this->getData();
        $fecha = $body->fecha;
        $descripcion = $body->descripcion;
        $puntaje = $body->puntaje;
        $id_cancion = $body->id_cancion;
        $id = $this->model->insertComentario($fecha, $descripcion, $puntaje, $id_cancion);
        $this->view->response('El comentario fue insertado con el id ' . $id, 201);
        return;
    }

    function update($params = [])
    {
        $user = $this->authHelper->currentUser();
        if (!$user) {
            $this->view->response('Unauthorized', 401);
            return;
        }
        $id = $params[':ID'];
        $comentario = $this->model->getComentario($id);

        if ($comentario) {
            $body = $this->getData();
            $fecha = $body->fecha;
            $descripcion = $body->descripcion;
            $puntaje = $body->puntaje;
            $this->model->updateComentario($id, $fecha, $descripcion, $puntaje);
            $this->view->response('El comentario con id ' . $id . ' ha sido modificado.', 200);
            return;
        } else {
            $this->view->response('El comentario con id ' . $id . ' no existe.', 404);
            return;
        }
    }

}
