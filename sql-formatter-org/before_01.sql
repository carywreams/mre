
#include NOTICE

delimiter $$

drop procedure if exists before_01 $$

create procedure before_01()
begin
    with
    #include cte00.cte
    ,
    #include cte01.cte

    select
        cte00.*,
        cte01.*

    from cte00
    join cte01;

end $$

delimiter ;
