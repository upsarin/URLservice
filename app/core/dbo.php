<?php
/**
 * DBConnect Класс для работы с базой данных
 */
 
 
/**
 * Class DBConnect
 */
class DBConnect {
    private static $_instance = NULL;
    private $_conn;
 
    private $_connect = array(
        'host' => 'localhost',
        'port' => '3306',
        'user' => 'searchsiru',
        'pass' => 'love070691',
        'name' => 'searchsiru',
        'charset' => 'utf8',
        'debug' => true
    );
 
    private function __construct($connect)
    {
        $this->_connect = array_merge($this->_connect, $connect);
        try {
            $this->_conn = new PDO(
                'mysql:dbname='.$this->_connect['name'].';host='.$this->_connect['host'].';port='.$this->_connect['port'],
                $this->_connect['user'],
                $this->_connect['pass']
            );
 
            $this->_conn->exec('SET NAMES '.$this->_connect['charset']);
            if($this->_connect['debug']) {
                $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $e) {
            throw new Exception('Подключение к БД не удалось: ' . $e->getMessage());
        }
	
    }
 

    public static function init($connect = array())
    {
        if(self::$_instance === NULL) {
            self::$_instance = new DBConnect($connect);
        }
        return self::$_instance;
    }
 

	public function Delete($where, $table){
		foreach($where as $key => $val){
			$sql = 'DELETE FROM `'. $table .'` WHERE `'. $key .'`=:'. $key .' LIMIT 1';
			$sth = $this->_conn->prepare($sql);
			$sth->bindValue(':' .$key, $val);
			$sth->execute();
		}
	}
	public function saveField($field)
	{
		$keys = "(";
		$vals = "(";
		$cur_num = 0;
		
			foreach($field as $key => $val){
				if($cur_num == 0){
					$keys .= '`'. $key .'`';
					$vals .= ":" .$key;
				} else {
					$keys .= ', `' .$key .'`';
					$vals .= ", :" .$key;
				}
				$cur_num = $cur_num + 1;
			}
		
		$keys .= ")";
		$vals .= ")";
		
		$sql = "INSERT `fields` ". $keys ." VALUES ". $vals;
		$main = $this->_conn->prepare($sql);
		foreach($field as $key => $val){
			$main->bindValue(':' .$key, $val);
		}
		
		if($main->execute()){
			$result = true;
		} else {
			$result = "error"; 
		}
	}
	public function saveElements($array, $table=null)
	{
		
		
		if(count($array) == 1){
			
				// main fields
				$keys = "(";
				$vals = "(";
				$cur_num = 0;
				
				foreach($array[0]['main'] as $key => $val){
					if($cur_num == 0){
						$keys .= '`'. $key .'`';
						$vals .= ":" .$key;
					} else {
						$keys .= ", `" .$key .'`';
						$vals .= ", :" .$key;
					}
					$cur_num = $cur_num + 1;
				}
				if(isset($array[0]['iblock_name']) && !empty($array[0]['iblock_name'])){
					$table = $array[0]['iblock_name'];
				} else if($table != null){
					$table = $table;
				} else {
					$table = "content";
				}
				$keys .= ")";
				$vals .= ")";
				$sql = "INSERT `". $table ."` ". $keys ." VALUES ". $vals;
				$main = $this->_conn->prepare($sql);
				foreach($array[0]['main'] as $key => $val){
					$main->bindValue(':' .$key, $val);
				}
				
				if($main->execute()){
					$result = true;
				} else {
					$result = "error"; 
				}
				$id = $this->_conn->lastInsertId();
				// end main fields
				
				
				//start alter fields
				if(isset($array[0]['alter']) && !empty($array[0]['alter'])){
					foreach($array[0]['alter'] as $key => $val){
						if(!empty($val)){
							$sql = "INSERT `field_value` (`value`, `element_id`, `code`) VALUES (:value, :element_id, :code)";
							$alter = $this->_conn->prepare($sql);
							$alter->bindValue(':value', $val);
							$alter->bindValue(':element_id', $id);
							$alter->bindValue(':code', $key);  
							$alter->execute();
						}
					} 
				}
			
			//end alter fields
			return $result;
		}
        
	}
	public function SaveElementsWithImages($array)
	{
		if(count($array) == 1){
			
				// main fields
				$keys = "(";
				$vals = "(";
				$cur_num = 0;
				
				foreach($array[0]['main'] as $key => $val){
					if($cur_num == 0){
						$keys .= '`'. $key .'`';
						$vals .= ":" .$key;
					} else {
						$keys .= ", `" .$key .'`';
						$vals .= ", :" .$key;
					}
					$cur_num = $cur_num + 1;
				}
				if(isset($array[0]['iblock_name']) && !empty($array[0]['iblock_name'])){
					$table = $array[0]['iblock_name'];
				} else {
					$table = "content";
				}
				$keys .= ")";
				$vals .= ")";
				$sql = "INSERT `". $table ."` ". $keys ." VALUES ". $vals;
				
				$main = $this->_conn->prepare($sql);
				foreach($array[0]['main'] as $key => $val){
					$main->bindValue(':' .$key, $val);
				}
				
				if($main->execute()){
					$result = true;
				} else {
					$result = "error"; 
				}
				$id = $this->_conn->lastInsertId();
				// end main fields
				
				
				//start alter fields
				
				if(isset($array[0]['alter']) && !empty($array[0]['alter']) && $result == true){
					foreach($array[0]['alter'] as $key => $val){
						if(!empty($val)){
							$sql = "INSERT `field_value` (`value`, `element_id`, `code`) VALUES (:value, :element_id, :code)";
							$alter = $this->_conn->prepare($sql);
							$alter->bindValue(':value', $val);
							$alter->bindValue(':element_id', $id);
							$alter->bindValue(':code', $key);  
							$alter->execute();
						}
					} 
				}
			
			//end alter fields
			$returnData['confirm'] = $result;
			$returnData['id'] = $id;
			
			return $returnData;
		}
        
	}
	
	public function emptyFieldSaveEdit($id, $code, $value){
		
				if(!empty($value)){
					$sql = "INSERT `field_value` (`value`, `element_id`, `code`) VALUES (:value, :element_id, :code)";
					$alter = $this->_conn->prepare($sql);
					$alter->bindValue(':value', $value);
					$alter->bindValue(':element_id', $id);
					$alter->bindValue(':code', $code);  
					$alter->execute();
					return true;
				} else {
					return false;
				}
			 
		
	}
	
	public function saveFileData($array)
	{
		
		if(count($array) == 1){
			
				// main fields
				$keys = "(";
				$vals = "(";
				$cur_num = 0;
				
				foreach($array[0] as $key => $val){
					if($cur_num == 0){
						$keys .= '`'. $key .'`';
						$vals .= ":" .$key;
					} else {
						$keys .= ", `" .$key .'`';
						$vals .= ", :" .$key;
					}
					$cur_num = $cur_num + 1;
				}
				$table = "files";
				$keys .= ")";
				$vals .= ")";
				$sql = "INSERT `". $table ."` ". $keys ." VALUES ". $vals;
				$main = $this->_conn->prepare($sql);
				foreach($array[0] as $key => $val){
					$main->bindValue(':' .$key, $val);
				}
				
				if($main->execute()){
					$result = true;
				} else {
					$result = "error"; 
				}
				$id = $this->_conn->lastInsertId();
				// end main fields
				
				
				//start alter fields
				
				
			
			//end alter fields
			$returnData['confirm'] = $result;
			$returnData['id'] = $id;
			
			return $returnData;
		}
        
	}
	public function selectPage($params = NULL, $id = NULL, $filter = NULL)
	{
		if(isset($params) && !empty($params)){
			$where = "where (`name` = ?)";
		}
		if(isset($id) && !empty($id)){ 
			$where = "where (`id` = ?)";
		}
		
		if(isset($filter) && !empty($filter)){
			$where = "where (`name` = ?)";
		}
		
		$sql = "SELECT * FROM `pages` ". $where;
		//$sql = "SELECT * FROM `pages` where (`name` = ?)";
		$sth = $this->_conn->prepare($sql);
		if(isset($params) && !empty($params)){
			$sth->execute([$params]);
		}
		if(isset($id) && !empty($id)){ 
			$sth->execute([$id]);
		} 
		if(isset($filter) && !empty($filter)){
			$sth->execute([$filter]);
		}
        
        return $sth->fetch(PDO::FETCH_ASSOC);
	}
	
	public function selectAll($table, $filter=null, $limits=null, $params=NULL, $fixed=null){
		if($filter != null){
			$where = "where (";
			$cur_param = 0;
			foreach ($filter as $key => $val){
				if($cur_param == 0){
					if($key == 'name' && (!empty($_SESSION['user']['filter']['name']))){
						$where .= "(`". $key ."` LIKE :". $key .")";
					} else {
						$where .= "(`". $key ."` = :". $key .")";
					}
					
				} else {
					if($key == 'name' && (!empty($_SESSION['user']['filter']['name']))){
						$where .= " AND (`". $key ."` LIKE :". $key .")";
					} else {
						$where .= " AND (`". $key ."` = :". $key .")";
					}
				}
				$cur_param = $cur_param + 1;
			}
			$where .= ")";
		} else {
			$where = 'where (`id` != :id)';
			$filter = array('id' => 0);
		}
		if($params != "Y"){
			if($table == 'pages'){
				$where = 'where (`model` != :model)';
				$filter = array('model' => 'administrator');
			}
		}
		if($limits != null){
			$limit = ' LIMIT '. $limits['limit_from'] .', '. $limits['limit_to'] .'';
		} else {
			$limit = '';
		}
		if($table == "shortlink"){
			$sort = "order by id desc";
		} else {
			$sort = "";
		}
		$sql = "SELECT * FROM `". $table ."` ". $where ."". $sort ."". $limit;
		
		$sth = $this->_conn->prepare($sql);		
		foreach ($filter as $key => $val){
			$sth->bindValue(':'. $key, $val);
		}
		
		$sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
	}
	
	public function countElements($page_id=null, $table=null, $filter=null)
	{
		
		$cur_param = 0;
		if($page_id != null){
			$where = "where (`page_id` = :page_id)";
		} else if($filter != null){
			$where = "where (";
			$cur_param = 0;
			foreach ($filter as $key => $val){
				if($cur_param == 0){
					$where .= "(`". $key ."` = :". $key .")";
				} else {
					$where .= " AND (`". $key ."` = :". $key .")";
				}
				$cur_param = $cur_param + 1;
			}
			$where .= ")";
		}
		if($table == null) {
			$table = "content";
		}
		$sql = "SELECT id FROM `". $table ."` ". $where;
		
		$sth = $this->_conn->prepare($sql);
		if($page_id != null){
			$sth->bindValue(':page_id',$page_id);
		} else if($filter != null) {
			foreach ($filter as $key => $val){
				$sth->bindValue(':'. $key, $val);
			}
		}
		
		$sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return count($result);
	}
	
	public function getModules($pos = NULL, $page = NULL, $chain = NULL) 
	{	
		if(($chain != NULL) && !empty($chain)){
			if(count($chain) > 1){
				$cur_param = 0;
				$where = "where (";
				foreach($chain as $key => $val){
					if($cur_param == 0){
						$where .= "(`id` = ". $val .")";
					} else {
						$where .= " OR (`id` = ". $val .")";
					}
					$cur_param = $cur_param + 1;
				}
				$where .= ")";
			} else {
				$where = "where (`id` = ". $chain[0] .")";
			}
		} else {
			$where = "where (`pos` = :pos)";
		}
		$sql = "SELECT * FROM `modules` ". $where;
		//$sql = "SELECT * FROM `pages` where (`name` = ?)";
		$sth = $this->_conn->prepare($sql);
		if(!isset($chain) && empty($chain)){
			$sth->bindValue(':pos',$pos);
		}
		
        $sth->execute();
		if(isset($chain) && !empty($chain)){
			return $sth->fetchAll(PDO::FETCH_ASSOC);
		} else {
			return $sth->fetch(PDO::FETCH_ASSOC);
		}
	}
	
	public function selectContent($page, $filter, $fields = NULL, $limits=null)
	{
		$where = "where(";
		$where .= "(`page_id` = :page)";
		//пустить foreach $filter
		$cur_param = 0;
		if($filter != NULL && is_array($filter)){
			
			foreach($filter as $key => $val){
				
				if($key == "cat" && is_array($filter[$key])){
					$cat_param = 0;
					
					foreach($val as $cat_key => $cat_val){
						if($cat_param == 0){
							$where .= " AND (";
							$where .= "(`". $key ."` = :cat". $cat_key .")";
						} else {
							$where .= " OR ";
							$where .= "(`". $key ."` = :cat". $cat_key .")";
						}
						$cat_param = $cat_param + 1;
					}
					$where .= ") ";
				} else {
					$where .= " AND ";
					if($key == 'name' && (!empty($_SESSION['user']['filter']['name']))){
						$where .= "(`". $key ."` LIKE :". $key .")";
					} else {
						$where .= "(`". $key ."` = :". $key .")";
					}
				}
				$cur_param = ++$cur_param;
			}
		}
		//end filter
		$where .= ")";
		if($limits != null){
			$limit = ' LIMIT '. $limits['limit_from'] .', '. $limits['limit_to'] .'';
		} else {
			$limit = '';
		}
		$sql = "SELECT * FROM `content` ". $where ." ". $limit;
		//$sql = "SELECT * FROM `pages` where (`name` = ?)";
		$sth = $this->_conn->prepare($sql);
		$sth->bindValue(':page',$page);
		//filter
		foreach($filter as $key => $val){
			if($key == "cat" && is_array($filter[$key])){
				foreach($val as $cat_key => $cat_val){
					$sth->bindValue(':cat' .$cat_key, $cat_val);
				}
			} else {
				$sth->bindValue(':' .$key, $val);
			}
			
		}
		
		//end filter
        $sth->execute();
		$content = $sth->fetchAll(PDO::FETCH_ASSOC);
		
        return $content;
	}
	
	public function selectByID($id, $table=null)
	{
		if(isset($id) && !empty($id) && ($id != NULL)){
			$where = "where(";
			$where .= "`id` = :id";
			$where .= ")";
			$sql = "SELECT * FROM ". $table ." ". $where;
			
			$sth = $this->_conn->prepare($sql);
			$sth->bindValue(':id', $id);
			$sth->execute();
			$content = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $content;
		}
	}
	public function selectByName($name, $table=null)
	{
		if(isset($name) && !empty($name) && ($name != NULL)){
			$where = "where(";
			$where .= "`name` = :name";
			$where .= ")";
			$sql = "SELECT * FROM ". $table ." ". $where;
			
			$sth = $this->_conn->prepare($sql);
			$sth->bindValue(':name', $name);
			$sth->execute();
			$content = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $content;
		}
	}
	public function selectOne($alias = NULL, $filter = NULL, $fields = NULL, $table = NULL)
	{
		if($table == NULL) {
			$table = "content";
		}
		$where = "where(";
		if(isset($alias) && !empty($alias) && ($alias != NULL)){
			$where .= "(`alias` = :alias)";
		}
		//пустить foreach $filter
		$cur_param = 0;
		if($filter != NULL && is_array($filter)){
			foreach($filter as $key => $val){
				$where .= " AND ";
				$where .= "(`". $key ."` = :". $key .")";
				$cur_param = ++$cur_param;
			}
		}
		//end filter
		$where .= ")";
		$sql = "SELECT * FROM `". $table ."` ". $where;
		//$sql = "SELECT * FROM `pages` where (`name` = ?)";
		$sth = $this->_conn->prepare($sql);
		$sth->bindValue(':alias',$alias);
		//filter
		if($filter != NULL && is_array($filter)){
			foreach($filter as $key => $val){
				$sth->bindValue(':' .$key, $val);
			}
		}
		
		//end filter
        $sth->execute();
		$content = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $content;
	}
	
	public function getMemu($type, $params, $table=null)
	{
		if($type == 'menu'){
			$table = "pages";
		} else if($type == "cats"){
			$table = "cats";
		}
		$where = "where(";
		$cur_param = 0;
		
		foreach($params as $key => $val){
			if($cur_param != 0){
				$where .= " AND ";
			}
			$where .= "(`". $key ."` = :". $key .")";
			$cur_param = ++$cur_param;
		}
		$where .= ")";
		$sql = "SELECT * FROM `". $table ."` ". $where;
		//$sql = "SELECT * FROM `pages` where (`name` = ?)";
		$sth = $this->_conn->prepare($sql);
		foreach($params as $key => $val){
			$sth->bindValue(':' .$key, $val);
		}
		
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC); 
	}
	
