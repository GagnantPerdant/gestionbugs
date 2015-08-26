<?php
require_once 'class/developpement.php';
require_once 'class/etatDev.php';
require_once 'class/fichierModifie.php';
require_once 'class/prioriteDev.php';
require_once 'class/projet.php';
require_once 'class/typeDev.php';
require_once 'class/workspace.php';
require_once 'class/input.php';
require_once 'class/fonctions-class.php';
require_once 'class/traitementRequete.php';
require_once 'class/commentaire.php';

date_default_timezone_set('Europe/Paris');

$wp = new workspace();
$workspaces[] = $wp;

/*
$newProjet = $wp->addProjet(null);
$newProjet->setNom('sellplace');
$newProjet2 = $wp->addProjet(null);
$newProjet2->setNom('cdiscount');

$newDeveloppement = $newProjet->addDeveloppement(null);
$newDeveloppement->setDescription('gros debugages');

$newDeveloppement->addFichierModifie(null);

$newDeveloppement->getEtatDev()->suivant();
$newDeveloppement->getEtatDev()->suivant();

$newDeveloppement2 = $newProjet->addDeveloppement(null);
$newDeveloppement2->setDescription('autres gros debugages');
$newDeveloppement22 = $newProjet->addDeveloppement(null);
$newDeveloppement22->setDescription('encore autres gros debugages');

$newDeveloppement3 = $newProjet2->addDeveloppement(null);
$newDeveloppement3->setDescription('developpement RAF');
$newDeveloppement3->getEtatDev()->suivant();
$newDeveloppement3->getEtatDev()->suivant();
$newDeveloppement3->getEtatDev()->suivant();
$newDeveloppement3->getEtatDev()->suivant();
$newDeveloppement3->getEtatDev()->suivant();
*/

$db = new bdd();

/* test POST */
//$_POST = array('description'=>'Virer l adware','typeDev'=>'2','prioriteDev'=>'6','projet'=>'5','action'=>'Ajouter un developpement');
if(!empty($_POST))
{
    foreach ($_POST AS $key => $value) {
        $value = str_replace("'"," ",$value);
        $_POST[$key] = $value;
        $val[] = "'$key'=>'$value'";
    }
    $valeurs = implode(',', $val);
}
//echo '$_POST'." = array($valeurs);";

if(!empty($_POST))
{
    traitementRequete::traitement();
}

$projets = $db->getProjets();
/*
foreach($projets AS $projet)
{
    $wp->addProjet($projet);
    $developpements = $db->getDeveloppements($projet);
    foreach($developpements AS $developpement)
    {
        $projet->addDeveloppement($developpement);
        $commentaires = $db->getCommentaires($developpement->getId());
        foreach($commentaires AS $commentaire)
        {
            $developpement->addCommentaire($commentaire);
        }
        echo print_r($developpement,true);
    }
}
*/
require_once 'vue.php';
