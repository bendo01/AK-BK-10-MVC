<?php
	include('Model/Model.php');
	$myModel = new Model('root','talaso','mysql','localhost','xxx_ak_10');
	//$results = $myModel->selectData('blogs');
	//echo '<pre>';
	//print_r ($results);
	//echo '</pre>';
	$table = 'blogs';
	$selectedViewFields = array(
		'title',
		'body',
		'created',
		'modified'
	);
	
	$findFields = array(
		'conditions'=> array(
			array(
					'field'=>'title',
					'operator'=>'=',
					'value'=>'test 2',
					'next_operator'=>'OR'
			),
			array(
					'field'=>'title',
					'operator'=>'=',
					'value'=>'test 3',
					'next_operator'=>'not'
			)
		)
	);
	
	$orderBy = array(
		'created',
		'modified'
	);
	$direction = 'ASC';
	$limit = array(
		'start' => 1,
		'end' => 30
	);
	//$myModel->arraySQLConditionsToString($findFields);
	
	/*
	echo '<pre>';
	
	print_r($table);
	echo '<br />';
	print_r($selectedViewFields);
	echo '<br />';
	print_r($findFields);
	echo '<br />';
	print_r($orderBy);
	echo '<br />';
	print_r($direction);
	echo '</pre>';
	
	echo $myModel->myArrayToString($selectedViewFields);
	echo '<br />';
	echo $myModel->myArrayToString($orderBy);
	//$resultData = $myModel->findData($table);
	*/
	$resultData = $myModel->findData(
		$table,
		$selectedViewFields,
		$findFields,
		$orderBy,
		$direction,
		$limit);
?>