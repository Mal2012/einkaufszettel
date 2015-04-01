<?php
// +---------------------+
// | SCWlib: Breadcrumbs |
// +---------------------+------------------+---------------+
// | scwlib_breadcrumbs.php                 | Version 0.2.7 |
// +----------------------------------------+---------------+
// | Copyright 2006 by Tim Gerundt <lgm@lgmsworld.de>       |
// |                                                        |
// | Released under the "GNU Lesser General Public License" |
// +--------------------------------------------------------+

/**
 * Klasse zum Erzeugen einer Brotkrumen-Navigation (Breadcrumb-Navigation).
 */
class SCWlib_Breadcrumbs {
  var $_putintodivision, $_divisioncssclass, $_divisioncssid;
  var $_putintoparagraph, $_paragraphcssclass, $_paragraphcssid;
  var $_description;
  var $_homename, $_homepath;
  var $_separator;
  var $_replaceunderlines;
  var $_ucfirst, $_ucwords;
  var $_removeextension;
  var $_readtitlefrompage, $_titlepattern;
  var $_replacements, $_usereplacements;
  
  /**
   * Konstruktor
   */
  function SCWlib_Breadcrumbs() {
    $this->_putintodivision = false;
    $this->_divisioncssclass = '';
    $this->_divisioncssid = '';
    $this->_putintoparagraph = false;
    $this->_paragraphcssclass = '';
    $this->_paragraphcssid = '';
    $this->_description = '<ol class="breadcrumb"><li>';
    $this->_homename = 'Startseite';
    $this->_homepath = '/';
    $this->_separator = ' </li> ';
    $this->_replaceunderlines = false;
    $this->_ucfirst = false;
    $this->_ucwords = false;
    $this->_removeextension = true;
    $this->_readtitlefrompage = false;
    $this->_titlepattern = '<title>(.*?)<\/title>';
    $this->_replacements = Array();
    $this->_usereplacements = false;
  }
  
  /**
   * Legt fest, ob die Brotkrumen-Navigation in einen Bereich <div> gepackt werden soll.
   * Ausserdem kann man eine optionale CSS-Klasse und/oder CSS-ID angeben.
   */
  function setPutIntoDivision($value, $cssclass = '', $cssid = '') {
    $this->_putintodivision = $value;
    $this->_divisioncssclass = $cssclass;
    $this->_divisioncssid = $cssid;
  }
  
  /**
   * Legt fest, ob die Brotkrumen-Navigation in einen Absatz <p> gepackt werden soll.
   * Ausserdem kann man eine optionale CSS-Klasse und/oder CSS-ID angeben.
   */
  function setPutIntoParagraph($value, $cssclass = '', $cssid = '') {
    $this->_putintoparagraph = $value;
    $this->_paragraphcssclass = $cssclass;
    $this->_paragraphcssid = $cssid;
  }
  
  /**
   * Legt die Beschreibung vor der Brotkrumen-Navigation fest.
   */
  function setDescription($description) {
    $this->_description = $description;
  }
  
  /**
   * Legt den Anzeigenamen der Startseite fest.
   */
  function setHomeName($homename) {
    $this->_homename = $homename;
  }
  
  /**
   * Legt den Pfad der Startseite fest.
   */
  function setHomePath($homepath) {
    $this->_homepath = $homepath;
  }
  
  /**
   * Legt das Trennzeichen der Brotkrumen fest.
   */
  function setSeparator($separator) {
    $this->_separator = $separator;
  }
  
  /**
   * Legt fest, ob der Unterstrich "_" in den Brotkrumen ersetzt werden soll.
   */
  function setReplaceUnderlines($value) {
    $this->_replaceunderlines = $value;
  }
  
  /**
   * Legt fest, ob das erste Zeichen jedes Brotkrumen GROSS geschrieben werden soll.
   */
  function setUppercaseFirst($value) {
    $this->_ucfirst = $value;
  }
  
  /**
   * Legt fest, ob jedes erstes Zeichen eines Wortes innerhalb eines Brotkrumen GROSS geschrieben werden soll.
   */
  function setUppercaseWords($value) {
    $this->_ucwords = $value;
  }
  
  /**
   * Legt fest, ob die Dateierweiterung entfernt werden soll.
   */
  function setRemoveExtension($value) {
    $this->_removeextension = $value;
  }
  
  /**
   * Legt fest, ob der Titel aus der Seite gelesen werden soll.
   */
  function setReadTitleFromPage($value) {
    $this->_readtitlefrompage = $value;
  }
  
  /**
   * Legt das Suchmuster (als Perl-kompatibler regulärer Ausdruck) für den Titel fest.
   */
  function setTitlePattern($titlepattern) {
    $this->_titlepattern = $titlepattern;
  }
  
  /**
   * Löscht die Ersetzungen.
   */
  function clearReplacements() {
    $this->_replacements = Array();
  }
  
  /**
   * Fügt eine Ersetzungen hinzu.
   */
  function addReplacement($search, $replace) {
    $this->_replacements[$search] = $replace;
  }
  
  /**
   * Legt fest, ob Ersetzungen verwendet werden sollen.
   */
  function setUseReplacements($value) {
    $this->_usereplacements = $value;
  }
  
