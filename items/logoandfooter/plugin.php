<?php
/*
Logo und Fusszeile XXL
=======================

Version:    1.0  20.02.2018
Autor:      Hertste, Germany, stefan.programmiert@web.de
Copyright:  2018 Stefan H.

F¸r Bludit Version 2.X 

Fragen, W¸nsche, Anregungen sind erw¸nscht
*/

      
                                  
                                  
class PluginLogoAndFooter extends Plugin {

	public function init()
	{
		// Fields and default values for the database of this plugin
		$this->dbFields = array(
		    'LogoAnAus2'=>False,
		    'fusszeile2'=>False,
		    'hochscrollenAnAus'=>False,
		    'eigeneFusszeileAnAus'=>False,
		    'fusszeile_farbe'=>'',
			'bezeichnung2'=>'',
			'bezeichnung_logo2'=>'',
            'bezeichnung_hochscrollen_farbe'=>'',
            'eigene_fusszeile'=>''			
		);               
	}                   
         
   
               
  
  

	// Method called on the settings of the plugin on the admin area
	public function form()
	{	
		global $Language;  
		
        //   LOGO
		$html = '<div>';		
		$html .= '<label>'.$Language->get('bezeichnung_logo').'</label>';
		$html .= '<select name="LogoAnAus2" style="width:100px">';
		$html .= '<option value="true" '.($this->getValue('LogoAnAus2')===true?'selected':'').'>On</option>';
		$html .= '<option value="false" '.($this->getValue('LogoAnAus2')===false?'selected':'').'>Off</option>';
		$html .= '</select> ';
		$html .= '<input name="bezeichnung_logo2" type="text" value="'.$this->getValue('bezeichnung_logo2').'">';
		$html .= '<div style="size:small">('.$Language->get('bezeichnung_logo_beschreibung').''.DOMAIN_UPLOADS.'LOGO.JPG  )</div>';
		$html .= '</div>';

      	$html .= '<hr />';	

        // === Fusszeile
		$html .= '<div>';
		$html .= '<label>'.$Language->get('bezeichnung_fusszeile').'</label>';
		$html .= '<select name="fusszeile2" style="width:100px">';
		$html .= '<option value="true" '.($this->getValue('fusszeile2')===true?'selected':'').'>On</option>';
		$html .= '<option value="false" '.($this->getValue('fusszeile2')===false?'selected':'').'>Off</option>';
		$html .= '</select> ';
		$html .= '</div>';      	
				
		// Hochscrollen
		$html .= '<div>';
		$html .= '<label>'.$Language->get('bezeichnung_hochscrollen').'</label>';
		$html .= '<select name="hochscrollenAnAus" style="width:100px">';
		$html .= '<option value="true" '.($this->getValue('hochscrollenAnAus')===true?'selected':'').'>On</option>';
		$html .= '<option value="false" '.($this->getValue('hochscrollenAnAus')===false?'selected':'').'>Off</option>';
		$html .= '</select> ';
		$html .= '<input name="bezeichnung2" type="text" value="'.$this->getValue('bezeichnung2').'">';
		$html .= '<div style="size:small">('.$Language->get('bezeichnung_beschreibung').')</div>';
		$html .= '</div>';		

        // Hochscrollen Text-Hintergrundfarbe
		$html .= '<div>';
		$html .= '<label>'.$Language->get('bezeichnung_hochscrollen_farbe').'</label>';
		$html .= '<input name="bezeichnung_hochscrollen_farbe" type="text" value="'.$this->getValue('bezeichnung_hochscrollen_farbe').'">';
		$html .= '<div style="size:small">('.$Language->get('bezeichnung_hochscrollen_farbe_beschreibung').')</div>';
		$html .= '</div>';
		
		
		// Fusszeile Hintergrundfarbe
		$html .= '<div>';
		$html .= '<label>'.$Language->get('fusszeile_farbe').'</label>';
		$html .= '<input name="fusszeile_farbe" type="text" value="'.$this->getValue('fusszeile_farbe').'">';		
		$html .= '</div>';		

        $html .= '<hr>';
        
		// Eigene Fuﬂzeile
		$html .= '<div>';
		$html .= '<label>'.$Language->get('eigene_fusszeile').'</label>';
		$html .= '<select name="eigeneFusszeileAnAus" style="width:100px">';
		$html .= '<option value="true" '.($this->getValue('eigeneFusszeileAnAus')===true?'selected':'').'>On</option>';
		$html .= '<option value="false" '.($this->getValue('eigeneFusszeileAnAus')===false?'selected':'').'>Off</option>';
		$html .= '</select><br> ';
		$html .= '<textarea name="eigene_fusszeile" type="text">'.$this->getValue('eigene_fusszeile').'</textarea>';
		//$html .= '<div style="size:small">('.$Language->get('bezeichnung_beschreibung').')</div>';
		$html .= '</div>';        

		return $html;
	}




//  Nach dem Body
  public function siteBodyBegin() {
  	global $Language;  
  
    if ($this->getValue('eigeneFusszeileAnAus') == 1) {
     // TODO: Wenn Eigene Fusszeile eingeschaltet, dann "fusszeile2" ausschalten; Entweder die Standart Fusszeile oder die eigene
       // $this->setValue('fusszeile2','0');
       // $this->dbFields['fusszeile2'] = 'False';         
    }		
          
  
    if ($this->getValue('LogoAnAus2') == 1)     {   echo '<img id="logo" src="'.$this->getValue('bezeichnung_logo2').'">';   }
    if ($this->getValue('fusszeile2') == 1)     {   echo '<div id="fusszeile">';       }
    
    
    
   
    $farbe = '';  if (  trim($this->getValue('bezeichnung_hochscrollen_farbe')) <> "" )  
    { $farbe = 'style="background-color: '. trim($this->getValue('bezeichnung_hochscrollen_farbe').';"');          }
    
    if ($this->getValue('eigeneFusszeileAnAus') == 1) { 
        echo '<div id="fusszeile">'; 
        echo html_entity_decode($this->getValue('eigene_fusszeile'));
           
    }
       
    if ($this->getValue('hochscrollenAnAus') == 1) {  echo '<a href="#top" '.$farbe.'> '.$this->getValue('bezeichnung2').' </a>'; }  
    
    if ($this->getValue('eigeneFusszeileAnAus') == 1) {  echo '</div>'; }
    if ($this->getValue('fusszeile2') == 1)     {   echo '</div>';  }
  }   // function sitebody



        // Im Head Bereich
      public function siteHead() {
         $hintergrund = '';            
         if (trim($this->getValue('fusszeile_farbe')) <> '')       {  $hintergrund = 'background: '.$this->getValue('fusszeile_farbe').';';    }
        
            return '
<style>
<!--
#logo {
    position: fixed;
    float:right;
    z-index: -10;
    opacity: 0.2;
    text-align: right;
   /* width: 234px;
    height: 123px;  */
    margin: 50px;    
    /*border:1px solid red;*/
} 


#fusszeile
{
  position: fixed; 
  left: 0px;
  bottom: 0px; 
  height: 64px;
  width: 100%; 
  //background: #E0E0E0;
  //background: white;
  '.$hintergrund.'
  text-align: center;
  z-index: 100;
  }
-->
</style>';
        }
    }    
?>