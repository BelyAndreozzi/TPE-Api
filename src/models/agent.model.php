<?php

require_once 'src/models/Model.php';

class AgentModel extends Model
{
    function getAgents($order, $field, $filterBy, $filterValue, $limit, $offset)
    {
        $sql = "SELECT agent.*, role.name as role FROM agent JOIN role ON agent.id_role_fk=role.id_role";

        switch($filterBy){
            case 'race':
                $sql .= ' WHERE race = ' . '\''. $filterValue.'\'';
                break;
            case 'role':
                $sql .= ' WHERE role.name = ' . '\''. $filterValue.'\'';
                break;
            case 'is_free':
                $sql .= ' WHERE is_free = ' . '\''. $filterValue.'\'';
                break;
            default:
                $sql .= ' ';
                break;
        }

        switch($order){
            case 'ASC':
                $sql .= ' ORDER BY ' . $field . ' ASC';
                break;
            case 'DESC':
                $sql .= ' ORDER BY ' . $field . ' DESC';
                break;
            default:
                $sql .= ' ORDER BY alias ASC';
                break;
        }

        if($limit != 'null'){
            $sql .= ' LIMIT ' . $limit;
        }

        if($offset != 'null'){
            $sql .= ' OFFSET ' . $offset;
        }
        
        $query = $this->db->prepare($sql);

        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getAgentById ($agentId) {
        $query = $this->db->prepare('SELECT agent.*, role.name as role FROM agent JOIN role ON agent.id_role_fk=role.id_role WHERE id = ?');
        $query->execute([$agentId]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function insertAgents($alias, $id_role_fk, $description, $agent_img, $age, $nacionality, $race, $is_free, $teamwork)
    {
        $query = $this->db->prepare('INSERT INTO agent (id, alias, id_role_fk, description, agent_img, age, nacionality, race, is_free, teamwork ) VALUES(null,?,?,?,?,?,?,?,?,?)');
        $query->execute([$alias, $id_role_fk, $description, $agent_img, $age, $nacionality, $race, $is_free, $teamwork]);

        return $this->db->lastInsertId();
    }

    function deleteAgent($id)
    {
        $query = $this->db->prepare('DELETE FROM agent WHERE id = ?');
        $query->execute([$id]);
    }

    function updateAgent($id, $alias, $id_role_fk, $description, $agent_img, $age, $nacionality, $race, $is_free, $teamwork)
    {
        $query = $this->db->prepare('UPDATE agent SET alias = ?, id_role_fk = ?, description = ?, agent_img = ?, age = ?, nacionality = ?, race = ?, is_free = ?, teamwork = ? WHERE id = ?');
        $query->execute([$alias, $id_role_fk, $description, $agent_img, $age, $nacionality, $race, $is_free, $teamwork, $id]);
    }

}
