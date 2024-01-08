-- before03 + conversion to simple statement
-- after version: PASSES

delimiter $$

drop procedure if exists before_04 $$

CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `before_04`()
NO SQL
    select 1$$

delimiter ;
