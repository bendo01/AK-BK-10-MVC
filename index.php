<?php
	include('Model/Model.php');
	$myModel = new Model('root','','mysql','localhost','xxx_ak_10');
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
	$resultData = $myModel->findData(
		$table,
		$selectedViewFields,
		$findFields,
		$orderBy,
		$direction,
		$limit);
?>