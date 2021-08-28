<?php

/**
 * Description of Article
 *
 * @author martel
 */
class Article implements JsonSerializable {

// Interface JsonSerializable permet de convertir l'objet
// en JSON (via json_encode) par la méthode jsonSerialize

    /*
     * Propriétés
     */
    private $id;
    private $marque;
    private $nom;
    private $prix;    

    /**
     * 
     * @param array $datas tableau des données d'hydratation de l'objet
     */
    public function __construct(array $datas) {
        if (!empty($datas)) {
            $this->hydrate($datas);
        }
    }

    /**
     * 
     * @param array $datas tableau des données d'hydratation de l'objet
     */
    public function hydrate(array $datas) {
        foreach ($datas as $cle => $valeur) {
            $nomMethode = "set" . ucfirst($cle);
            if (method_exists($this, $nomMethode)) {
                $this->$nomMethode($valeur);
            }
        }
    }

    /**
     * Méthode de sérialisation de l'objet en JSON
     */
    public function jsonSerialize() {
        return get_object_vars($this);
    }

    /*
     * Zone des Getters
     */
    public function getId() {
        return $this->id;
    }

    public function getMarque() {
        return $this->marque;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrix() {
        return $this->prix;
    }


    /*
     * Zone des Setters
     */

    public function setId($id) {
        $this->id = $id;
    }

    public function setMarque($marque) {
        $this->marque = $marque;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

}
