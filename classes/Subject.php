<?php
require_once('Table.php');

class Subject extends Table {
    
    public $subject_id = 0;
    public $name = '';
    public $otdel_id = 0;
    public $hours = '';
    public $active = 1;
    
    public function validate()
    {
        if (!empty($this->name) && !empty($this->otdel_id) && !empty($this->hours)) 
        { 
            return true;
        }
        return false;
    }
}
