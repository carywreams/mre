-- original reported example (FAILS)
-- after version: FAILS
DROP      PROCEDURE IF EXISTS `Test`;
DELIMITER $$ CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `Test` () NO SQL
SELECT    1 $$ DELIMITER;
