<?php
class Database{
    const DB_SERVER = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_NAME = "cms";
    
    public $connection;
    function __construct()
    {
      $this->connection=mysqli_connect(self::DB_SERVER,self::DB_USER,self::DB_PASSWORD,self::DB_NAME);
      if(!$this->connection){
        throw new Exception("Could'nt connect to the database");
      }
    }

    public function get_connection(){
        return $this->connection;
    }

    public function query($query){
        $result = $this->connection->query($query);
        $this->confirm_query($result);
        return $result;
    } 
    
    public function query_count($table,$column_date,$start_date,$end_date){
        $query_result = $this->connection->query("SELECT count(*) as count FROM $table WHERE $column_date >='$start_date' AND $column_date <= '$end_date'");
        $fetch_row = mysqli_fetch_array($query_result);
        return $fetch_row['count'];
    }

    public function query_count_condition($table,$column,$field,$column_date,$start_date,$end_date){
        $query_result = $this->connection->query("SELECT count(*) as count FROM ". $table . " WHERE " . "$column" ."=" . "'$field'" . "AND $column_date>='$start_date' AND $column_date <= '$end_date'");
        $fetch_row = mysqli_fetch_array($query_result);
        return $fetch_row['count'];
    }

    public function count_rows($result){
        return mysqli_num_rows($result);
    }
    public function fetch_array($result){
        return mysqli_fetch_array($result);
    }

    public function escape($string){
        return $this->connection->real_escape_string($string);
    }

    public function confirm_query($result){
        if(!$result){
            die($this->connection." Query failed");
        }
    }

    public function getLastInsertedId(){
        return $this->connection->insert_id;
    }
}
$database = new Database();
?>