	public function getFeilds($params=null, $sort=null)
	{
		
		$where = "where(";
		$cur_param = 0;
		
		foreach($params as $key => $val){
			if($cur_param != 0){
				$where .= " AND ";
			}
			$where .= "(`". $key ."` = :". $key .")"; 
			$cur_param = ++$cur_param;
		}
		if(isset($sort) && !empty($sort)){
			$sort = " order by ". $sort[0] ." ". $sort[1];
		} else {
			$sort = " order by sort asc";
		}
		$where .= ")";
		$sql = "SELECT * FROM `fields` ". $where.$sort ;
		//$sql = "SELECT * FROM `pages` where (`name` = ?)";
		$sth = $this->_conn->prepare($sql);
		foreach($params as $key => $val){
			$sth->bindValue(':' .$key, $val);
		}
		
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getFeildsValues($params=null, $sort=null, $table=null)
	{
		
		$where = "where(";
		$cur_param = 0;
		
		foreach($params as $key => $val){
			if($cur_param != 0){
				$where .= " AND ";
			}
			$where .= "(`". $key ."` = :". $key .")"; 
			$cur_param = ++$cur_param;
		}
		if(isset($sort) && !empty($sort)){
			$sort = " order by ". $sort[0] ." ". $sort[1];
		} else {
			$sort = " order by sort asc";
		}
		$where .= ")";
		$sql = "SELECT * FROM `". $table ."` ". $where ;
		//$sql = "SELECT * FROM `pages` where (`name` = ?)";
		$sth = $this->_conn->prepare($sql);
		foreach($params as $key => $val){
			$sth->bindValue(':' .$key, $val);
		}
		
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	public function updateElements($params, $upd_array, $table){
		$where = "where(";
		$cur_param = 0;
		
		foreach($params as $key => $val){
			if($cur_param != 0){
				$where .= " AND ";
			}
			$where .= "(`". $key ."` = ". $val .")";
			$cur_param = ++$cur_param;
		}
		$where .= ")";
		$cur_param = 0;
		foreach($upd_array as $key => $val){
			if($key != 'del'){
				if($cur_param != 0){
					$set .= ", `". $key ."` = '". $val ."'";
				} else {
					$set = "`". $key ."` = '". $val ."'";
				}
				$cur_param = ++$cur_param; 
			}
		} 
		$sql = "UPDATE ". $table ." SET ". $set ." ". $where ;
		
		$sth = $this->_conn->prepare($sql);
        if($sth->execute()){
			$mess['mess'] = "Успешное изменения";
		} else {
			$mess['mess'] = false;
			$mess['error'] = 'Произошла ошибка при обновлении данных';
		}
		return $mess;
	}
	public function upd_user($params, $upd_array){
		$where = "where(";
		$cur_param = 0;
		
		foreach($params as $key => $val){
			if($cur_param != 0){
				$where .= " AND ";
			}
			$where .= "(`". $key ."` = ". $val .")";
			$cur_param = ++$cur_param;
		}
		$where .= ")";
		$cur_param = 0;
		foreach($upd_array as $key => $val){
			if($cur_param != 0){
				$set .= ", `". $key ."` = '". $val ."'";
			} else {
				$set = "`". $key ."` = '". $val ."'";
			}
			$cur_param = ++$cur_param;
		} 
		$sql = "UPDATE users SET ". $set ." ". $where ;
		
		$sth = $this->_conn->prepare($sql);
        if($sth->execute()){
			$mess['mess'] = true;
		} else {
			$mess['mess'] = false;
			$mess['error'] = 'Произошла ошибка при обновлении данных аккаунта';
		}
		return $mess;
		
	}
	
	public function get_user($col = null, $params, $sort = null)
	{
		$where = "where(";
		$cur_param = 0;
		
		foreach($params as $key => $val){
			if($cur_param != 0){
				$where .= " AND ";
			}
			$where .= "(`". $key ."` = :". $key .")";
			$cur_param = ++$cur_param;
		}
		$where .= ")";
		if(isset($sort) && !empty($sort)){
			$sort = " order by ". $sort[0] ." ". $sort[1];
		} else {
			$sort = " order by id asc";
		}
		if(count($col)>0){
			
			for($j=0; $j<count($col); ++$j){
				if($j != 0){
					$cols .= ",". $col[$j];
				} else {
					$cols = $col[$j];
				}
			}
		} else {
			$cols = "*";
		}
		
		$sql = "SELECT ". $cols ." FROM users ". $where.$sort ;
		$sth = $this->_conn->prepare($sql);
		foreach($params as $key => $val){
			$sth->bindValue(':'. $key, $val);
		}
				
		
        $sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result;
		
	}
	
	public function register_user($params, $alter=null)
	{	
			// подготовка параметров и полей для првоерки
		$check_params = array("login" => $params['login'], "email" => $params['email']);
		foreach($check_params as $key => $val){
			$check[$key] = $this->get_user(array($key), array($key => $val));
		}
		
		$reg = true;
			//проверка на существование основных значей в БД
		if(isset($check['login'][0])){	
			if(in_array($params['login'], $check['login'][0])){
				$mess = "Такой логин уже существует! <a href='javascript:void(window.history.back())'>назад</a>";
				
				$reg = false;
			}
		}
		if(isset($check['email'][0])){
			if(in_array($params['email'], $check['email'][0])){
				$mess = "Такой email уже существует! <a href='javascript:void(window.history.back())'>назад</a>";
				$reg = false;
			}
		}
		
		if($reg == true) { // если нету совпадений производим регистрацию
			if(isset($params['active']) && !empty($params['active'])){
				if($params['active'] == 'N'){
					$keys = "(`active`";
					$binds = "('N'";
					unset($params['active']);
				} else {
					$keys = "(`active`";
					$binds = "('Y'";
					unset($params['active']);
				}
			} else {
				$keys = "(`active`";
				$binds = "('N'";
				unset($params['active']);
			}
			
			
			$params['password'] = md5($params['password']);
			
			foreach($params as $key => $val){
				if($key != "action" && $key != "module" && $key != "send" && $key != "check_password" && $key != "PHPSESSID") {
						$keys .= ",`". $key ."`";
						$binds .= ", '". $val ."'";
				}
			}
			$keys .= ")";
			$binds .= ")";
			
			$sql = "INSERT users ". $keys ." VALUES ". $binds;
			
			$sth = $this->_conn->prepare($sql);
			
			if($sth->execute()){
				$mess = "ok";
			} else {
				$mess = "error";
			}
			$id = $this->_conn->lastInsertId();
			if(isset($alter) && count($alter) > 0){
				if(isset($alter) && !empty($alter)){
					foreach($alter as $key => $val){
						if(!empty($val)){
							$sql = "INSERT `field_value` (`value`, `element_id`, `iblock`, `code`) VALUES (:value, :element_id, :iblock, :code)";
							$alter = $this->_conn->prepare($sql);
							$alter->bindValue(':value', $val);
							$alter->bindValue(':element_id', $id);
							$alter->bindValue(':iblock', 'users');
							$alter->bindValue(':code', $key);  
							$alter->execute();
						}
					} 
				}
			}
		}
		
        return $mess;
	}
	
	public function send_email($mail) 
	{
			
		/* получатели */
		$to= $mail['name'] ."<". $mail['email'] .">" . ", " ; //обратите внимание на запятую
		

		/* тема/subject */
		$subject = $mail['subject'];

		/* сообщение */
		$message = $mail['message'];

		/* Для отправки HTML-почты вы можете установить шапку Content-type. */
		$headers= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";

		/* дополнительные шапки */
		$headers .= "From: ". $_SERVER['HTTP_HOST'] ." <protobox@info.ru>\r\n";
		//$headers .= "Cc: birthdayarchive@example.com\r\n";
		//$headers .= "Bcc: birthdaycheck@example.com\r\n";

		/* и теперь отправим из */
		mail($to, $subject, $message, $headers);
	}
	
    public function __destruct()
    {
        $this->_conn = NULL;
    }
} 