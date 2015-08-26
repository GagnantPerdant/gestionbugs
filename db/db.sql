CREATE TABLE "projet" (
    "id_projet" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL DEFAULT (0),
    "nom" TEXT
);
CREATE TABLE sqlite_sequence(name,seq);
CREATE TABLE "developpement" (
    "id_developpement" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL DEFAULT (0),
    "id_projet" INTEGER,
    "description" TEXT NOT NULL,
    "id_typeDev" INTEGER DEFAULT (0),
    "id_prioriteDev" INTEGER DEFAULT (0),
    "id_etatDev" INTEGER DEFAULT (0)
);
CREATE TABLE "commentaire" (
    "id_commentaire" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL DEFAULT (0),
    "id_developpement" INTEGER,
    "commentaire" TEXT
);
CREATE TABLE "fichier" (
    "id_fichier" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL DEFAULT (0),
    "id_developpement" INTEGER,
    "fichier" TEXT
);
