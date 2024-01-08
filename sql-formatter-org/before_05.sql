-- before_04 with blank lines removed
-- after version: PASSES

delimiter $$
drop procedure if exists before_05 $$
CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `before_05`()
NO SQL
    select 1$$
delimiter ;
