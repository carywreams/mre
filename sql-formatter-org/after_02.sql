-- before_00 +
delimiter ;
-- and no embedded comments,
-- and use of compound statement
-- after version : PASSES
delimiter $$
DROP      PROCEDURE IF EXISTS before_02 $$
CREATE    PROCEDURE before_02 () NO SQL BEGIN
SELECT    1;
END $$
delimiter ;
