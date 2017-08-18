<?php
class Char {
    public $name;
    public $level;
    public $gear;
    public $star;
    
    public function __construct($name, $level, $gear, $star){
        $this->name = $name;
        $this->level = $level;
        $this->gear = $gear;
        $this->start = $star;
    }

}
?>