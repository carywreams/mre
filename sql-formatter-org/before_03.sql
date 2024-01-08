-- before_02 + embedded create comment
-- after version: PASSES

delimiter $$

drop procedure if exists before_03 $$

CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `before_03`()
NO SQL
BEGIN
    select 1;
END $$

delimiter ;
