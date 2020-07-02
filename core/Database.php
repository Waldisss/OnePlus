<?php


class Database
{
    /**
     * @var mysqli $connection
     */

    private $connection = null;
    private $host;
    private $user;
    private $password;
    private $database;

    public function __construct($host, $user, $password, $database)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->makeConnection();
    }

    public  function __destruct()
    {
        if (!is_null($this->connection)) {
            $this->closeConnection();
        }
    }

    private function makeConnection()
    {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->connection->connect_error) {
            echo 'Fail '.$this->connection->connect_error;
            $this->connection = null;
        }
    }

    private function closeConnection()
    {
        if (!is_null($this->connection)) {
            $this->connection->close();
            $this->connection = null;
        }
    }

    private function getReferencesVars(&$vars)
    {
        $references = array();
        for ($i = 0; $i < count($vars); $i++) {
            $references[$i] = &$vars[$i];
        }
        return $references;
    }

    public function executeQuery($query, $typesVars = null, $vars = null)
    {
        $stmt = $this->connection->prepare($query);

        if (!is_null($typesVars) && !is_null($vars)) {
            $reflectionArg = array_merge(array($typesVars), $this->getReferencesVars($vars));
            $reflectionStmt = new ReflectionClass('mysqli_stmt');
            $bindParamMethod = $reflectionStmt->getMethod('bind_param');
            $bindParamMethod->invokeArgs($stmt, $reflectionArg);
        }

        $stmt->execute();
        $mysqli_result = $stmt->get_result();

        $result = [];
        while($mysqli_result && ($row = $mysqli_result->fetch_assoc())) {
            $result[] = $row;
        }

        return $result;
    }
}