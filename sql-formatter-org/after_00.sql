-- original reported example
DROP      Procedure IF EXISTS `Test`;

DELIMITER $$ CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `Test` () NO SQL
Select    1 $$ DELIMITER;
