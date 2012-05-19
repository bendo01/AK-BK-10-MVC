<?php
class Model{
	var $dbh;
	var $userName;
	var $password;
	var $dbDriver;
	var $dbHost;
	var $dbName;
	var $tableName;
	
	function __construct( $userName, $password, $dbDriver, $dbHost, $dbName){
		$this->userName = $userName;
		$this->password = $password;
		$this->dbDriver = $dbDriver;
		$this->dbHost = $dbHost;
		$this->dbName = $dbName;
		
		$this->dbh = new PDO("$this->dbDriver:host=$this->dbHost;dbname=$this->dbName",$this->userName,$this->password);
	}
	
	public function myArrayToString($arrays = null){
		if(!empty($arrays)){
			$stringSQL = '';
			$i = count($arrays);
			foreach($arrays as $array){
				$stringSQL.= $array;
				if($i != 1){
						$stringSQL.= ', ';
				}
				$i--;
			}
			return $stringSQL;
		}
		else{
			return false;
		}
	}
	
	public function arraySQLConditionsToString($arraySQL = array()){
		if(!empty($arraySQL)){
			$stringSQL = '';
			//remove last condition
			$length = count($arraySQL['conditions']);
			//echo $length;
			unset($arraySQL['conditions'][$length-1]['next_operator']);
			//change to string
			foreach($arraySQL['conditions'] as $arrSQL){
				$stringSQL .= $arrSQL['field'];
				$stringSQL .= $arrSQL['operator'];
				$stringSQL .= "'".$arrSQL['value']."'";
				if(!empty($arrSQL['next_operator'])){
					$stringSQL .= ' '.$arrSQL['next_operator'].' ';
				}
			}
			return $stringSQL;
		}
		else{
			return false;
		}
	}
	
	public function selectData($tableName = null){
		if(!empty($tableName)){
			$this->tableName = $tableName;
			$sth = $this->dbh->query('describe '.$this->tableName);
			$results = $sth->fetchAll(PDO::FETCH_OBJ);
			$i=0;
			$dataFields = array();
		
			for($i=0;$i<count($results);$i++){
				array_push($dataFields,$results[$i]->Field);
			}
		
			$i=count($dataFields);
			$stringSQL = "SELECT ";
			foreach($dataFields as $dataField){
				$stringSQL.= $dataField;
				if($i != 1){
						$stringSQL.= ', ';
				}
				$i--;
			}
			$stringSQL .= " FROM ";
			$stringSQL .= $this->tableName;
			$sth = $this->dbh->query($stringSQL);
			$results = $sth->fetchAll(PDO::FETCH_OBJ);
			return $results;
		}
		else{
			return false;
		}
		
	}
	
	public function findData($tableName = null, $selectedViewFields = array(),$findFields = array(),$orderBy = array(),$direction = null,$limit = array()){
		if(!empty($tableName) && !empty($selectedViewFields) && !empty($findFields)){
			$this->tableName = $tableName;
			
			$stringSQL = "SELECT ";
			$stringSQL .= $this->myArrayToString($selectedViewFields);
			$stringSQL .= ' FROM ';
			$stringSQL .= $this->tableName.' ';
			$stringSQL .= ' WHERE ';
			$stringSQL .= $this->arraySQLConditionsToString($findFields);
			$sth = $this->dbh->query($stringSQL);
			$results = $sth->fetchAll(PDO::FETCH_OBJ);
			return $results;
		}
		else{
			return false;
		}
		
	}
}
?>