  /**
   * Liefert die Brotkrumen-Navigation zurück.
   */
  function getBreadcrumbs() {
    $html = '';
    
    if ($this->_putintodivision == true) { //Wenn die Brotkrumen-Navigation in einen Bereich <div> gepackt werden soll...
      $html .= '<div';
      if ($this->_divisioncssid != '') { //Wenn eine CSS-ID angegeben wurde...
        $html .= ' id="' . $this->_paragraphcssid . '"';
      }
      if ($this->_divisioncssclass != '') { //Wenn eine CSS-Klasse angegeben wurde...
        $html .= ' class="' . $this->_paragraphcssclass . '"';
      }
      $html .= '>';
    }
    
    if ($this->_putintoparagraph == true) { //Wenn die Brotkrumen-Navigation in einen Absatz <p> gepackt werden soll...
      $html .= '<p';
      if ($this->_paragraphcssid != '') { //Wenn eine CSS-ID angegeben wurde...
        $html .= ' id="' . $this->_paragraphcssid . '"';
      }
      if ($this->_paragraphcssclass != '') { //Wenn eine CSS-Klasse angegeben wurde...
        $html .= ' class="' . $this->_paragraphcssclass . '"';
      }
      $html .= '>';
    }
    
    $html .= $this->_description;
    
    $path = $this->_homepath;
    $html .= '<a href="' . $path . '">' . $this->_homename . '</a>';
    
    $parts = explode('/', $_SERVER['PHP_SELF'].$homepath);
    $partscount = count($parts);
    for($i = 1; $i < ($partscount - 1); $i++) { //Für alle Brotkrumen...
      $path .= $parts[$i] . '/';
      
      $title = $parts[$i];
      
      if ($this->_usereplacements == true) { //Wenn "Ersetzungen" verwendet werden sollen...
        reset($this->_replacements);
        while (list($search, $replace) = each($this->_replacements)) { //Für alle Ersetzungen...
          $title = str_replace($search, $replace, $title);
        }
      }
      
      if ($this->_replaceunderlines == true) { //Wenn der Unterstrich "_" in den Brotkrumen ersetzt werden soll...
        $title = str_replace('_', ' ', $title);
      }
      
      if ($this->_ucfirst == true) { //Wenn das erste Zeichen jedes Brotkrumen GROSS geschrieben werden soll...
        $title = ucfirst($title);
      }
      
      if ($this->_ucwords == true) { //Wenn jedes erstes Zeichen eines Wortes innerhalb eines Brotkrumen GROSS geschrieben werden soll...
        $title = ucwords($title);
      }
      
      $html .= $this->_separator . '<li><a href="' . $path . '">' . $title . '</a>';
    }
    
    $title = '';
    if ($this->_readtitlefrompage == true) { //Wenn der Titel aus der Seite gelesen werden soll...
      $lines = @file($parts[$partscount-1]);
      if (is_array($lines) == true) { //Wenn die Seite gelesen werden konnte...
        foreach($lines as $line) { //Für alle Zeilen...
          preg_match('/' . $this->_titlepattern . '/i', $line, $found);
          if ($found[1] != '') { //Wenn der Titel gefunden wurde...
            $title = $found[1];
            break;
          }
        }
      }
    }
    
    if ($title == '') { //Wenn KEIN Titel ermittelt wurde...
      $title = $parts[$partscount-1];
      
      if ($this->_usereplacements == true) { //Wenn "Ersetzungen" verwendet werden sollen...
        reset($this->_replacements);
        while (list($search, $replace) = each($this->_replacements)) { //Für alle Ersetzungen...
          $title = str_replace($search, $replace, $title);
        }
      }
      
      if ($this->_removeextension == true) { //Wenn die Dateierweiterung entfernt werden soll...
        $title = substr($title, 0, strrpos($title, '.'));
      }
      
      if ($this->_replaceunderlines == true) { //Wenn der Unterstrich "_" in den Brotkrumen ersetzt werden soll...
        $title = str_replace('_', ' ', $title);
      }
      
      if ($this->_ucfirst == true) { //Wenn das erste Zeichen jedes Brotkrumen GROSS geschrieben werden soll...
        $title = ucfirst($title);
      }
      
      if ($this->_ucwords == true) { //Wenn jedes erstes Zeichen eines Wortes innerhalb eines Brotkrumen GROSS geschrieben werden soll...
        $title = ucwords($title);
      }
    }
    
    $html .= $this->_separator . '<li class="active">' . $title . '</li></ol>';
    
    if ($this->_putintoparagraph == true) { //Wenn die Brotkrumen-Navigation in einen Absatz <p> gepackt werden soll...
      $html .= '</p>';
    }
    
    if ($this->_putintodivision == true) { //Wenn die Brotkrumen-Navigation in einen Bereich <div> gepackt werden soll...
      $html .= '</div>';
    }
    
    return $html;
  }
  
  /**
   * Gibt die Brotkrumen-Navigation aus.
   */
  function printBreadcrumbs() {
    print($this->getBreadcrumbs());
  }
}
?>