-- add nonsensical delimiter statement to move away from double dollar
delimiter DLMTR184
DROP Procedure IF EXISTS `Test` DLMTR184 CREATE /* DEFINER=`zeugnis_nm_dev`@`localhost` */ PROCEDURE `Test` () NO SQL
Select
  1;

END DLMTR184 delimiter;
