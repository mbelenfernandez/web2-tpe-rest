<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/genero.model.php';

class GeneroApiController extends ApiController
{
    private $model;
    private $authHelper;

    function __construct()
    {
        parent::__construct();
        $this->model = new GeneroModel();
        $this->authHelper = new AuthHelper();
    }

    function get($params = [])
    {
        if (empty($params)) {
            $sort = 'id_genero';
            $order = 'asc';

            if (isset($_GET['order'])) {
                $order = $_GET['order'];
                if ($order != 'asc' && $order != 'desc') {
                    $order = 'asc';
                }
            }

            if (isset($_GET['sort'])) {
                $sort = $_GET['sort'];
                $columnasValidas = array('id_genero', 'descripcion');
                if (!in_array($sort, $columnasValidas)) {
                    $sort = 'id_genero';
                }
            }

            $generos = $this->model->getGeneros($order, $sort);
            $this->view->response($generos, 200);
            return;
        } else {
            $genero = $this->model->getGenero($params[':ID']);
            if (!empty($genero)) {
                $this->view->response($genero, 200);
                return;
            } else {
                $this->view->response('El género con el id ' . $params[':ID'] . ' no existe.',404);
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
        $descripcion = $body->descripcion;
        $id = $this->model->insertGenero($descripcion);

        $this->view->response('El género fue insertado con el id ' . $id, 201);
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
        $genero = $this->model->getGenero($id);

        if ($genero) {
            $body = $this->getData();
            $descripcion = $body->descripcion;
            $this->model->updateGenero($id, $descripcion);
            $this->view->response('El género con id ' . $id . ' ha sido modificado.', 200);
            return;
        } else {
            $this->view->response('El género con id ' . $id . ' no existe.', 404);
            return;
        }
    }
}
