<?php

Class dbObj{
    /* Database connection start */
    var $servername = "lamp.cse.fau.edu";
    var $username = "CEN4010_S2018g03";
	var $password = "cen4010_s2018";
	var $dbname = "CEN4010_S2018g03";
	var $conn;
    function getConnstring() {
        $con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

		/* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        } else {
            $this->conn = $con;
        }
        return $this->conn;
    }
}

?>