<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
// check if fields passed are empty
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']))
   {
	echo "Nicht alle Felder Ausgefüllt! <a href='/page.php?p=Kontakt'> Zurück </a>";
	return false;
   }
	if ($resp != null && $resp->success) {

$name = $_POST['name'];
$phone = $_POST['phone'];
$email_address = $_POST['email'];
$message = $_POST['message'];
	
// create email body and send it	
$to = "bla@example.com"; // PUT YOUR EMAIL ADDRESS HERE
$email_subject = "Einkaufszettel"; // EDIT THE EMAIL SUBJECT LINE HERE
$email_body = "Das ist ein Einkaufszettel";
$headers = "";
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
echo "<div class='alert alert-success'><strong>Vielen Dank für Ihre E-Mail! </strong></div>";
	}
}
?>
 <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
            <div class="col-md-8">
             <h3 style="font-size: 25pt">Schicken Sie uns eine Nachricht</h3>
                <form name="sentMessage" action="./page.php?p=Kontakt" id="contactForm" method="POST">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Name: *</label>
                            <input type="text" class="form-control" id="name" name="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Telefonnummer:</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>E-Mail Adresse: *</label>
                            <input type="email" class="form-control" id="email" name="email" required data-validation-required-message="Please enter your email address.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nachricht: *</label>
                            <textarea rows="10" cols="100" class="form-control" id="message" name="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            
                           </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary">Nachricht verschicken</button>
                </form>
             </div>
            <!-- Contact Details Column -->
            <div class="col-md-4">
                <h3 style="font-size: 25pt">Kontaktinformationen</h3>
                <p>
                	Name Nachname<br>
                    Adresse<br>
					PLZ ORT<br>
                </p>
                <p><i class="fa fa-phone"></i>: Telefon</p>
                <p><i class="fa fa-envelope-o"></i>: <a href="mailto:email">E-Mail</a>
                </p>
                <p>
                Umsatzsteuer-ID nach §27a Umsatzsteuergesetz:<br>
                Bla
                </p>
                 <p>
              	Wirtschafts-ID: <br>
                Bla
                </p>
             
                <ul class="list-unstyled list-inline list-social-icons">
                    <li>
                        <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                    </li>
                </ul>
                <br>
                <br>
                <strong>Webdesign: </strong>
                <p>
                Malcolm Kögler<br>
                Straße Hausnummer<br>
                PLZ Stadt<br>
                
                <p><i class="fa fa-envelope-o"></i>: <a href="mailto:">E-Mail</a>
                </p>
            </div>
        
        <!-- /.row -->
	</div>
    <br>
<div class="row">
<div class="col-md-3 col-sm-6" style="width:100%">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h4>Disclaimer</h4>
                    </div>
                    <div class="panel-body" style="text-align:left">
             <strong>Haftungsbeschränkung</strong><p>
Die Inhalte dieser Website werden mit größtmöglicher Sorgfalt erstellt. Der Anbieter übernimmt jedoch keine Gewähr für die Richtigkeit, Vollständigkeit und Aktualität der bereitgestellten Inhalte. Die Nutzung der Inhalte der Website erfolgt auf eigene Gefahr des Nutzers. Namentlich gekennzeichnete Beiträge geben die Meinung des jeweiligen Autors und nicht immer die Meinung des Anbieters wieder. Mit der reinen Nutzung der Website des Anbieters kommt keinerlei Vertragsverhältnis zwischen dem Nutzer und dem Anbieter zustande. 
</p><br>
<strong>Externe Links</strong><p>
Diese Website enthält Verknüpfungen zu Websites Dritter ("externe Links"). Diese Websites unterliegen der Haftung der jeweiligen Betreiber. Der Anbieter hat bei der erstmaligen Verknüpfung der externen Links die fremden Inhalte daraufhin überprüft, ob etwaige Rechtsverstöße bestehen. Zu dem Zeitpunkt waren keine Rechtsverstöße ersichtlich. Der Anbieter hat keinerlei Einfluss auf die aktuelle und zukünftige Gestaltung und auf die Inhalte der verknüpften Seiten. Das Setzen von externen Links bedeutet nicht, dass sich der Anbieter die hinter dem Verweis oder Link liegenden Inhalte zu Eigen macht. Eine ständige Kontrolle der externen Links ist für den Anbieter ohne konkrete Hinweise auf Rechtsverstöße nicht zumutbar. Bei Kenntnis von Rechtsverstößen werden jedoch derartige externe Links unverzüglich gelöscht. 
</p><br>
<strong>Urheber- und Leistungsschutzrechte</strong><p>
Die auf dieser Website veröffentlichten Inhalte unterliegen dem deutschen Urheber- und Leistungsschutzrecht. Jede vom deutschen Urheber- und Leistungsschutzrecht nicht zugelassene Verwertung bedarf der vorherigen schriftlichen Zustimmung des Anbieters oder jeweiligen Rechteinhabers. Dies gilt insbesondere für Vervielfältigung, Bearbeitung, Übersetzung, Einspeicherung, Verarbeitung bzw. Wiedergabe von Inhalten in Datenbanken oder anderen elektronischen Medien und Systemen. Inhalte und Rechte Dritter sind dabei als solche gekennzeichnet. Die unerlaubte Vervielfältigung oder Weitergabe einzelner Inhalte oder kompletter Seiten ist nicht gestattet und strafbar. Lediglich die Herstellung von Kopien und Downloads für den persönlichen, privaten und nicht kommerziellen Gebrauch ist erlaubt. 

