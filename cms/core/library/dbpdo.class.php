<?php
if (!defined('IN_XIAOCMS')) exit();

class dbpdo
{

    protected static $_instance = null;
    protected $_dbLink = null;
    protected $_query = null;

    public function __construct($params = array())
    {
        if (!$params['dsn']) return false;
        try {  
              $flags = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8';", PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION);
              $this->_dbLink = new PDO($params['dsn'], $params['username'], $params['password'], $flags);
        } catch (PDOException $e) {  
              exit('XiaoCms提示您：数据库连接错误！错误信息：'.$e->getMessage());  
        }
 		$version = $this->getServerVersion();
		if($version > '5.0') $this->_dbLink->exec("SET sql_mode=''");
        if(version_compare(PHP_VERSION,'5.3.6','<=')){
           $this->_dbLink->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return true;
    }

    public function query($sql, $params = array())
    {
        if (!$sql) return false;
        if (!is_array($params) && isset($params)) {
            $params = func_get_args();
            array_shift($params);
        }
        $result = $this->_execute($sql, $params);
        if (!$result) {
            $result->closeCursor();
            $this->_query = null;
            return $this;
        }
        $this->_query = $result;
        return $this;
    }

    public function execute($sql, $params = null)
    {
        if (!$sql) return false;
        $sql = trim($sql);
        if (!is_array($params) && isset($params)) {
            $params = func_get_args();
            array_shift($params);
        }
        $sth = $this->_dbLink->prepare($sql);
        if (!$params) {
            $result = $sth->execute();
        } else {
            $result = $sth->execute($params);
        }
        if (!$result) {
            $sth->closeCursor();
            return false;
        }
        return true;
    }

    public function fetchRow($model = PDO::FETCH_ASSOC)
    {
        if (!$model) return false;
        if (!$this->_query) return false;
        $myrow = $this->_query->fetch($model);
        $this->_query->closeCursor();
        $this->_query = null;
        return $myrow;
    }

    public function fetchAll($model = PDO::FETCH_ASSOC)
    {
        if (!$model) return false;
        if (!$this->_query) return false;
        $myrow = $this->_query->fetchAll($model);
        $this->_query->closeCursor();
        $this->_query = null;
        return $myrow;
    }

    public function getOne($sql, $params = array())
    {
        if (!$sql) return false;
        if (!is_array($params) && isset($params)) {
            $params = func_get_args();
            array_shift($params);
        }
        $result = $this->_execute($sql, $params);
        if (!$result) {
            $result->closeCursor();
            return false;
        }
        $myrow = $result->fetch(PDO::FETCH_ASSOC);
        $result->closeCursor();
        return $myrow;
    }

    public function getAll($sql, $params = array())
    {
        if (!$sql) return false;
        if (!is_array($params) && isset($params)) {
            $params = func_get_args();
            array_shift($params);
        }
        $result = $this->_execute($sql, $params);
        if (!$result) {
            $result->closeCursor();
            return false;
        }
        $myrow = $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
        return $myrow;
    }

    protected function _execute($sql, $params = array())
    {
        $sql = trim($sql);
        $sth = $this->_dbLink->prepare($sql);
        if (!$params) {
            $result = $sth->execute();
        } else {
            $result = $sth->execute($params);
        }
        if (!$result) {
            $sth->closeCursor();
            return false;
        }
        return $sth;
    }

    public function lastInsertId()
    {
        return $this->_dbLink->lastInsertId();
    }

    public function getServerVersion()
    {
        return $this->_dbLink->getAttribute(PDO::ATTR_SERVER_VERSION);
    }

    public function escape($value = null)
    {
        if (is_null($value)) return null;
        if (!is_array($value)) {
            return trim($this->_dbLink->quote($value));
        }
        return array_map(array($this, 'escape'), $value);
    }

    public function insert($tableName, $data, $returnId = false)
    {
        if (!$tableName || !$data || !is_array($data)) return false;
        $contentArray = array_values($data);
        $fieldString = implode(',', array_keys($data));
        $contentString = rtrim(str_repeat('?,', count($contentArray)), ',');
        $sql = "INSERT INTO {$tableName} ({$fieldString}) VALUES ({$contentString})";
        $reulst = $this->execute($sql, $contentArray);
        unset($fieldString, $contentString, $contentString);
        if ($reulst && $returnId === true) {
            return $this->lastInsertId();
        }
        return $reulst;
    }

    public function replace($tableName, $data)
    {
        if (!$tableName || !$data || !is_array($data)) return false;
        $contentArray = array_values($data);
        $fieldString = implode(',', array_keys($data));
        $contentString = rtrim(str_repeat('?,', count($contentArray)), ',');
        $sql = "REPLACE INTO {$tableName} ({$fieldString}) VALUES ({$contentString})";
        $reulst = $this->execute($sql, $contentArray);
        unset($fieldString, $contentString, $contentString);
        return $reulst;
    }

    public function update($tableName, $data, $where, $value = array())
    {
        if (!$tableName || !$where || !$data || !is_array($data)) return false;
        $fieldArray = array_keys($data);
        $contentString = implode('=?,', $fieldArray) . '=?';
        $params = array_values($data);
        if ($value) {
            if (!is_array($value)) {
                array_push($params, $value);
            } else {
                $params = array_merge($params, $value);
            }
        }
        $sql = "UPDATE {$tableName} SET {$contentString} WHERE {$where}";
        $reulst = $this->execute($sql, $params);
        unset($fieldArray, $contentString, $params);
        return $reulst;
    }

    public function delete($tableName, $where, $value = array())
    {
        if (!$tableName || !$where) return false;
        if ($value && !is_array($value)) $value = array($value);
        $sql = "DELETE FROM {$tableName} WHERE {$where}";
        return $this->execute($sql, $value);
    }

    public function getTableInfo($tableName, $extItem = false)
    {
        if (!$tableName) return false;
        $fieldList = $this->getAll("SHOW FIELDS FROM {$tableName}");
        if ($extItem === true) return $fieldList;
        $primaryArray = array();
        $fieldArray = array();
        foreach ($fieldList as $lines) {
            if ($lines['Key'] == 'PRI') {
                $primaryArray[] = $lines['Field'];
            }
            $fieldArray[] = $lines['Field'];
        }
        return array('primaryKey' => $primaryArray, 'fields' => $fieldArray);
    }

    public function getTableList()
    {
        $dbList = $this->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        if (!$dbList) return array();
        return array_values($dbList);
    }

    public function __destruct()
    {
        if (isset($this->_dbLink)) {
            $this->_dbLink = null;
        }
        return true;
    }

    public static function getInstance($params = array())
    {
        if (!self::$_instance) {
            self::$_instance = new self($params);
        }
        return self::$_instance;
    }

}