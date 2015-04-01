<?php
if($_POST['p']=="l" && $_POST['id'] != ""){
	
_delZettel($_POST['id']);
	
}
if($_POST['p']=="p" && $_POST['id'] != "" && $_POST['zettel_id'] != ""){
_delZettel_p($_POST['id'],$_POST['zettel_id']);
	
}
if($_POST['p']=="a" && $_POST['item'] != "" && $_POST['id'] != ""){
_addZettel_item($_POST['id'], $_POST['item'],_getUserid($_SESSION['username']));
}
if($_POST['p']=="aa" && $_POST['name'] != ""){
_addZettel($_POST['name'],_getUserid($_SESSION['username']));
}
if($_POST['p']=="pg" && $_POST['id'] != "" && $_POST['zettel_id'] != "" && $_POST['val'] != ""){
_updateZettel($_POST['zettel_id'],$_POST['id'],$_POST['val']);
	
}
if($_POST['p']=="au" && $_POST['id'] != "" && $_POST['usermail'] != ""){
$row = _findUser($_POST['usermail'])->fetch_assoc();	
$userid = $row['id'];
_addZettel_user($_POST['id'],$userid);
}

?>

 <div class="row">
 <div class="project-wrapper">
			
            <div class="" > 
            
            <?php 
			$columnCount = 1;
   			$row = _getZettel_a(_getUserid($_SESSION['username']));
			while ($field = $row->fetch_assoc()) {
		     $row_d = _getZettel_s($field['zettel_id']);
			 $field_d = $row_d->fetch_assoc();
			 
			
			$columnCount++;
				echo "<div class=\"panel panel-default \">
                    <div class=\"panel-heading\">
                      			
                        <h4> <a data-toggle=\"collapse\" data-target=\"#collapseItems-".$columnCount."\" 
           href=\"#collapseItems-".$columnCount."\" class=\"collapsed\">".$field_d['name']."</a></h4>
                    </div>
                    <div id=\"collapseItems-".$columnCount."\" class=\"panel-collapse collapse\">
                    <div class=\"panel-body\">";
					$row_p = _getZettel_p($field['zettel_id']);
					echo "<div class=\"well\" style=\"max-height: 300px;overflow: auto;\">
        		<ul class=\"list-group checked-list-box\">";
					while($field_p = $row_p->fetch_assoc()){
						echo "<li class=\"list-group-item\" ";if($field_p['gekauft']=="1"){echo "data-checked=\"true\"";}echo ">";
						echo " <form action=\"page.php?p=Einkaufszettel#collapseItems-".$columnCount."\" method=\"post\">
                    <input type=\"hidden\" name=\"p\" value=\"p\">
					<input type=\"hidden\" name=\"id\" value=\"".$field_p['id']."\">
					<input type=\"hidden\" name=\"zettel_id\" value=\"".$field['zettel_id']."\">";
				    echo $field_p['name']." (von "._getUsername_id($field_p['user_id']).")<input class=\"btn btn-primary\" type=\"submit\" style=\"margin:5px\" value=\" Löschen\"></form>";
					echo "<form action=\"page.php?p=Einkaufszettel#collapseItems-".$columnCount."\" method=\"post\">
                    <input type=\"hidden\" name=\"p\" value=\"pg\">
					<input type=\"hidden\" name=\"id\" value=\"".$field_p['id']."\">
					<input type=\"hidden\" name=\"zettel_id\" value=\"".$field['zettel_id']."\">";
					if($field_p['gekauft']=="1"){echo "<input type=\"hidden\" name=\"val\" value=\"0\">";}else{echo "<input type=\"hidden\" name=\"val\" value=\"1\">";}
					if($field_p['gekauft']=="1"){echo "<input class=\"btn btn-primary\" type=\"submit\" style=\"margin:5px\" value=\"Als Benötigt markieren\"></form>";}else{echo "<input class=\"btn btn-primary\" type=\"submit\" style=\"margin:5px\" value=\"Als Gekauft markieren\"></form>";}
					echo "</li>";
                  
             
					}
					
					   echo"</ul>
            </div>";
			
			
					echo " <form action=\"page.php?p=Einkaufszettel#collapseItems-".$columnCount."\" method=\"post\">
                    <input type=\"hidden\" name=\"p\" value=\"a\">
					<input type=\"hidden\" name=\"id\" value=\"".$field['zettel_id']."\">
					<input type=\"text\" name=\"item\" value=\"Artikel\">
					<input class=\"btn btn-primary\" type=\"submit\" style=\"margin:5px\" value=\"Hinzufügen\"></form>";
					if($field['berechtigung'] != 'g'){
					
					echo " <form action=\"page.php?p=Einkaufszettel#collapseItems-".$columnCount."\" method=\"post\">
                    <input type=\"hidden\" name=\"p\" value=\"au\">
					<input type=\"hidden\" name=\"id\" value=\"".$field['zettel_id']."\">
					<input type=\"text\" name=\"usermail\" value=\"E-Mail\">";
					echo "<input class=\"btn btn-primary\" type=\"submit\" style=\"margin:5px\" value=\"Benutzer Einladen\"></form>";
					echo " <form action=\"page.php?p=Einkaufszettel\" method=\"post\">
                    <input type=\"hidden\" name=\"p\" value=\"l\">
					<input type=\"hidden\" name=\"id\" value=\"".$field['zettel_id']."\">";
					echo "<input class=\"btn btn-primary\" type=\"submit\" style=\"margin:5px\" value=\"Liste ".$field_d['name']." Löschen\"></form>";
					
					}
			echo "</div></div></div>";
			 }
			 echo " <form action=\"page.php?p=Einkaufszettel\" method=\"post\">
                    <input type=\"hidden\" name=\"p\" value=\"aa\">
					<input type=\"text\" name=\"name\" value=\"\">
					<input class=\"btn btn-primary\" type=\"submit\" style=\"margin:5px\" value=\"Einkaufszettel Hinzufügen\"></form>";
			?>
            
            
				</div>
				
			</div>
          
        </div>
        <!-- /.row -->


						