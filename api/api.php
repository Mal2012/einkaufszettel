<?php
header('Access-Control-Allow-Origin: *');
include("../bin/mysql.php");
session_start();

$o_a = $_GET['a'];
$o_user_name = $_GET['username'];
$o_user_pass = $_GET['password'];
$o_user_session = $_GET['session'];
$o_user_mail = $_GET['usermail'];
$o_user_id = $_GET['userid'];
$o_zettel_id = $_GET['zettelid'];
$o_zettel_name = $_GET['zettelname'];

$o_zettel_lc = $_GET['zettellc'];
$o_item_name = $_GET['itemname'];
$o_item_id = $_GET['itemid'];
$o_item_status = $_GET['itemstatus'];
#####################
#
#		User
#
#####################
//User Prüfen
if ($o_a == 'checkLogin' && $o_user_session != '' && _regSession($o_user_session) != '0' && $o_user_name != '') {
$i_user_id = _getUserid($o_user_name);
 $respone = Array();
if(_getUserID_Sess($o_user_session) == $i_user_id){
	$respone["code"] = 0;
    $respone["msg"] = "Benutzer eingeloggt";
}else{
	$respone["code"] = 1;
    $respone["msg"] = "Benutzer nicht eingeloggt";
}

}


//Login
if ($o_a == 'login' && $o_user_name != '' && $o_user_pass != '') {
    $i_user_id = _getUserid($o_user_name);
    $respone = Array("code" => 1, "msg" => "Benutzer existiert nicht");
    if ($i_user_id != '') {
        if (md5($o_user_pass) == _getPasswort($o_user_name)) {
            $_SESSION['username'] = $o_user_name;
            $respone["code"] = 0;
            $respone["msg"] = session_id();
            _addSession($o_user_name, session_id());
        } else {
            $respone["code"] = 2;
            $respone["msg"] = "Falsches Passwort";
        }
    }
    
    print_r(json_encode($respone));
}
// User Registrieren
if ($o_a == 'register' && $o_user_mail != '' && $o_user_pass != '' && $o_user_name != '') {
    if (_getUsername($o_user_name) == '') {
        _addUser($o_user_name, $o_user_pass, $o_user_mail);
        $respone = Array("code" => 0, "msg" => "Benutzer registriert");
    } else {
        $respone["code"] = 1;
        $respone["msg"] = "Benutzer existiert bereits!";
    }
	 print_r(json_encode($respone));
}
// User Ausloggen
if ($o_a == 'logout' && $o_user_session != '' && _regSession($o_user_session) != '0') {
    _delSession($o_user_session);
    $respone = Array("code" => 0, "msg" => "Benutzer ausgeloggt");
	 print_r(json_encode($respone));
}
// User Finden
if ($o_a == 'userFind' && $o_user_session != '' && _regSession($o_user_session) != '0' && $o_user_mail != '') {
    $row = _findUser($o_user_mail)->fetch_assoc();
    if ($row != '') {
		 $respone = Array("code" => 0, "msg" => $row['id']);
        
    } else {
        $respone["code"] = 1;
        $respone["msg"] = "Benutzer nicht gefunden!";
    }
	 print_r(json_encode($respone));
}

#####################
#
#		Zettel
#
#####################
//Zettel abrufen
if ($o_a == 'getZettel' && $o_user_session != '' && _regSession($o_user_session) != '0') {
    $uid = _getUserID_Sess($o_user_session);
    $columnCount = 1;
    $row = _getZettel_a($uid);
    $dom = new DOMDocument("1.0", "utf-8");
    $wurzel = $dom->createElement("user");
    $dom->appendChild($wurzel);
    while ($field = $row->fetch_assoc()) {
        $row_d = _getZettel_s($field['zettel_id']);
        $field_d = $row_d->fetch_assoc();
        $columnCount++;
        $root = $dom->createElement("liste");
        $wurzel->appendChild($root);
        $root->setAttribute("id", $field['zettel_id']);
        $root->setAttribute("name", $field_d['name']);
        $root->setAttribute("lchange", $field_d['lchange']);
        $root->setAttribute("berechtigung", $field['berechtigung']);
        $row_p = _getZettel_p($field['zettel_id']);

        while ($field_p = $row_p->fetch_assoc()) {
            $root->appendChild($item = $dom->createElement("item", $field_p['name']));
            $item->setAttribute("id", $field_p['id']);
            $item->setAttribute("user", $field_p['user_id']);
            $item->setAttribute("status", $field_p['gekauft']);
        }
    }
    header("Content-type: text/xml; charset=utf-8");
    echo $dom->saveXML();
}

