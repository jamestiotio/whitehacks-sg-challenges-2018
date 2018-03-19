CREATE DATABASE IF NOT EXISTS `vuln`;
USE `vuln`;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'whitehacks_admin_pw'),
(2, 'root', 'whitehacks_lamepassword');

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `product` (`id`, `type`, `brand`, `name`) VALUES
(1, 'Car', 'Honda', 'Civic'),
(2, 'Bread', 'Gardenia', 'White Bread'),
(3, 'Bread', 'Gardenia', 'Wholemeal Bread');