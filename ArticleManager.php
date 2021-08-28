<?php

/**
 * Description of ArticleManager
 *
 * @author alainmartel
 */
class ArticleManager {

    private $connexionDb = 0; //Objet PDO

    public function __construct($connexionDb) {
        $this->setConnexionDb($connexionDb);
    }

    public function setConnexionDb($connexionDb) {
        $this->connexionDb = $connexionDb;
    }

    public function getConnexionDb() {
        return $this->connexionDb;
    }

    /**
     * Insertion en DB de l'objet passé en paramètre
     * @param Article $article
     */
    public function create(Article $article) {
        $sql_query = 'INSERT INTO article SET '
                //        . 'id=:id, '
                . 'marque=:marque, '
                . 'nom=:nom, '
                . 'prix=:prix';

        $query = $this->getConnexionDb()->prepare($sql_query);

        //$query->bindValue(':id', $article->getId(), PDO::PARAM_INT);
        $query->bindValue(':marque', $article->getMarque());
        $query->bindValue(':nom', $article->getNom());
        $query->bindValue(':prix', $article->getPrix(), PDO::PARAM_INT);

        $query->execute();
    }

    /**
     * Sélectionne en DB l'objet dont l'id est passée en paramètre
     * @param type $id
     * @return \Article
     */
    public function read($id) {

        $sql_query = 'SELECT *'
                . 'FROM article '
                . 'WHERE id = ' . $id;

        $query = $this->getConnexionDb()->query($sql_query);

        $datas = $query->fetch(PDO :: FETCH_ASSOC);

        return new Article($datas);
    }

    /**
     * Sélectionne tous les objets en DB (si paramètre $limit pas positionné)
     * @param type $limit = nombre de données à retourner par le SELECT
     * @return \Article
     */
    public function readAll($limit = NULL) {
        $articles = array();

        $sql_query = 'SELECT * '
                . 'FROM article '
                . 'ORDER BY id';

        if (is_int($limit) && $limit > 0) {
            $sql_query .= ' LIMIT ' . $limit;
        }

        $query = $this->getConnexionDb()->query($sql_query);

        while ($datas = $query->fetch(PDO :: FETCH_ASSOC)) {
            $articles [] = new Article($datas);
        }

        return $articles;
    }

    /**
     * Mise à jour en DB de l'objet passé en paramètre
     * @param Article $article
     */
    public function update(Article $article) {
        $sql_query = 'UPDATE article SET '
                . 'id=:id, '
                . 'marque=:marque, '
                . 'nom=:nom, '
                . 'prix=:prix '
                . 'WHERE id=:id';

        $query = $this->getConnexionDb()->prepare($sql_query);

        $query->bindValue(':id', $article->getId(), PDO::PARAM_INT);
        $query->bindValue(':marque', $article->getMarque());
        $query->bindValue(':nom', $article->getNom());
        $query->bindValue(':prix', $article->getPrix(), PDO::PARAM_INT);

        $query->execute();
    }

    /**
     * Supprime en DB l'objet passé en paramètre
     * @param Article $article
     */
    public function delete($id) {
        $sql_query = 'DELETE '
                . 'FROM article '
                . 'WHERE id = ' . $id;

        $this->getConnexionDb()->exec($sql_query);
    }

}
