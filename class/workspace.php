<?php
/**
 * Created by PhpStorm.
 * User: sir
 * Date: 15/12/14
 * Time: 15:15
 */
class workspace
{
    private $projets = array();

    function addProjet($projet)
    {
        $this->projets[] = $projet;
        return $projet;
    }

    function getProjets()
    {
        return $this->projets;
    }

    function getAllDeveloppements()
    {
        $developpements = array();
        foreach($this->projets AS $projet)
        {
            $projetDeveloppements = $projet->getAllDeveloppements();
            foreach($projetDeveloppements AS $developpement)
            {
                $developpements[] = $developpement;
            }
        }
        return $developpements;
    }

    function getDeveloppements($etat)
    {
        $developpements = array();
        foreach($this->projets AS $projet)
        {
            $projetDeveloppements = $projet->getDeveloppements($etat);
            foreach($projetDeveloppements AS $developpement)
            {
                $developpements[] = $developpement;
            }
        }
        return $developpements;
    }

}
