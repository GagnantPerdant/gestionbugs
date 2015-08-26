<?php
/**
 * Created by PhpStorm.
 * User: sir
 * Date: 15/12/14
 * Time: 15:14
 */
class projet
{
    private $id_projet;
    private $nom = 'nouveau projet';
    private $developpements = array();

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id_projet;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    function addDeveloppement($developpement)
    {
        $this->developpements[] = $developpement;
        return $developpement;
    }

    function getAllDeveloppements()
    {
        return $this->developpements;
    }

    function getDeveloppements($etat)
    {
        $return = array();
        $developpements = $this->developpements;
        foreach($developpements AS $developpement)
        {
            if($developpement->getEtatDev()->getEtat() == $etat)
            {
                $return[] = $developpement;
            }
        }
        return $return;
    }

    function __construct($id, $nom)
    {
        $this->id_projet = $id;
        $this->nom = $nom;
    }
}