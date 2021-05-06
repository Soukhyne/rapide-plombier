<?php
require_once 'tools/controller.php';

//acces to view home unless we have a GET
if(isset($_GET['page'])){
	$page = $_GET['page'] ;
} else { 
	$page = 'home';
}

// Switch : which $view must appear
switch($page) :
	case 'home' :
		$view= home();
	break;
	case 'realisations' :
		$view= realisations();
	break;
    case 'commentaires' :
        $view= commentaires();
    break;
	case 'commentairesNoJS' :
        $view= commentairesNoJS();
    break;
    case 'contact' :
        $view= contact();
    break;
	case 'contactNoJS' :
		$view= contactNoJS();
    break;
	default :
		$view= erreur404();
	break;
endswitch ;

extract($view);

// Acces to view
require_once 'view/template.php';