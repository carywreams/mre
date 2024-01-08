-- before_06 with select statement delimiter changed to semi-colon
-- after version: FAILS, executes select immediately

drop procedure if exists before_07 ;
delimiter $$
CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `before_07`()
NO SQL
    select 1;
delimiter  ;
