<?php
/**
 * Created by PhpStorm.
 * User: sir
 * Date: 15/12/14
 * Time: 15:13
 */
class fichierModifie
{
    private $nom;
    private $depot;
    private $debutModif;
    private $finModif;

    function __construct($nom, $depot)
    {
        $this->debutModif = time();
        $this->finModif = time();
    }
}