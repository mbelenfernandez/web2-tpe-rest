<?php
    require_once 'app/controllers/api.controller.php';
    require_once 'app/models/genero.model.php';

    class GeneroApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new GeneroModel();
        }

        function get($params = []) {
            if (empty($params)){
                $generos = $this->model->getGeneros();
                $this->view->response($generos, 200);
            } else {
                $genero= $this->model->getGenero($params[':ID']);
                if(!empty($genero)) {
                    if($params[':subrecurso']) {
                        switch ($params[':subrecurso']) {
                            case 'descripcion':
                                $this->view->response($genero->descripcion, 200);
                                break;
                                
                            default:
                            $this->view->response(
                                'El género no contiene '.$params[':subrecurso'].'.'
                                , 404);
                                break;
                        }
                    } else
                        $this->view->response($genero, 200);
                } else {
                    $this->view->response(
                        'El género con el id='.$params[':ID'].' no existe.'
                        , 404);
                }
            }
        }

        function delete($params = []) {
            $id = $params[':ID'];
            $tarea = $this->model->getGenero($id);

            if($tarea) {
                $this->model->deleteGenero($id);
                $this->view->response('El género con id='.$id.' ha sido borrado.', 200);
            } else {
                $this->view->response('El género con id='.$id.' no existe.', 404);
            }
        }

        function create($params = []) {
            $body = $this->getData();
            $descripcion = $body->descripcion;
            $id = $this->model->insertGenero($descripcion);

            $this->view->response('El género fue insertado con el id='.$id, 201);
        }

        function update($params = []) {
            $id = $params[':ID'];
            $genero = $this->model->getGenero($id);

            if($genero) {
                $body = $this->getData();
                $descripcion = $body->descripcion;
                $this->model->updateGenero($id, $descripcion);

                $this->view->response('El género con id='.$id.' ha sido modificado.', 200);
            } else {
                $this->view->response('El género con id='.$id.' no existe.', 404);
            }
        }
    }