//Zettel abrufen JSON
if ($o_a == 'getZettelJSON' && $o_user_session != '' && _regSession($o_user_session) != '0') {
    $uid = _getUserID_Sess($o_user_session);
    $row = _getZettel_a($uid);
    $output = array();
    while ($field = $row->fetch_assoc()) {
        $row_d = _getZettel_s($field['zettel_id']);
        $field_d = $row_d->fetch_assoc();
		$name = $field_d['name'];
        $output[$name]['id'] = $field['zettel_id'];
        $output[$name]['name'] = $field_d['name'];
        $output[$name]['lchange'] = $field_d['lchange'];
        $output[$name]['berechtigung'] = $field['berechtigung'];
        $row_p = _getZettel_p($field['zettel_id']);
        while ($field_p = $row_p->fetch_assoc()) {
            $output[$name]['item' . $field_p['id']]['id'] = $field_p['id'];
            $output[$name]['item' . $field_p['id']]['name'] = $field_p['name'];
            $output[$name]['item' . $field_p['id']]['user'] =  _getUsername_id($field_p['user_id']);
            $output[$name]['item' . $field_p['id']]['status'] = $field_p['gekauft'];
        }
    }

    print_r(json_encode($output));
}
//Zettel Änderungen abrufen nach Datum
if ($o_a == 'getZettel_lchange' && $o_user_session != '' && _regSession($o_user_session) != '0' && $o_zettel_id != '' && $o_zettel_lc != '') {
    $uid = _getUserID_Sess($o_user_session);
    $row = _getZettel_a($uid);
    $field = $row->fetch_assoc();
    $row_d = _getZettel_s($field['zettel_id']);
    $field_d = $row_d->fetch_assoc();
    if ($o_zettel_lc < $field_d['lchange']) {
        $dom = new DOMDocument("1.0", "utf-8");
        $root = $dom->createElement("liste");
        $dom->appendChild($root);
        $root->setAttribute("id", $field_d['id']);
        $root->setAttribute("name", $field_d['name']);
        $root->setAttribute("lchange", $field_d['lchange']);
        $root->setAttribute("berechtigung", $field['berechtigung']);
        $row_p = _getZettel_p($field['zettel_id']);

        while ($field_p = $row_p->fetch_assoc()) {
            $root->appendChild($item = $dom->createElement("item", $field_p['name']));
            $item->setAttribute("id", $field_p['id']);
            $item->setAttribute("user", $field_p['user_id']);
            $item->setAttribute("status", $field_p['gekauft']);
        }

        header("Content-type: text/xml; charset=utf-8");
        echo $dom->saveXML();
    } else {
        echo 0;
    }
}
// Zettel Löschen
if ($o_a == 'delZettel' && $o_user_session != '' && _regSession($o_user_session) != '0' && $o_zettel_id != '') {
    _delZettel($o_zettel_id);
    $respone = Array("code" => 0, "msg" => "Zettel gelöscht");
	 print_r(json_encode($respone));
}

// Items Hinzufügen
if ($o_a == 'addItem' && $o_user_session != '' && _regSession($o_user_session) != '0' && $o_zettel_id != '' && $o_item_name != '') {
    _addZettel_item($o_zettel_id, $o_item_name, _getUserID_Sess($o_user_session));
    $respone = Array("code" => 0, "msg" => "Item hinzugefügt");
	 print_r(json_encode($respone));
}
// Items Entfernen
if ($o_a == 'delItem' && $o_user_session != '' && _regSession($o_user_session) != '0' && $o_zettel_id != '' && $o_item_id != '') {
    _delZettel_p($o_item_id, $o_zettel_id);
    $respone = Array("code" => 0, "msg" => "Item gelöscht");
	 print_r(json_encode($respone));
}

// Items Status updaten
if ($o_a == 'updateItem' && $o_user_session != '' && _regSession($o_user_session) != '0' && $o_zettel_id != '' && $o_item_id != '' && $o_item_status != '') {
    _updateZettel($o_zettel_id, $o_item_id, $o_item_status);
    $respone = Array("code" => 0, "msg" => "Item geändert");
	 print_r(json_encode($respone));
}

// Zettel Hinzufügen
if ($o_a == 'addZettel' && $o_user_session != '' && _regSession($o_user_session) != '0' && $o_zettel_name != '') {
    _addZettel($o_zettel_name, _getUserID_Sess($o_user_session));
   $respone = Array("code" => 0, "msg" => "Zettel hinzugefügt");
    print_r(json_encode($respone));
}
// Zettel Freigeben
if ($o_a == 'shareZettel' && $o_user_session != '' && _regSession($o_user_session) != '0' && $o_zettel_id != '' && $o_user_id != '') {
    _addZettel_user($o_zettel_id, $o_user_id);
    $respone = Array("code" => 0, "msg" => "Zettel freigegeben");
	 print_r(json_encode($respone));
}
?>