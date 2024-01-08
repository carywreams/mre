-- before_00 + delimiter statement moved to beginning,
-- and no embedded comments,
-- and use of compound statement
-- after version : PASSES

delimiter $$

drop procedure if exists before_02 $$

create procedure before_02()
NO SQL
BEGIN
    select 1;
END $$

delimiter ;
