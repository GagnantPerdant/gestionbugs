<?php
/**
 * Created by PhpStorm.
 * User: sir
 * Date: 22/12/14
 * Time: 06:29
 */

class commentaire {

    private $id_commentaire;
    private $id_developpement;
    private $commentaire;

    function __construct($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return ($this->commentaire);
    }



}