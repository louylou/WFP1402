<?php

session_start();

if(empty($_SESSION['userInfo'])) {
	header('Location: auth.php');
}
	require_once "models/db.php";
	require_once "models/dvdModel.php";
	require_once "models/dvdView.php";
	
	$model = new dvdModel(MY_DSN, MY_USER, MY_PASS);
	$view = new dvdView(); 	//An over all class to view ALL page views (inc) 
	
	$view->showHeader('Group Home: Perfect For Me'); //calling the showHeader Function 
	$view->showLatest($model->getLatestDvd()); //$rows is equaled to the argument #this would show the grouphome content
	$view->showLatest($model->getCal());
	$view->showFooter();
	

?>

	
