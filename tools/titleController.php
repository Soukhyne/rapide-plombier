<?php
declare(strict_types=1);

function interactiveNav() :void{
    $links = [
        'index.php?page=home' => 'Accueil',
        'index.php?page=realisations' => 'Réalisations',
        'index.php?page=commentaires' => 'Commentaires',
        'index.php?page=contact' => 'Contact'
    ];
    foreach ($links as $link => $title) {
        $classeNav = '';
        
        if ($_SERVER['REQUEST_URI'] === ("/Projet-Ecole-V12/" . $link)) {
            $classeNav = ' class="active"';
        }
        $nav = '<a' . $classeNav . ' href="' . $link . '">' . $title . '</a>';
        echo $nav;
    }
}