<?php

class MysqlDB {

    public $connectionString;
    public $dataSet;
    private $sqlQuery;

        protected $databaseName;
        protected $hostName;
        protected $userName;
        protected $passCode;

    function __construct()    {
        $this -> connectionString = NULL;
        $this -> sqlQuery = NULL;
        $this -> dataSet = NULL;
            
                $this -> databaseName = DB_DATABASE;
                $this -> hostName = DB_SERVER;
                $this -> userName = DB_SERVER_USERNAME;
                $this -> passCode = DB_SERVER_PASSWORD;
                $dbPara = NULL;
    }

    function dbConnect()    {
        $this -> connectionString = mysqli_connect($this -> hostName,$this -> userName,$this -> passCode, $this -> databaseName);
        // Check connection
        if ($this -> connectionString -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }  
        return $this -> connectionString;
    }

    function dbDisconnect() {
        $this -> connectionString = NULL;
        $this -> sqlQuery = NULL;
        $this -> dataSet = NULL;
                $this -> databaseName = NULL;
                $this -> hostName = NULL;
                $this -> userName = NULL;
                $this -> passCode = NULL;
    }

    function selectAll($tableName)  {
        $this -> sqlQuery = 'SELECT * FROM '.$this -> databaseName.'.'.$tableName;
        $this -> dataSet = mysql_query($this -> connectionString, $this -> sqlQuery);
        return $this -> dataSet;
    }

    function selectWhere($tableName,$rowName,$operator,$value,$valueType)   {
        $this -> sqlQuery = 'SELECT * FROM '.$tableName.' WHERE '.$rowName.' '.$operator.' ';
        if($valueType == 'int') {
            $this -> sqlQuery .= $value;
        }
        else if($valueType == 'char')   {
            $this -> sqlQuery .= "'".$value."'";
        }
        $this -> dataSet = mysql_query($this -> connectionString, $this -> sqlQuery);
        $this -> sqlQuery = NULL;
        return $this -> dataSet;
        #return $this -> sqlQuery;
    }

    function insert($tableName,$data) {  

        $this -> sqlQuery = "INSERT INTO {$tableName}  (";
        foreach($data as $columns =>  $value){
            $this -> sqlQuery .= $columns . ', ';
        }
        
        $this -> sqlQuery = substr($this -> sqlQuery, 0, -2) . ') values (';
        reset($data);

        foreach($data as $columns =>  $value){
            switch ((string)$value) {
                case 'now()':
                    $this -> sqlQuery .= 'now(), ';
                break;
                case 'null':
                    $this -> sqlQuery .= 'null, ';
                break;
                default:
                    $this -> sqlQuery .= '\'' . $value . '\', ';
                break;
            }
        }
        $this -> sqlQuery = substr($this -> sqlQuery, 0, -2) . ')';     
        
        mysqli_query($this ->connectionString, $this -> sqlQuery);
        return mysqli_insert_id($this ->connectionString);
    }


    function update($table, $data, $parameters = '') {
        reset($data);
        $this -> sqlQuery = "UPDATE {$table} SET ";
        foreach($data as $columns =>  $value){
            switch ((string)$value) {
            case 'now()':
                $this -> sqlQuery .= $columns . ' = now(), ';
                break;
            case 'null':
                $this -> sqlQuery .= $columns .= ' = null, ';
                break;
            default:
                $this -> sqlQuery .= $columns . ' = \'' . $value . '\', ';
                break;
            }
        }
        $this -> sqlQuery = substr($this -> sqlQuery, 0, -2) . ' WHERE ' . $parameters;

        mysqli_query($this ->connectionString, $this -> sqlQuery);
        return $this -> sqlQuery;
    }


    function selectFreeRun($query)  { 
        $this -> dataSet =  mysqli_query($this -> connectionString, $query);
        return $this -> dataSet;
    }

    function selectRaw($query)  { 
        $this -> dataSet =  mysqli_query($this -> connectionString, $query);

        $result = array();
        if(!empty($this -> dataSet) && mysqli_num_rows($this -> dataSet) > 0) {
            while ($row = $this -> dataSet->fetch_assoc()) {
                $result[] = $row;
            }
        }
        return $result;
    }

    function freeRun($query)    {
        return mysqli_query($this -> connectionString, $query);
    }
}
$DB=new MysqlDB;
$DB->dbConnect();