<?php include("header.php"); ?>
<?php $_page = $_GET["p"]; ?>
    <!-- Page Content -->
    <div class="container">
    
     <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $_page; ?>
                </h1>
                  <?php
 						include('bin/breadcrumbs.php'); //Datei einbinden
 						$breadcrumbs = new SCWlib_Breadcrumbs; //Objekt erzeugen
						 $breadcrumbs->setReplaceUnderlines(true); //Unterstrich "_" ersetzen
 							$breadcrumbs->setUppercaseFirst(true); //Erster Buchstabe = Großbuchstabe
 							 $breadcrumbs->addReplacement('page', $_page); //gaestebuch -> gästebuch
						 $breadcrumbs->setUseReplacements(true); //Ersetzungen verwenden
						 $breadcrumbs->printBreadcrumbs(); //Brotkrumen einfügen
 
?>
            </div>
        </div>
        <!-- Features Section -->
        <?php include("bin/".$_page."_wrapper.php"); ?>
						
	

<?php include("footer.php"); ?>
