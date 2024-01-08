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
+   ``after`` series files capture my sed-manipulated sql-formatter output attempting to correct for delimiter usage


## Observed to this point

+   output from sql-formatter combines lines that do not end with ``;``
+   lines using delimiters _other than_ `;` will be combined with the next line of source
+   the effect of combining lines by sql-formatter can be seen in the interim files

## Results

+   after initial panic, discovered my workflow (``before_01``) was unaffected by new version of sql-formatter
+   problems appear related to use of __BEGIN__..__END__ for a compound statement
+   reported failure (``before_00``) has only the __BEGIN__ keyword.
+   experimented with variants of failure in versions ``_02`` to ``_05`` which appear, to my satisfaction, to point to practice around use of __BEGIN__ and __END__

## Conclusion

Either of two mods to the original (00) report may address the issue, _in my environment._

1. as in ``before_04``, moving the delimiter statement to the beginning and including within its scope the ``drop procedure...`` statement, or
1. as in ``before_03``, converting from a simple statement to a compound statement

either way, the key appears to be making the delimiter declaration earlier and including the ``drop procedure`` statement.
Essentially, I think that means making an alternative delimiter apply to the _entire file_ as a practice, rather than use
SQL's flexibility to switch back-and-forth on-the-fly.
