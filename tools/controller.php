<?php
declare(strict_types=1);

//root page
function home() :array{
	$title="Rapide plombier";
	$description = "Rapide plombier accueil";
	ob_start();
	require_once "view/views/home.php";
	$contenu=ob_get_clean();
	return compact("title", "contenu");
}

function realisations() :array{
	$title = "Réalisations" ;
	$description = "realisations";
	ob_start();
	require_once 'view/views/realisations.php' ;
	$contenu=ob_get_clean();
	return compact("title", "contenu");
}

function commentaires() :array{
	$title = "Commentaires" ;
	$description = "commentaires";
	ob_start();
	require_once 'view/views/commentaires.php' ;
	$contenu=ob_get_clean();
	return compact("title", "contenu");
}

function commentairesNoJS() :array{
	$title = "Commentaires" ;
	$description = "commentairesNoJS";
	ob_start();
	require_once 'view/views/commentairesNoJS.php' ;
	$contenu=ob_get_clean();
	return compact("title", "contenu");
}

function contact() :array{
	$title = "Me contacter" ;
	$description = "contact";
	ob_start();
	require_once 'view/views/contact.php' ;
	$contenu=ob_get_clean();
	return compact("title", "contenu");
}

function contactNoJS() :array{
	$title = "Me contacter" ;
	$description = "contactNoJS";
	ob_start();
	require_once 'view/views/contactNoJS.php' ;
	$contenu=ob_get_clean();
	return compact("title", "contenu");
}

function erreur404() :array{
	$title = "erreur 404" ;
	$description = "404";
	ob_start();
	require_once 'view/views/erreur404.php' ;
	$contenu=ob_get_clean();
	return compact("title", "contenu");
}