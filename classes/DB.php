<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

class DB {

    var $result_id = NULL;
    var $result = NULL;

	function connect() {
	 	@mysql_connect('ambush2006.db.11283971.hostedresource.com', 'ambush2006', 'Velociter@1985') or die("Unable to connect to MySql Server");
	        @mysql_select_db('ambush2006') or die("Unable to select database");
	        return true;
	} 
//    function connect() {
//        @mysql_connect('localhost', 'root', '') or die("Unable to connect to MySql Server");
//        @mysql_select_db('ambush2006') or die("Unable to select database");
//        return true;
//    }

    function query($query) {
        /* echo $query; */
        if (!$query = mysql_query($query))
            echo mysql_error();
        return $query;
    }

    function insert($table, $fields) {
        return $this->query("INSERT INTO " . $table . " (" . implode(",", array_keys($fields)) . ") VALUES (" . "'" . implode("','", $fields) . "'" . ")");
    }

    function update($table, $values, $where) {
        $where = ($where == '') ? 1 : $where;
        foreach ($values as $keys => $value) {
            $fields .= ", " . $keys . "='" . $value . "'";
        }
        $this->query("UPDATE " . $table . " SET " . substr($fields, 1) . " WHERE " . $where . "");
        return $this->query("UPDATE " . $table . " SET " . substr($fields, 1) . " WHERE " . $where . "");
    }

    function _delete($table, $where) {
        $where = ($where == '') ? 1 : $where;

        return $this->query("DELETE FROM " . $table . " WHERE " . $where . "");
    }

    function count_all($table) {
        ($table <> '') ? $rowcount = mysql_fetch_object(mysql_query("SELECT COUNT(*) AS numrows FROM " . $table . "")) : $rowcount->numrows = "Table name doesn't exitst";
        return $rowcount->numrows;
    }

    function row_count($table, $where) {
        ($table <> '') ? $rowcount = mysql_fetch_object(mysql_query("SELECT COUNT(*) AS numrows FROM " . $table . " WHERE " . $where . "")) : $rowcount->numrows = "Table name doesn't exitst";
        return $rowcount->numrows;
    }

    function num_rows($result_id) {
        if (!$result_id = mysql_num_rows($result_id))
            echo mysql_error();
        return $result_id;
    }

    function data_seek($result_id, $n = 0) {
        return mysql_data_seek($result_id, $n);
    }

    function fetch_assoc($result_id) {
        return mysql_fetch_assoc($result_id);
    }

    function fetch_object($result_id) {
        return mysql_fetch_object($result_id);
    }

    function num_fields($result_id) {
        return @mysql_num_fields($result_id);
    }

    function row_object($table, $fields, $where) {
        $arrfields = array();
        $result = $this->select($table, $fields, $where);
        if ($row = $this->fetch_object($result)) {
            foreach ($fields as $value) {
                $arrfields = array_merge($arrfields, explode(',', preg_replace('/([A-Z]|[a-z]|[0-9]_[_])(.*)([, ]|[,])(.*)[) ]/', '', $value)));
            }
            foreach ($arrfields as $val) {
                $this->$val = $row->$val;
            }
        }
    }

    function row_array($table, $fields, $where) {
        $arrfields = array();
        $result = $this->select($table, $fields, $where);
        if ($row = $this->fetch_assoc($result)) {
            foreach ($fields as $value) {
                $arrfields = array_merge($arrfields, explode(',', preg_replace('/([A-Z]|[a-z]|[0-9]_[_])(.*)([, ]|[,])(.*)[) ]/', '', $value)));
            }
            foreach ($arrfields as $val) {
                $this->$val = $row[$val];
            }
        }
    }

