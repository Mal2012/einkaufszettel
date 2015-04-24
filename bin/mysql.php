<?php
   
function getConnected() {
	$mysqli = new mysqli('localhost', 'd01dde70', 'MnUtDRrXT4RgmQyX', 'd01dde70');

   if($mysqli->connect_error) 
     die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		$mysqli->query("SET NAMES 'utf8'");
   return $mysqli;
}

function _mysqlquery($sql){
if(!$result = getConnected()->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}	
return $result;
}
function _addUser($name,$pass,$mail){
$abfrage = "INSERT INTO `einkaufszettel`.`user` (`id`, `user`, `mail`, `passwort`, `token`) VALUES (NULL, '".$name."', '".$mail."', '".md5($pass)."', '0')";	
$row = _mysqlquery($abfrage);
return true;	
}
function _getUsername($id){
$abfrage = "SELECT user FROM user WHERE user = '".$id."'";
$row = _mysqlquery($abfrage)->fetch_assoc();
    return $row['user'];
}
function _getUsername_id($id){
$abfrage = "SELECT user FROM user WHERE $id = '".$id."'";
$row = _mysqlquery($abfrage)->fetch_assoc();
    return $row['user'];
}
function _getUserid($user){
$abfrage = "SELECT id FROM user WHERE user = '".$user."'";
$row = _mysqlquery($abfrage)->fetch_assoc();
    return $row['id'];
}
function _getPasswort($user){
$abfrage = "SELECT passwort FROM user WHERE user = '".$user."'";
$row = _mysqlquery($abfrage)->fetch_assoc();
    return $row['passwort'];
}
function _setPass($user,$pass){
$abfrage = "UPDATE user SET passwort = '".$pass."' WHERE user = '".$user."'";	
$row = _mysqlquery($abfrage);
return true;
}
function _getZettel_s($zettelid){
$abfrage = "SELECT id,name,lchange FROM einkaufszettel WHERE id='".$zettelid."'";
$row = _mysqlquery($abfrage);
    return $row;
}
function _getZettel_a($userid){
$abfrage = "SELECT zettel_id,berechtigung FROM einkaufszettel_user WHERE user_id='".$userid."'";
$row = _mysqlquery($abfrage);
    return $row;
}
function _getZettel_p($zettelid){
$abfrage = "SELECT zettel_id,name,user_id,gekauft,id FROM einkaufszettel_items WHERE zettel_id='".$zettelid."'";
$row = _mysqlquery($abfrage);
    return $row;
}
function _delZettel($id){
$abfrage = "DELETE FROM einkaufszettel_items WHERE zettel_id = '".$id."'";	
$row = _mysqlquery($abfrage);
$abfrage = "DELETE FROM einkaufszettel_user WHERE zettel_id = '".$id."'";	
$row = _mysqlquery($abfrage);
$abfrage = "DELETE FROM einkaufszettel WHERE id = '".$id."'";	
$row = _mysqlquery($abfrage);
return true;
}
function _delZettel_p($id,$zettel_id){
$abfrage = "DELETE FROM einkaufszettel_items WHERE id = '".$id."'";	
$row = _mysqlquery($abfrage);
$stamp = date("Y-m-d H:i:s", time());
$abfrage = "UPDATE `einkaufszettel` SET `lchange` ='".$stamp."' WHERE id = '".$zettel_id."' ";	
$row = _mysqlquery($abfrage);
return true;
}
function _addZettel_item($id,$item,$user){
	$abfrage = "INSERT INTO `einkaufszettel`.`einkaufszettel_items` (`id`, `zettel_id`, `name`, `user_id`, `gekauft`) VALUES (NULL, '".$id."', '".$item."', '".$user."', '0')";	
$row = _mysqlquery($abfrage);
$stamp = date("Y-m-d H:i:s", time());
$abfrage = "UPDATE `einkaufszettel` SET `lchange` ='".$stamp."' WHERE id = '".$id."' ";	
$row = _mysqlquery($abfrage);
return true;
}
function _addZettel($name,$user){
	$stamp = date("Y-m-d H:i:s", time());
	$abfrage = "INSERT INTO `einkaufszettel`.`einkaufszettel` (`id`, `name`, `lchange`) VALUES (NULL, '".$name."', '".$stamp."')";	
$row = _mysqlquery($abfrage);
$abfrage = "SELECT id FROM einkaufszettel WHERE name = '".$name."' AND lchange ='".$stamp."'";
$row = _mysqlquery($abfrage)->fetch_assoc();
$abfrage = "INSERT INTO `einkaufszettel`.`einkaufszettel_user` (`user_id`, `zettel_id`, `berechtigung`) VALUES ('".$user."', '".$row['id']."', 'o')";	
$row = _mysqlquery($abfrage);
return true;
}
function _updateZettel($id,$item_id,$val){
$stamp = date("Y-m-d H:i:s", time());
$abfrage = "UPDATE `einkaufszettel` SET `lchange` ='".$stamp."' WHERE id = '".$id."' ";	
$row = _mysqlquery($abfrage);
	
$abfrage = "UPDATE `einkaufszettel`.`einkaufszettel_items` SET `gekauft` = '".$val."' WHERE `einkaufszettel_items`.`id` = ".$item_id."";	
$row = _mysqlquery($abfrage);
	
	return true;
}
function _addZettel_user($zettel_id,$user){
$abfrage = "INSERT INTO `einkaufszettel`.`einkaufszettel_user` (`id`, `user_id`, `zettel_id`, `berechtigung`) VALUES (NULL, '".$user."', '".$zettel_id."', 'g');";	
$row = _mysqlquery($abfrage);
return true;	
}
function _findUser($usermail){
	$abfrage = "SELECT * FROM `user` WHERE `mail` LIKE '".$usermail."' LIMIT 1";
	$row = _mysqlquery($abfrage);
return $row;
}
function _regSession($sessid){
$abfrage = "SELECT * FROM `user` WHERE `token` = '".$sessid."'";
$row = _mysqlquery($abfrage)->fetch_assoc();
if($row != ''){
return $sessid;
}
return 0;	
}
function _addSession($user,$sessid){
	$abfrage = "UPDATE user SET token = '".$sessid."' WHERE user = '".$user."'";
	$row = _mysqlquery($abfrage);
	return true;
}
function _delSession($sessid){
	$abfrage = "UPDATE user SET token = '0' WHERE token = '".$sessid."'";
	$row = _mysqlquery($abfrage);
	return true;
}
function _getUserID_Sess($sessid){
$abfrage = "SELECT id FROM user WHERE token = '".$sessid."'";
$row = _mysqlquery($abfrage)->fetch_assoc();
    return $row['id'];
	
}
?>