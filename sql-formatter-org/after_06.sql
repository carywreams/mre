-- before_05 with
delimiter ;
-- after version: generates no error; does not define before_06, executes select upon load attempt
DROP      PROCEDURE IF EXISTS before_06;
delimiter $$ CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `before_06` () NO SQL
SELECT    1 $$
delimiter ;
