<?php

class DB {
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_count = 0;
    public  $_results;

    public function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host='. Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }

        return self::$_instance;
    }

    public function query($sql, $params = []) {
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
                var_dump($this->_query->errorInfo());
            }
        }
        return $this;
    }

    public function action($action, $table, $where = []) {
        if(is_array($where[0])) {
            $sql = "{$action} FROM {$table} WHERE ";
            for ($i=0; $i<count($where);$i++) {
                if(count($where[$i]) == 3) {
                    $operators = ['=', '>', '<', '>=', '<='];
        
                    $field      = $where[$i][0];
                    $operator   = $where[$i][1];
                    $value      = $where[$i][2];
        
                    if(in_array($operator, $operators)) {
                        if($i == (count($where) - 1)) {
                            $sql = $sql . "{$field} {$operator} ?";
                        } else {
                            $sql = $sql . "{$field} {$operator} ? AND ";
                        }
                            
                    }
                    $value_arr[] = $value; 
                }
            }


            if(!$this->query($sql, $value_arr)->error()) {
                return $this;
            } else {
                echo $this->query($sql, $value_arr)->errorInfo();
                echo "oops you've done something wrong";
            }
        } else {
            if(count($where) == 3) {
                $operators = ['=', '>', '<', '>=', '<='];
    
                $field      = $where[0];
                $operator   = $where[1];
                $value      = $where[2];
    
                if(in_array($operator, $operators)) {
                    $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                    if(!$this->query($sql, [$value])->error()) {
                        return $this;
                    } else {
                        echo "oops you've done something wrong";
                    }
                }
            }
        }
        return false;
    }

    public function get($table, $where) {
        return $this->action('SELECT *', $table, $where);
    }

    public function rawMySQL($mySQL) {
        return $this->query($mySQL);
    }
    
    public function getMax($table, $where) {
        return $this->action('SELECT MAX('.$where[0].')',$table,$where);
    }

    // public function getAllFromTable($table, $orderField) {
    //     return $this->query("SELECT * ". "from `". $table . "`" ." where 1 order by " . $orderField . " desc LIMIT 50");
    // }

    public function getAllFromTable($table, $orderField, $direction, $count) {
        return $this->query(
            "SELECT * ". "from `". $table . "`" ." where 1 order by " . $orderField . " " . $direction . " LIMIT " . $count
        );
    }

    public function delete($table, $where) {
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $fields = []) {
        $keys = array_keys($fields);
        $values = '';
        $x = 1;

        foreach($fields as $field) {
            if (!is_Numeric($field)) {
                $values .='"';
                $values .= $field;
                $values .='"';
            } else {
                $values .= $field;
            }
            if($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO `". $table ."` (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        } else {
            echo("error: ");
            echo($this->query($sql, $fields)->error());
        }

        return false;
    }

    public function update($table, $id, $fields = []) {
        $set = '';
        $x = 1;

        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE u_id = {$id}";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        } else {
            echo("error: ");
            echo($this->query($sql, $fields)->error());
        }

        return false;
    }

    public function results() {
        return $this->_results;
    }

    public function first() {
        return $this->results()[0];
    }

    public function error() {
        return $this->_error;
    }

    public function count() {
        return $this->_count;
    }

}


?>
