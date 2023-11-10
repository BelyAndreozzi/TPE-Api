<?php 
    require_once 'src/models/agent.model.php';
    require_once 'src/controllers/api.controller.php';

    class AgentApiController extends ApiController{
        private $agentModel;
        public function __construct(){
            parent::__construct();
            $this->agentModel = new AgentModel();
        }

        public function get($params = []){
            if (empty($params)){
                $order = isset($_GET['order']) ? strtoupper($_GET['order']) : 'ASC';
                $field = isset($_GET['field']) ? strtolower($_GET['field']) : 'alias';
                $filterBy = isset($_GET['filterBy']) ? strtolower($_GET['filterBy']) : 'null';
                $filterValue = isset($_GET['filterValue']) ? ucfirst($_GET['filterValue']) : 'null';
                $limit = isset($_GET['limit']) ? ($_GET['limit']) : 'null';
                $offset = isset($_GET['offset']) ? ($_GET['offset']) : 'null';
                
                $agents = $this->agentModel->getAgents($order, $field, $filterBy, $filterValue, $limit, $offset);
                $this->view->response($agents, 200);    
            } else {
                $agent = $this->agentModel->getAgentById($params[':ID']);
                if(!empty($agent)){
                    if(!empty($params[':subrecurso'])){
                        switch($params[':subrecurso']){
                            case 'alias':
                                $this->view->response($agent -> alias, 200);
                                break;
                            case 'role':
                                $this->view->response($agent -> role, 200);
                                break;
                            default:
                                $this->view->response('No se encontró: '. $params[':subrecurso'] . '.', 404);
                        }
                    } else {
                        $this->view->response($agent, 200);
                    }
                } else {
                    $this->view->response("Agente ID: " . $params[':ID'] . " no encontrado", 404);
                }
            }
        }

        function create ($params = []){
            $data = $this->getData();
            $alias = $data->alias;
            $role = $data->id_role_fk;
            $description = $data->description;
            $agent_img = $data->agent_img;
            $age = $data->age;
            $nacionality = $data->nacionality;
            $race = $data->race;
            $is_free = $data->is_free;
            $teamwork = $data->teamwork;

            if(empty($alias) || empty($role) || empty($description) || empty($agent_img) || empty($age) || empty($nacionality) || empty($race) || empty($teamwork)){
                $this->view->response("Faltan datos", 400);
            } else {
                $id = $this->agentModel->insertAgents($alias, $role, $description, $agent_img, $age, $nacionality, $race, $is_free, $teamwork);

                $agent = $this->agentModel->getAgentById($id);
                $this->view->response($agent, 201);
            }
        }

        function update($params = []){
            $id = $params[':ID'];
            $agent = $this->agentModel->getAgentById($id);

            if($agent){
                $data = $this->getData();
                $alias = $data->alias;
                $role = $data->id_role_fk;
                $description = $data->description;
                $agent_img = $data->agent_img;
                $age = $data->age;
                $nacionality = $data->nacionality;
                $race = $data->race;
                $is_free = $data->is_free;
                $teamwork = $data->teamwork;

                if(empty($alias) || empty($role) || empty($description) || empty($agent_img) || empty($age) || empty($nacionality) || empty($race) || empty($teamwork)){
                    $this->view->response("Faltan datos", 400);
                }
            
                $this->agentModel->updateAgent($id, $alias, $role, $description, $agent_img, $age, $nacionality, $race, $is_free, $teamwork);
                $this->view->response($agent -> alias . " actualizado", 200);
            } else {
                $this->view->response("Agente ID: " . $id . " no encontrado", 404);
            }
        }

        function delete($params = []){
            $id = $params[':ID'];
            $agent = $this->agentModel->getAgentById($id);

            if($agent){
                $this->agentModel->deleteAgent($id);
                $this->view->response($agent -> alias . " eliminado", 200);
            } else {
                $this->view->response("Agente ID: " . $id . " no encontrado", 404);
            }
        }


    }
