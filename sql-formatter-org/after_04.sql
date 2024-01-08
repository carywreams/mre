-- before03 + conversion to simple statement
-- after version: PASSES
delimiter $$
DROP      PROCEDURE IF EXISTS before_04 $$ CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `before_04` () NO SQL
SELECT    1 $$
delimiter ;
