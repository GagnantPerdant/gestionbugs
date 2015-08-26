<html>
<head>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="css/bootstrap-theme.css">
    <title>Gestion Bugs v3</title></head>

<body>

<h1 class="caption" id="titre">Gestion projets</h1>

<?php foreach ($workspaces AS $workspace) : ?>

<div>

    <div id="listetaches" style="float: left;width: 74%">

        <?php
        $ordreEtats = array(5,3,4,1,2,0,6);
        $nbEtats = etatDev::getNbEtats();
        $etatDev = new etatDev(0);
        //for($i = 0; $i < $nbEtats; $i++) :
        foreach($ordreEtats AS $i) :
            $etatDev->setEtat($i);
            $developpementParEtat = $db->getAllDeveloppementsByEtat($i);
            $affichageEtatDev = (count($developpementParEtat) < 1 ? 'display:none;' : '');
            ?>
            <h3 style="background-color: <?php echo $etatDev->getEtatCouleur().';'.$affichageEtatDev ?>"><?php echo $etatDev->getEtatLabel() ?><br><?php str_repeat('=',strlen($etatDev->getEtatLabel())) ?></h3>
            <div style="<?php echo $affichageEtatDev ?>">
                <?php foreach ($developpementParEtat AS $developpement) : ?>
                    <div>
                        <div class="well well-sm" style="display: inline-block; width: 100%;">
                            <div style="display: inline-block; width: 100%;">
                                <div style="display: inline-block;">
                                    <span class="badge"><?php echo $developpement->getNomProjet() ?></span>
                                    <span class="badge"><?php echo $developpement->getTypeDev()->getEtatLabel() ?></span>
                                <span class="badge">
                                    <?php echo $developpement->getPrioriteDev()->getEtatLabel() ?>
                                </span>
                                <h6 class="text-info" style="display: inline">
                                    <?php echo $developpement->getdate() ?>
                                </h6>
                                </div>
                            </div>

                            <div style="padding: 1px; background: #f5f5f5; border-color: darkgray">
                                <div style="float: right; height: 25px; width: 65px; overflow: hidden" onmouseout="this.style.height='25px'; this.style.width='65px'; " onmouseover="this.style.height='auto'; this.style.width='auto'; ">
                                    <div style="display: inline-block">
                                        <?php
                                        $btnSuivant = new input();
                                        $btnSuivant->getSuivant($developpement);
                                        ?>
                                    </div>
                                    <div style="display: inline-block">
                                        <?php
                                        $btnPrecedent = new input();
                                        $btnPrecedent->getPrecedent($developpement);
                                        ?>
                                    </div>
                                    <div style="display: inline-block">
                                        <?php
                                        $btnTerminer = new input();
                                        $btnTerminer->getTerminer($developpement);
                                        ?>
                                    </div>
                                    <div style="display: inline-block">
                                        <?php
                                        $btnSupprimer = new input();
                                        $btnSupprimer->getSupprimer($developpement);
                                        ?>
                                    </div><br>
                                    <div style="display: inline-block">
                                        <?php
                                        $btnCommenter = new input();
                                        $btnCommenter->getCommenter($developpement);
                                        ?>
                                    </div>
                                </div>
                                <h6>
                                    <div><strong><?php echo $developpement->getDescription() ?></strong></div>
                                    <?php foreach ($developpement->getCommentaires() AS $commentaire) : ?>
                                        <div><?php echo $commentaire->getCommentaire() ?></div>
                                    <?php endforeach; ?>
                                </h6>
                            </div>

                            <ul>
                                <?php foreach ($developpement->getFichiersModifies() AS $fichierModifie) : ?>
                                    <li>
                                        <div><?php echo count($developpement->getFichiersModifies()) ?> fichiers modifies</div>
                                    </li>

                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <?php endforeach; ?>

    </div>

    <div id="listeprojets" style="float: right;width: 25%">
        <h2>Projets</h2>
        <div id="formajoutprojet">
            <form method="post">
                <input class="breadcrumb" type="text" name="nom"><br/>
                <input class="btn btn-default" type="submit" name="action" value="Ajouter un projet">
            </form>
        </div>
        <?php foreach($projets AS $projet) : ?>

            <div id="formajoutdeveloppement" style="float: right; height: 50px; width: 100%; overflow: hidden" onmouseout="this.style.height='50px'" onmouseover="this.style.height='auto'">
                <h3 style="background-color: #BFE3BF;color: green;"><?php echo $projet->getNom() ?></h3>
                <form method="post">
                    <textarea class="breadcrumb" name="description"></textarea>
                    <select class="breadcrumb" name="typeDev">
                        <?php foreach(typeDev::getTypesDev() AS $key => $value) : ?>
                            <option value="<?php echo $key ?>"><?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select class="breadcrumb" name="prioriteDev">
                        <?php foreach(prioriteDev::getPrioriteDev() AS $key => $value) : ?>
                            <option value="<?php echo $key ?>"><?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="projet" value="<?php echo $projet->getId() ?>">
                    <input class="btn btn-default btn-xs" type="submit" name="action" value="Ajouter un developpement">
                </form>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<div class="debug" style="display: none">
    <pre><?php echo var_dump($workspaces) ?></pre>
</div>


</body>
</html>
