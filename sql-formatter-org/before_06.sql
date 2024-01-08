-- before_05 with delimiter statement move to original sequence
-- after version: generates no error; does not define before_06, executes select upon load attempt

drop procedure if exists before_06 ;
delimiter $$
CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `before_06`()
NO SQL
    select 1$$
delimiter ;
