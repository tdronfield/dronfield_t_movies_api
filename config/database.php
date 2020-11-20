<?php

class Database
{
    // keep these private so they cannot be accessed outside of this object
    private $host = 'localhost';
    private $db_name = 'db_movies';
    private $username = 'root';
    private $password = ''; // root for MAC

    public $conn;

    public function getConnection(){
        // get the database connection
        $this->conn = null;

        $db_dsn = array(
            'host'=>$this->host,
            'dbname'=>$this->db_name,
            'charset'=>'utf8'
        );

        // this is for DOCKER users
        // if(getenv('IDP_ENVIRONMENT')==='docker'){
        //     $db_dsn['host'] = 'mysql';
        //     $this->username = 'docker_u';
        //     $this->password = 'docker_p';
        // }

        try{
            // try code that may come with errors
            $dsn = 'mysql:'.http_build_query($db_dsn, '', ';');
            $this->conn = new PDO($dsn, $this->username, $this->password);
        }catch(PDOException $exception){
            // tell php how to deal with errors
            echo json_encode(
                array(
                'error' => 'Database connection failed',
                'message' =>$exception->getMessage()
            ));
        }

        
        

        return $this->conn;
    }

}