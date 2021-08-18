<?php
// connect to mongodb
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// require_once __DIR__ . '.\vendor\autoload.php';
require_once('../vendor/autoload.php');



class MongoDB
{

    public $collection;
    // public $dataSet;
    // private $sqlQuery;

    // protected $databaseName;
    // protected $hostName;
    // protected $userName;
    // protected $passCode;

    public function __construct()
    {
        $this->collection = null;
        // $this->sqlQuery = null;
        // $this->dataSet = null;

        // $this->databaseName = DB_DATABASE;
        // $this->hostName = DB_SERVER;
        // $this->userName = DB_SERVER_USERNAME;
        // $this->passCode = DB_SERVER_PASSWORD;
        // $dbPara = null;
    }

    public function dbConnect()
    {
        $this->collection = (new MongoDB\Client('mongodb://admin:riversanddbadmin@13.68.190.175:27027' ))->attributeMappingTool;
        return $this->collection;
    }
// Public IP : 13.68.190.175
// Port: 27027
// Username: admin
// Password: riversanddbadmin

    public function insertRow($tableName , $jsonData )
    {
        $convertedDocument = json_decode($jsonData, true);
        $insertOneResult = $this->collection->$tableName->insertOne(
            $convertedDocument
        );
    }

    public function readRow($tableName, $rowName)
    {
        $document = $this->collection->$tableName->findOne(['row_name' => $rowName]);
        return $document; //send this as response
    }

    public function deleteRow($tableName, $rowName)
    {
        $deleteResult = $this->collection->$tableName->deleteMany(['row_name' => $rowName]);
    }
    
    public function getDocuments($tableName)
    {
        $docs = $this->collection->$tableName->find([]);
        $docArray = [];
        foreach ( $docs as $id => $value )
        {
            // echo "$id: ";
            array_push($docArray , $value);
        }
        return $docArray;
    }

}

//--------------------------------
$Mdb = new MongoDB;
$Mdb->dbConnect();