Die Darstellung dieser Website in fremden Frames ist nur mit schriftlicher Erlaubnis zulässig.
</p><br>
<strong>Besondere Nutzungsbedingungen</strong><p>
Soweit besondere Bedingungen für einzelne Nutzungen dieser Website von den vorgenannten Paragraphen abweichen, wird an entsprechender Stelle ausdrücklich darauf hingewiesen. In diesem Falle gelten im jeweiligen Einzelfall die besonderen Nutzungsbedingungen.                  
                   </p>     
                    </div>
                </div>
            </div>


</div>

   <br>
<div class="row">
<div class="col-md-3 col-sm-6" style="width:100%">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h4>Datenschutzerklärung</h4>
                    </div>
                    <div class="panel-body" style="text-align:left">

<strong>Datenschutz</strong><p>
Nachfolgend möchten wir Sie über unsere Datenschutzerklärung informieren. Sie finden hier Informationen über die Erhebung und Verwendung persönlicher Daten bei der Nutzung unserer Webseite. Wir beachten dabei das für Deutschland geltende Datenschutzrecht. Sie können diese Erklärung jederzeit auf unserer Webseite abrufen. 

Wir weisen ausdrücklich darauf hin, dass die Datenübertragung im Internet (z.B. bei der Kommunikation per E-Mail) Sicherheitslücken aufweisen und nicht lückenlos vor dem Zugriff durch Dritte geschützt werden kann. 

Die Verwendung der Kontaktdaten unseres Impressums zur gewerblichen Werbung ist ausdrücklich nicht erwünscht, es sei denn wir hatten zuvor unsere schriftliche Einwilligung erteilt oder es besteht bereits eine Geschäftsbeziehung. Der Anbieter und alle auf dieser Website genannten Personen widersprechen hiermit jeder kommerziellen Verwendung und Weitergabe ihrer Daten. 
</p>
<br>
<strong>Personenbezogene Daten</strong> <p>
Sie können unsere Webseite ohne Angabe personenbezogener Daten besuchen. Soweit auf unseren Seiten personenbezogene Daten (wie Name, Anschrift oder E-Mail Adresse) erhoben werden, erfolgt dies, soweit möglich, auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdrückliche Zustimmung nicht an Dritte weitergegeben. Sofern zwischen Ihnen und uns ein Vertragsverhältnis begründet, inhaltlich ausgestaltet oder geändert werden soll oder Sie an uns eine Anfrage stellen, erheben und verwenden wir personenbezogene Daten von Ihnen, soweit dies zu diesen Zwecken erforderlich ist (Bestandsdaten). Wir erheben, verarbeiten und nutzen personenbezogene Daten soweit dies erforderlich ist, um Ihnen die Inanspruchnahme des Webangebots zu ermöglichen (Nutzungsdaten). Sämtliche personenbezogenen Daten werden nur solange gespeichert wie dies für den geannten Zweck (Bearbeitung Ihrer Anfrage oder Abwicklung eines Vertrags) erforderlich ist. Hierbei werden steuer- und handelsrechtliche Aufbewahrungsfristen berücksichtigt. Auf Anordnung der zuständigen Stellen dürfen wir im Einzelfall Auskunft über diese Daten (Bestandsdaten) erteilen, soweit dies für Zwecke der Strafverfolgung, zur Gefahrenabwehr, zur Erfüllung der gesetzlichen Aufgaben der Verfassungsschutzbehörden oder des Militärischen Abschirmdienstes oder zur Durchsetzung der Rechte am geistigen Eigentum erforderlich ist.
</p><br>
<strong>Auskunftsrecht</strong><p>
Sie haben das jederzeitige Recht, sich unentgeltlich und unverzüglich über die zu Ihrer Person erhobenen Daten zu erkundigen. Sie haben das jederzeitige Recht, Ihre Zustimmung zur Verwendung Ihrer angegeben persönlichen Daten mit Wirkung für die Zukunft zu widerrufen. Zur Auskunftserteilung wenden Sie sich bitte an den Anbieter unter den Kontaktdaten im Impressum.         
      </p>                 
                    </div>
                </div>
            </div>


</div>