<?php
/**
 * Created by PhpStorm.
 * User: sir
 * Date: 15/12/14
 * Time: 15:12
 */
class typeDev
{
    private static $etats = array('Correction bug', 'Ajout fonctionnalite', 'Test', 'Autre');
    private $etat = 0;

    function __construct($etat = 0)
    {
        $this->etat = $etat;
        return $this;
    }

    /**
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    function getEtatLabel()
    {
        return self::$etats[$this->etat];
    }

    static function getTypesDev()
    {
        return self::$etats;
    }

}