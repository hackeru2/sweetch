<?php /** @noinspection PhpMissingFieldTypeInspection */

class Database {
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct() {
      $this->init();
    }

    public function init()
    {
          $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    //Allows us to write queries
    public function query($sql) {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    public function insert($data, $table)
    {
         
        $pdo = $this->dbHandler;
        $stmt = $pdo->prepare("INSERT INTO $table (Year, Age ,Ethnic ,Sex ,Area, count ) VALUES (?,?,?,?,?,?)");
        try {
            $pdo->beginTransaction();

            foreach ($data as $row)
            {
                // $d = explode(  ",", $row);
                // print_r($row);
              $stmt->execute($row);
            }
            $pdo->commit();
          
        }catch (Exception $e){
            echo("error");
            $pdo->rollback();
            throw $e;
        }
    }
    //Bind values
    public function bind($parameter, $value, $type = null) {
        /** @noinspection PhpSwitchCanBeReplacedWithMatchExpressionInspection */
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($parameter, $value, $type);
    }

    //Execute the prepared statement
    public function execute() {
        return $this->statement->execute();
    }

    //Return an array
    public function resultSet() {
        try {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
  echo "The user could not be added.<br>".$e->getMessage();
}
    }

    //Return a specific row as an object
    public function single() {
               try { 
                   $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
 print_r ($e);
}
    }

    //Get's the row count
    public function rowCount() {
        return $this->statement->rowCount();
    }
}