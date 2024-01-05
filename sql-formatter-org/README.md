# sql-formatter-org issue 184, re ad-hoc support for delimiter support

+   [original report of failure](https://github.com/sql-formatter-org/sql-formatter/issues/184#issuecomment-1860370692)
+   [source of before_00.sql snippet](https://github.com/sql-formatter-org/sql-formatter/issues/184#issuecomment-1877062290)

## My Goal

I use sql-formatter as part of my workflow to build stored procedures from
one or more CTEs that may be used in one or more stored procedures (CTE re-use).
Generally, I have the following practices, which narrows the scope of the solution
I'm in search of:

+   each CTE is defined in its own file, so that it may be included in a stored procedure source file via gpp
+   each stored procedure is defined in a single file
+   each stored procedure includes an ``END`` statement
+   each stored procedure file features a delimiter statement at the beginning of the file and a balancing delimiter statement at the end of the file:

```
delimiter $$

drop procedure if exists procedure_name $$

create procedure procedure_name ()
BEGIN

    #include cte00.sql
    ,
    #include ctr00.sql
.
.
.
END $$

delimiter ;
```

## Filenames and Purposes

+   ``before`` series files capture originally authored input to be formatted
+   ``interim`` series files capture sql-formatter output
+   ``after`` series files capture my sed-manipulated sql-formatter output attempting to correct for delimiter usage


## Observed to this point

+   output from sql-formatter combines lines that do not end with ``;``
+   lines using delimiters _other than_ `;` will be combined with the next line of source
+   the effect of combining lines by sql-formatter can be seen in the interim files


## CONFIG Changes

had to remove these config entries after upgrading to sql-formatter v15.0.2

```
  "commaPosition": "after",
  "tabulateAlias": true,
```

currently using only two config options to specify my selection of mysql for
both the language and dialect options. Other than that, the default
sql-formatter options are being used.


## Results

### Interim

Only ``before_03`` passes unscathed through sql-formatter


```
cwr@x1g11:[sql-formatter-org]$ mysql inpowering_packet < interim_00.sql
1
1
ERROR 1064 (42000) at line 5: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'DELIMITER' at line 1
cwr@x1g11:[sql-formatter-org]$ mysql inpowering_packet < interim_01.sql
ERROR 1064 (42000) at line 3: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'END' at line 1
cwr@x1g11:[sql-formatter-org]$ mysql inpowering_packet < interim_02.sql
ERROR 1064 (42000) at line 3: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'END' at line 1
cwr@x1g11:[sql-formatter-org]$ mysql inpowering_packet < interim_03.sql
```
