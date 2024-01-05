AFTER:= $(patsubst before%.sql,after%.sql,$(wildcard before_*.sql))
INTERIM:= $(patsubst before%.sql,interim%.sql,$(wildcard before_*.sql))

interim_%.sql: before_%.sql
	npx sql-formatter --config sql-formatter.json $< > $@

after_%.sql: interim_%.sql
	sed 's/\sdelimiter.*/\ndelimiter ;/g' $< > $@

clean:
	rm -f $(AFTER)
	rm -f $(INTERIM)

all: $(AFTER) $(INTERIM)

.PHONY: all clean

# ORIG npx sql-formatter -l mysql --config sql-formatter.json $< | sed 's/\sdelimiter.*/\ndelimiter ;/g' > $@
