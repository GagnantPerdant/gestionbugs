<?php
/**
 * Created by PhpStorm.
 * User: sir
 * Date: 15/12/14
 * Time: 15:14
 */
class developpement
{
    private $description;
    private $commentaires = array();
    private $etatDev;
    private $typeDev;
    private $prioriteDev;
    private $fichiersModifies = array();
    private $parentProjet;
    private $id_developpement;
    private $date;

    function __construct(&$parent, $id_developpement, $description = "description du developpement", $id_etatDev = 0, $id_typeDev, $id_prioriteDev, $date)
    {
        $this->description = $description;
        $this->etatDev = new etatDev($id_etatDev);
        $this->typeDev = new typeDev($id_typeDev);
        $this->prioriteDev = new prioriteDev($id_prioriteDev);
        $this->parentProjet = $parent;
        //$this->parentProjetNom = $parent->getNom();
        $this->id_developpement = $id_developpement;
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return date('d/m/y [H:i]', $this->date);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id_developpement;
    }

    public function getNomProjet()
    {
        return $this->parentProjet->getNom();
    }

    /**
     * @return mixed
     */
    public function getParentProjet()
    {
        return $this->parentProjet;
    }

    /**
     * @param mixed $parentProjet
     */
    public function setParentProjet($parentProjet)
    {
        $this->parentProjet = $parentProjet;
    }

    /**
     * @return prioriteDev
     */
    public function getPrioriteDev()
    {
        return $this->prioriteDev;
    }

    /**
     * @param prioriteDev $prioriteDev
     */
    public function setPrioriteDev($prioriteDev)
    {
        $this->prioriteDev = $prioriteDev;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return ($this->description);
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * @param string $comment
     */
    public function addCommentaire($commentaire)
    {
        $this->commentaires[] = $commentaire;
    }


    /**
     * @return etatDev
     */
    public function getEtatDev()
    {
        return $this->etatDev;
    }

    /**
     * @param etatDev $etatDev
     */
    public function setEtatDev($etatDev)
    {
        $this->etatDev = $etatDev;
    }

    /**
     * @return typeDev
     */
    public function getTypeDev()
    {
        return $this->typeDev;
    }

    /**
     * @param typeDev $typeDev
     */
    public function setTypeDev($typeDev)
    {
        $this->typeDev = $typeDev;
    }

    /**
     * @return array
     */
    public function getFichiersModifies()
    {
        return $this->fichiersModifies;
    }

    /**
     * @param array $fichiersModifies
     */
    public function setFichiersModifies($fichiersModifies)
    {
        $this->fichiersModifies = $fichiersModifies;
    }

    function addFichierModifie($fichierModifie)
    {
        if (is_null($fichierModifie)) {
            $fichierModifie = new fichierModifie(null, null);
        }
        $this->fichiersModifies[] = $fichierModifie;
        return $fichierModifie;
    }

}