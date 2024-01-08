-- before_06 with select statement
delimiter ;
-- after version: FAILS, executes select immediately
DROP      PROCEDURE IF EXISTS before_07;
delimiter $$ CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `before_07` () NO SQL
SELECT    1;
delimiter;
