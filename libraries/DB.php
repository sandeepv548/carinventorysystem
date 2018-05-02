<?php
class Db {

    public $table = '';

    private static function dbConnection() {
        $servername = 'localhost';
        $database = 'carinventorysystem';
        $user = 'root';
        $password = '';
        $conn = mysqli_connect($servername, $user, $password, $database);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        return $conn;
    }

    public static function insert($table, $valuesArray) {
        $conn = self::dbConnection();
        $getColumnStr =implode(',',array_keys($valuesArray));
        $getColumnValStr = self::arrayToSqlQueryString(array_values($valuesArray));
         $sql = "INSERT INTO " . $table . "(" . $getColumnStr . ") values(" . $getColumnValStr . ")"; 
        mysqli_query($conn, $sql);
        return mysqli_insert_id($conn);
    }
     public static function getRecords($table,$columsArray=FALSE,$whereCondStr=FALSE) {
      $conn = self::dbConnection();
         if($columsArray!=FALSE){
           $colStr= implode(',', $columsArray);
        }else{
            $colStr="*";
        }
        if($whereCondStr!=FALSE||$whereCondStr!=""){
           $where="WHERE ".$whereCondStr;
        }else{
            $where="";
        }
        $sql = "SELECT $colStr from $table $where";
        $results=mysqli_query($conn, $sql);
        return mysqli_fetch_all($results,MYSQLI_ASSOC);
    }

    public static function getByQuery($query) {
        $conn = self::dbConnection();
        $results=mysqli_query($conn, $query);
        return mysqli_fetch_all($results,MYSQLI_ASSOC);
    }
    private static function arrayToSqlQueryString($array) {
        $conn = self::dbConnection();
        foreach ($array as $value) {
            if (is_numeric($value)) {
                $field[] = self::msqli_res($conn, $value);
            } else {
                $field[] = "'" . self::msqli_res($conn, $value) . "'";
            }
        }
        return implode(',', $field);
    }
    public static function where($condArray,$operator='AND') {
        foreach ($condArray as $key=> $value) {
            if (is_numeric($value)) {
                $field[] = $key."=".self::msqli_res($conn, $value);
            } else {
                $field[] = $key."='".self::msqli_res($conn, $value)."'";
            }
        }
        return implode(' '.$operator.' ', $field);
    }
    private static function msqli_res($conn, $value) {
        return mysqli_real_escape_string($conn, $value);
    }
     public static function Query($query) {
        $conn = self::dbConnection();
        return mysqli_query($conn, $query);
    }

}
