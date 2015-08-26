<?php
include 'fonctions-interface.php';

class bdd implements fonctions_interface
{
	private $db;
	
	private function recho($sql)
	{
		echo '<!-- '.$sql.'-->'."\r\n";
	}
	
	public function ajoutProjet($nom)
	{
		$sql = "INSERT INTO projet('nom') VALUES ('$nom')";
		$this->recho($sql);
		$result = $this->req($sql);
	}

	public function ajoutDeveloppement($projet, $description, $typeDev, $prioriteDev)
	{
		$sql = "INSERT INTO developpement('id_projet', 'description', 'id_typeDev', 'id_prioriteDev', 'date') VALUES ('$projet', '$description', '$typeDev', '$prioriteDev', ".time().")";
		$this->recho($sql);
		$result = $this->req($sql);
	}

	public function ajoutCommentaire($developpement, $commentaire)
	{
		$sql = "INSERT INTO commentaire('id_developpement', 'commentaire') VALUES ('$developpement', '".$commentaire->getCommentaire()."')";
		$this->recho($sql);
		$result = $this->req($sql);
	}

	public function ajoutFichier($developpement, $fichier)
	{
		$sql = "INSERT INTO fichier('id_developpement', 'fichier') VALUES ($developpement, $fichier)";
	}

	public function supprimerDeveloppement($developpement)
	{
		$sql = "DELETE FROM developpement WHERE id_developpement = '".$developpement->getId()."'";
		$this->recho($sql);
		$result = $this->req($sql);
	}

	public function modifierEtatDeveloppement($developpement)
	{
		$sql = "UPDATE developpement SET id_etatDev = '".$developpement->getEtatDev()->getEtat()."' WHERE id_developpement = '".$developpement->getId()."'";
		$this->recho($sql);
		$result = $this->req($sql);
	}

	public function modifierPrioriteDeveloppement($developpement)
	{
		$sql = "UPDATE developpement SET id_prioriteDev = '".$developpement->getPrioriteDev()."' WHERE id_developpement = '".$developpement->getId()."'";
	}

	public function getProjets()
	{
		$sql = "SELECT * FROM projet;";
		$projets = $this->req($sql);
		$objetsProjet = array();
		foreach($projets AS $projet)
		{
			$objetsProjet[] = new projet($projet['id_projet'], $projet['nom']);
		}
		return $objetsProjet;
	}

	public function getProjet($projet)
	{
		$sql = "SELECT * FROM projet WHERE id_projet = '$projet' LIMIT 1;";
		$projets = $this->req($sql);
		$objetsProjet = array();
		foreach($projets AS $projet)
		{
			$objetsProjet = new projet($projet['id_projet'], $projet['nom']);
		}
		return $objetsProjet;
	}

	public function getDeveloppements($projet)
	{
		$sql = "SELECT * FROM developpement WHERE id_projet = '".$projet->getId()."' ORDER BY id_prioriteDev, id_typeDev, date ASC;";
		$this->recho($sql);
		$developpements = $this->req($sql);
		$objetsDeveloppement = array();
		foreach($developpements AS $developpement)
		{
			$objetsDeveloppement[] = new developpement($projet, $developpement['id_developpement'], $developpement['description'], $developpement['id_etatDev'], $developpement['id_typeDev'], $developpement['id_prioriteDev'], $developpement['date']);
		}
		return $objetsDeveloppement;
	}

	public function getAllDeveloppementsByEtat($id_etatDev)
	{
		$sql = "SELECT * FROM developpement WHERE id_etatDev = '$id_etatDev' ORDER BY id_prioriteDev, id_typeDev, date ASC;";
		$this->recho($sql);
		$developpements = $this->req($sql);
		$objetsDeveloppement = array();
		foreach($developpements AS $developpement)
		{
			$projet = $this->getProjet($developpement['id_projet']);
			$objetDeveloppement = new developpement($projet, $developpement['id_developpement'], $developpement['description'], $developpement['id_etatDev'], $developpement['id_typeDev'], $developpement['id_prioriteDev'], $developpement['date']);
			$commentaires = $this->getCommentaires($developpement['id_developpement']);
			foreach($commentaires AS $commentaire)
			{
				$objetDeveloppement->addCommentaire($commentaire);
			}
			$objetsDeveloppement[] = $objetDeveloppement;
		}
		return $objetsDeveloppement;
	}

	public function getDeveloppement($developpement_id)
	{
		$sql = "SELECT * FROM developpement WHERE id_developpement = '$developpement_id' LIMIT 1;";
		$this->recho($sql);
		$developpements = $this->req($sql);
		$objetsDeveloppement = null;
		foreach($developpements AS $developpement)
		{
			$objetsDeveloppement = new developpement($developpement['id_projet'], $developpement['id_developpement'], $developpement['description'], $developpement['id_etatDev'], $developpement['id_typeDev'], $developpement['id_prioriteDev'], $developpement['date']);
		}
		return $objetsDeveloppement;
	}

	public function getCommentaires($developpement)
	{
		$sql = "SELECT * FROM commentaire WHERE id_developpement='$developpement' ORDER BY id_commentaire;";
		$this->recho($sql);
		$commentaires = $this->req($sql);
		$objetsCommentaire = array();
		foreach($commentaires AS $commentaire)
		{
			$objetsCommentaire[] = new commentaire($commentaire['commentaire']);
		}
		return $objetsCommentaire;
	}

	public function getFichiers($developpement)
	{
		$sql = "SELECT * FROM fichier WHERE id_developpement='$developpement' LIMIT 1;";
	}

	public function initDb($file)
	{
		$sql = <<< SQL
	CREATE TABLE "main"."projet" (
	"id_projet" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL DEFAULT (0),
    "nom" TEXT
	);

	CREATE TABLE developpement (
    "id_developpement"  INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL DEFAULT (0),
    "id_projet" INTEGER,
    "description" TEXT NOT NULL,
    "id_typeDev" INTEGER DEFAULT (0),
    "id_prioriteDev" INTEGER DEFAULT (0),
    "id_etatDev" INTEGER DEFAULT (0),
    "date" INTEGER DEFAULT ('now')
	);

	CREATE TABLE "main"."commentaire" (
    "id_commentaire" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL DEFAULT (0),
    "id_developpement" INTEGER,
    "commentaire" TEXT
	);

	CREATE TABLE "main"."fichier" (
    "id_fichier" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL DEFAULT (0),
    "id_developpement" INTEGER,
    "fichier" TEXT
	);



SQL;
	}

	public function __construct()
	{
		$this->db = new PDO("sqlite:db/bugs.db");
	}

	public function req($sql)
	{
		$statement = new PDOStatement();
		$statement = $this->db->query($sql);
		$projets = $statement->fetchAll();
		return $projets;
	}
}
