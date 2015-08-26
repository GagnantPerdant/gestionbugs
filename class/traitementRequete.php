<?php
require_once 'developpement.php';

/**
 * Created by PhpStorm.
 * User: sir
 * Date: 22/12/14
 * Time: 00:41
 */

class traitementRequete {

    static function traitement()
    {
        global $db;
        $action = $_POST['action'];
        switch($action)
        {
            case "Ajouter un projet":
                $nom = $_POST['nom'];
                $db->ajoutProjet($nom);
                break;

            case "Ajouter un developpement":
                $description = $_POST['description'];
                $projet = $_POST['projet'];
                $typeDev = $_POST['typeDev'];
                $prioriteDev = $_POST['prioriteDev'];
                $db->ajoutDeveloppement($projet, $description, $typeDev, $prioriteDev);
                break;
            case "Avancer":
                $developpement = $_POST['developpement'];
                $objetDeveloppement = $db->getDeveloppement($developpement);
                $objetDeveloppement->getEtatDev()->suivant();
                $db->modifierEtatDeveloppement($objetDeveloppement);
                break;
            case "Reculer":
                $developpement = $_POST['developpement'];
                $objetDeveloppement = $db->getDeveloppement($developpement);
                $objetDeveloppement->getEtatDev()->precedent();
                $db->modifierEtatDeveloppement($objetDeveloppement);
                break;
            case "Terminer":
                $developpement = $_POST['developpement'];
                $objetDeveloppement = $db->getDeveloppement($developpement);
                $objetDeveloppement->getEtatDev()->dernier();
                $db->modifierEtatDeveloppement($objetDeveloppement);
                break;
            case "Supprimer":
                $developpement = $_POST['developpement'];
                $objetDeveloppement = $db->getDeveloppement($developpement);
                $db->supprimerDeveloppement($objetDeveloppement);
                break;
            case "Commenter":
                $commentaire = $_POST['commentaire'];
                $developpement = $_POST['developpement'];
                $objetDeveloppement = $db->getDeveloppement($developpement);
                $objetCommentaire = new commentaire($commentaire);
                $db->ajoutCommentaire($developpement, $objetCommentaire);
                break;
        }
    }
}