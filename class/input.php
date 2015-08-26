<?php
/**
 * Created by PhpStorm.
 * User: sir
 * Date: 16/12/14
 * Time: 10:50
 */

class input {


    function getText($objet)
    {
        $libelle = str_replace('get', '', __FUNCTION__);
        $objetId = get_class($objet).'-'.$objet->getId();
        $template = <<< TPL
        <form>
        <input type="text" name="$objetId">
        <input class="btn btn-default" type="submit" name="$libelle">
        </form>
TPL;
        echo $template;
        return $template;
    }

    function getSuivant($objet)
    {
        $libelle = str_replace('get', '', __FUNCTION__);
        $objetId = $objet->getId();
        $template = <<< TPL
        <form method="post">
        <input type="hidden" name="developpement" value="$objetId">
        <input class="btn btn-default btn-success btn-xs" type="submit" name="action" value="Avancer">
        </form>
TPL;
        echo $template;
        return $template;
    }

    function getSupprimer($objet)
    {
        $libelle = str_replace('get', '', __FUNCTION__);
        $objetId = $objet->getId();
        $template = <<< TPL
        <form method="post">
        <input type="hidden" name="developpement" value="$objetId">
        <input class="btn btn-default btn-info btn-xs" type="submit" name="action" value="Supprimer">
        </form>
TPL;
        echo $template;
        return $template;
    }

    function getTerminer($objet)
    {
        $libelle = str_replace('get', '', __FUNCTION__);
        $objetId = $objet->getId();
        $template = <<< TPL
        <form method="post">
        <input type="hidden" name="developpement" value="$objetId">
        <input class="btn btn-default btn-danger btn-xs" type="submit" name="action" value="Terminer">
        </form>
TPL;
        echo $template;
        return $template;
    }

    function getPrecedent($objet)
    {
        $libelle = str_replace('get', '', __FUNCTION__);
        $objetId = $objet->getId();
        $template = <<< TPL
        <form method="post">
        <input type="hidden" name="developpement" value="$objetId">
        <input class="btn btn-default btn-warning btn-xs" type="submit" name="action" value="Reculer">
        </form>
TPL;
        echo $template;
        return $template;
    }
    function getCommenter($objet)
    {
        $libelle = str_replace('get', '', __FUNCTION__);
        $objetId = $objet->getId();
        $template = <<< TPL
        <form method="post">
        <input type="hidden" name="developpement" value="$objetId">
        <textarea class="breadcrumb" name="commentaire"></textarea>
        <input class="btn btn-default btn-xs" type="submit" name="action" value="Commenter">
        </form>
TPL;
        echo $template;
        return $template;
    }
}

?>
