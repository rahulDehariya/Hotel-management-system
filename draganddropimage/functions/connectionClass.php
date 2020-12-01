<?php
class connectionClass extends mysqli{
    private $host="localhost",$dbname="db_test_new",$dbpass="DB@testP$13322",$dbuser="dbtest.test";
    public $con;
    
    public function __construct() {
        $this->con=  $this->connect($this->host, $this->dbuser, $this->dbpass, $this->dbname);
        if($this->con){}
        else{
//            echo "<h1>Error while connecting to database</h1>";
        }
    }
}
