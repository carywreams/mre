-- before_04 with blank lines removed
-- after version: PASSES
delimiter $$
DROP      PROCEDURE IF EXISTS before_05 $$ CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `before_05` () NO SQL
SELECT    1 $$
delimiter ;
