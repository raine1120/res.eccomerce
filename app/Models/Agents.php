<?php

namespace App\Models;

use Core\Model;

class Agents extends Model {

    public function __construct(){

        $this->pdo = $this->selectDatabase("Diamante");

    }


    public function getAgents(){

        $sql = " 
                SELECT 
                  gad.transera_id as id,
                  get_short_name(ue.id_employee::integer) as name,
                  ue.id_employee::integer as id_employee
                FROM guthy_renker.grs_agent_dnis gad
                LEFT JOIN public.uno_employes ue ON (ue.id_employee = gad.id_employee)
                WHERE TRUE
                    AND ue.fis_supervisor IS FALSE
                    AND ue.active IS TRUE
                    --AND ue.ub_codigo IN (92)
                    AND gad.active IS TRUE
                ORDER BY ue.id_employee";

        $agents = $this->exec($sql);
        foreach ($agents as &$row) {
            $row['name'] = utf8_encode($row['name']);
        }
        return $agents;

    }

    public function getAgentsByID($idEmployee){

        $sql ="SELECT get_full_name($idEmployee) as id";
        $agent = $this->exec($sql);
        return $agent;
    }

    public function getLevel(){

        $sql ="SELECT 
                  sral.id_record as id,
                  sral.description
                FROM 
                  guthy_renker.skill_roster_agent_level sral";
        $res = $this->exec($sql);
        return $res;
    }

}