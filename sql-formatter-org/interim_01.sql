-- my approach: delimiter first and last; add END statement
delimiter $$
DROP Procedure IF EXISTS `Test` $$ CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `Test` () NO SQL
Select
  1;

END $$ delimiter;
