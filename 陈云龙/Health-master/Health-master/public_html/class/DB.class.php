<?php

/**
 * 封装对数据库的操作
 *
 * @author cylong
 * @version 2015-12-01
 */

class DB {
    private $dbName = DB_NAME;
    private $sqlite3;
    public function __construct() {
        $this->sqlite3 = new sqlite3($this->dbName);
    }

    /**
	 * 执行dql语句(select), 直接返回结果集
	 */
	public function execute_dql($sql) {
		$res = $this->sqlite3->query($sql);
		return $res;
	}

    /**
	 * 执行dql语句(select),将结果集以数组的形式返回
	 */
	public function execute_dql_arr($sql) {
		$res = $this->sqlite3->query($sql);
		$row = $res->fetchArray();
		$arr = array ();
		while($row) {
			$arr[] = $row;
			$row = $res->fetchArray();
		}
		return $arr;
	}

    /**
	 * 执行dml数据操作 update insert delete
	 */
	public function execute_dml($sql) {
		$bool = $this->sqlite3->exec($sql);
        return $bool;
	}

}
?>
