<?php

require_once 'Model.php';

    class UserModel extends Model 
    {
        function getUser($username){
            $query= $this->db->prepare('SELECT * FROM user WHERE username= ?');
            $query->execute([$username]);
            return $query->fetch(PDO::FETCH_OBJ);
        }
    }
?>