<?php
interface fonctions_interface
{
	public function ajoutProjet($nom);
	public function ajoutDeveloppement($projet, $description, $typeDev, $prioriteDev);
	public function ajoutCommentaire($developpement, $commentaire);
	public function ajoutFichier($developpement, $fichier);
	public function modifierEtatDeveloppement($developpement);
	public function modifierPrioriteDeveloppement($developpement);
	
	public function getProjets();
	public function getProjet($projet);
	public function getDeveloppements($projet);
	public function getDeveloppement($developpement);
	public function getCommentaires($developpement);
	public function getFichiers($developpement);

	public function initDb($file);

}