    function select($table, $fields, $where) {
        (!is_array($table) && !is_array($fields)) ? die("Incorrect format") : '';
        $this->cnt = count($table);
        while (++$i <= $this->cnt) {
            $tablename = DB_PRIFIX . trim($table[($i - 1)]);
            $arrfields = explode(',', $fields[($i - 1)]);
            if (trim($fields[($i - 1)]) <> '') {
                foreach ($arrfields as $value) {
                    if (preg_match('/[^.]+\.[^.]+$/', $value)) {
                        $arrval = explode('.', $value);
                        $fieldnames .= "," . $arrval[0] . '.' . trim($arrval[1]);
                    } else {
                        $fieldnames .= "," . trim($value);
                    }
                }
            } else {
                $fieldnames = ' * ';
            }
            $tables .= "," . $tablename;
        }
        $where = (trim($where) <> '') ? trim($where) : 1;
        return $this->query("SELECT " . substr($fieldnames, 1) . " FROM " . substr($tables, 1) . " WHERE " . $where . "");
    }

    function insert_id() {
        return @mysql_insert_id();
    }

    function affected_rows() {
        return @mysql_affected_rows();
    }

    function free_result($result_id) {
        if (is_resource($result_id)) {
            mysql_free_result($result_id);
            $result_id = FALSE;
        }
    }

    function MemberLogData($arrayData, $message) {
        $myFile = '../uploads/log/log_members.txt';
        //return $this->query("INSERT INTO ".$table." (".implode(",", array_keys($fields)).") VALUES ("."'".implode("','", $fields)."'".")");
        $dateTime = date('Y-m-d H:i:s');
        $data = $message . implode(",", $arrayData);
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh, $dateTime . "\t");
        fwrite($fh, $data ."-". " BY " .$_SESSION['full_name']."{".($_SESSION['user_email'])."} {".($_SESSION['user_id'])."}". "\n");
//       
//       header('Content-Type: application/octet-stream');
//       header('Content-Disposition: attachment; filename='.basename('../uploads/log/log_members.txt'));
//      header('Expires: 0');
//      header('Cache-Control: must-revalidate');
//      header('Pragma: public');
//      header('Content-Length: ' . filesize('../uploads/log/log_members.txt')); 
//       readfile('../uploads/log/log_members.txt');
        fclose($fh);
       
    }
    
    
     function AgentLogData($arrayData, $message) {
        $myFile = '../uploads/log/log_agent.txt';
        //return $this->query("INSERT INTO ".$table." (".implode(",", array_keys($fields)).") VALUES ("."'".implode("','", $fields)."'".")");
        $dateTime = date('Y-m-d H:i:s');
        $data = $message . implode(",", $arrayData);
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh,  $dateTime . "\t");
        fwrite($fh, $data ."-". " BY " .$_SESSION['full_name']."{".($_SESSION['user_email'])."} {".($_SESSION['user_id'])."}". "\n");
        fclose($fh);
    }
    
    
    function ProviderLogData($arrayData, $message) {
        $myFile = '../uploads/log/log_provider.txt';
        //return $this->query("INSERT INTO ".$table." (".implode(",", array_keys($fields)).") VALUES ("."'".implode("','", $fields)."'".")");
        $dateTime = date('Y-m-d H:i:s');
        $data = $message . implode(",", $arrayData);
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh,  $dateTime . "\t");
        fwrite($fh, $data ."-". " BY " .$_SESSION['full_name']."{".($_SESSION['user_email'])."} {".($_SESSION['user_id'])."}". "\n");
        fclose($fh);
    }
    
    function UserLogData($arrayData, $message) {
        $myFile = '../uploads/log/log_user.txt';
        //return $this->query("INSERT INTO ".$table." (".implode(",", array_keys($fields)).") VALUES ("."'".implode("','", $fields)."'".")");
        $dateTime = date('Y-m-d H:i:s');
        $data = $message . implode(",", $arrayData);
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh,  $dateTime . "\t");
        fwrite($fh, $data ."-". " BY " .$_SESSION['full_name']."{".($_SESSION['user_email'])."} {".($_SESSION['user_id'])."}". "\n");
        fclose($fh);
    }
    
  
}
    
  

?>