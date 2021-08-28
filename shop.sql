--
-- Base de données :  `shop`
--
CREATE DATABASE IF NOT EXISTS shop CHARACTER SET utf8;
USE shop;
-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marque` varchar(40) COLLATE utf16_bin NOT NULL,
  `nom` varchar(40) COLLATE utf16_bin NOT NULL,
  `prix` decimal(9,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `marque`, `nom`, `prix`) VALUES
(1, 'stop dust', 'aspirateur 5000', '150.00'),
(2, 'toupropre', 'machine à lessiver 2000', '500.00'),
(3, 'vitaminix', 'blender 1000', '250.00'),
(4, 'hal computer', 'peer', '1500.00');
COMMIT;
