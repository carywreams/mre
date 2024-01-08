-- before_02 + embedded create comment
-- after version: PASSES
delimiter $$
DROP      PROCEDURE IF EXISTS before_03 $$ CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `before_03` () NO SQL BEGIN
SELECT    1;
END $$
delimiter ;
