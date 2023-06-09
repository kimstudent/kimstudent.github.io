<?php
require_once('BaseMap.php');

class OtdelMap extends BaseMap {
    public function arrOtdels()
    {
        $res = $this->db->query("SELECT otdel_id AS id, name AS value FROM otdel");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }


    public function findById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT otdel_id, name, active FROM otdel WHERE otdel_id = $id");
            return $res->fetchObject("Otdel");
        }
        return new Otdel();
    }

    public function save(Otdel $otdel)
    {
        if ($otdel->validate()) {
            if ($otdel->otdel_id == 0) {
                return $this->insert($otdel);
            } 
            else {
                return $this->update($otdel);
            }
        }
        return false;
    }

    private function insert(Otdel $otdel)
    {
        if ($this->db->exec("INSERT INTO otdel(name, active) VALUES('$otdel->name', $otdel->active)") == 1) 
        {
            $otdel->otdel_id = $this->db->lastInsertId();
            return true;
        }
        return false;
    }

    private function update(Otdel $otdel)
    {
        if ( $this->db->exec("UPDATE otdel SET name = '$otdel->name', active = $otdel->active WHERE otdel_id = ".$otdel->otdel_id) == 1) 
        {
            return true;
        }
        return false;
    }


    public function findAll($ofset = null, $limit = 30)
    {
        $res = $this->db->query("SELECT otdel.otdel_id, otdel.name, otdel.active FROM otdel LIMIT $ofset, $limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function count()
    {
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM otdel");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }

    public function findViewById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT otdel.otdel_id, otdel.name, otdel.active FROM otdel WHERE otdel_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }
}
