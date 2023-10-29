<?php

declare(strict_types=1);

class PDOAdapter
{
    //database connection
    protected ?PDO $connection;

    //
    protected bool $connected = false;

    // Set constructor parameters (dsn, username, password),
    public function __construct(string $dsn, string $username, string $password)
    {
        try {
            // Create connection
            $this->connection = new PDO($dsn, $username, $password);

            //set attributes to the connection object
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //https://www.php.net/manual/en/pdo.setattribute.php
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            //set connected to true
            $this->connected = true;
        } catch (PDOException $ex) {
            throw new PDOException("DB Connection Failure: " . $ex->getMessage());
        }
    }

    //function to preapre query
    public function prepareQuery(string $query)
    {
        return $this->connection->prepare($query);
    }

    //functio to execute the query with optional parameters
    public function executeQuery(object $prepared, array $options = [])
    {
       
        $prepared->execute($options);
    }

    //function to set the fields of a query with its table to avoid conflicts.
    private function setQueryFields(array $arrayFields)
    {

        $query = "";
        $i = 0;
        //set query fields with the table
        foreach ($arrayFields as $field => $table) {
            if ($i != sizeof($arrayFields) - 1) {
                $query .= "$table.$field ,";
            } else $query .= "$table.$field";
            $i++;
        }
       
        return $query;
    }

    //function to set alias to the fields of a query.
    private function setAlias(array $arrayFields, array $alias = [])
    {
        $query = "";
        $i = 0;
        foreach ($arrayFields as $field => $table) {
            if (sizeof($alias) > 0) {
                if ($i != sizeof($arrayFields) - 1) {
                    $query .= "$table.$field" . " AS " . $alias[$i] . ",";
                } else $query .= "$table.$field" . " AS " . $alias[$i];
                $i++;
            }
        }
        
        return $query;
    }

    //delete from database function @params table name, where clause index name, the value of the where clause
    public function delete(string $table, string $conditionFieldName, $conditionValue){
        
        $query = "DELETE FROM $table WHERE $conditionFieldName = :$conditionFieldName";
        
        $executeOptions = [":$conditionFieldName" => $conditionValue];
        
        $result = $this->prepareQuery($query);
        $this->executeQuery($result, $executeOptions);
    }

    //insert to database table @params table name and the fields
    /*
    get the columns of the associative array keys. Change the array values to prepared values array to set the values clause.
    */
    public function insert(string $table, array &$fields)
    {
        $columns = implode(', ', array_keys($fields));

        $query = "INSERT INTO $table ($columns)";

        $fields = parametrizeArray($fields);

        $parametrizedColumns = implode(', ', array_keys($fields));

        $query .= " VALUES ($parametrizedColumns)";

        $result = $this->prepareQuery($query);
        $this->executeQuery($result, $fields);
    }

    //update database table @params table name and the fields, condition value and index condition name
    public function update(string $table, array &$fields, $conditionValue, string $conditionFieldName)
    {
        $query =  "UPDATE $table SET ";
        $i = 0;

        foreach ($fields as $field => $value) {
            if ($i != sizeof($fields) - 1) {
                $query .= $field . ' = :' . $field . ', ';
            } else $query .= $field . ' = :' . $field;

            $i++;
        }
        $query .= " WHERE $conditionFieldName = :$conditionFieldName";

        
        $fields = parametrizeArray($fields);
        
        $result = $this->prepareQuery($query);
        
        $fields[':'.$conditionFieldName] = $conditionValue;
        
        $this->executeQuery($result, $fields);
        
    }

    //select clause @params table name, fields (optional), alias (optional)
    public function select(string $table, array $fields = [], array $alias = [])
    {
        //set default value for fields if it is empty
        if (sizeof($fields) == 0) $fields = ['*'];      
        
        //set query with alias
        if (sizeof($alias) > 0) {
            $queryFields = str_replace(array('(', ')'), '', $this->setAlias($fields, $alias));
        } else {//Set query without alias
            $queryFields = $this->setQueryFields($fields);
        }

        $query = "SELECT $queryFields FROM $table";
        
        return $query;
    }

    //inner join clause @params table 1 name, table 2 name, primary key and foreign key
    public function innerJoin(string $table1, string $table2,  $pk, $fk)
    {
        
        $query = " INNER JOIN $table2 ON $table1.$pk = $table2.$fk";

        return $query;
    }

    //condition clause query @params condition index name, table name, symbol (= or !=)
    public function condition(string $conditionFieldName, string $table, string $symbol)
    {
        if($symbol == '=') return " WHERE $table.$conditionFieldName = :$conditionFieldName";
        else return " WHERE $table.$conditionFieldName != :$conditionFieldName";
        
    }

    //function to verify if a field exists in a table @params field, value of the where clause, table, condition index, symbol
    public function verifyField(string $fieldToVerify, $conditionValue, string $table, string $conditionFieldName, string $symbol)
    {
        //create associative array with the field and the table
        $fieldToVerify = [$fieldToVerify => $table];
        //create execute options
        $executeOptions = [':' . $conditionFieldName => $conditionValue];

        $query = $this->select($table, $fieldToVerify, []) . $this->condition($conditionFieldName, $table, $symbol);

        $result = $this->prepareQuery($query);
        $this->executeQuery($result, $executeOptions);
        
        $response = $result->fetchAll(PDO::FETCH_ASSOC);
        
        if (sizeof($response) > 0) {
            return true;
        }
        return false;
    }

    //function to getResponse of a query @params query and options for the execute function
    public function getResponse(string $query, array $options = [])
    {
        $result = $this->prepareQuery($query);
        $this->executeQuery($result, $options);

        $response = $result->fetchAll(PDO::FETCH_ASSOC);
        
        if (sizeof($response) > 0) {
            return $response;
        }

        return null;
    }

    //destructor function
    public function __destruct()
    {
        $this->closeConnection();
    }
    // close database connection
    public function closeConnection()
    {
        if ($this->connected) {
            $this->connection = null;
            $this->connected = false;
        }
    }

    //show if database is connected or not
    public function isConnected()
    {
        return $this->connected;
    }
    //get connection status
    public function getConnectionStatus()
    {
        return $this->connection->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    }
    // get database connection
    public function getConnection()
    {
        return $this->connection;
    }

}
