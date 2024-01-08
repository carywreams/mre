AFTER:= $(patsubst before%.sql,after%.sql,$(wildcard before_*.sql))

after_%.sql: before_%.sql
	gpp -I lib/ $< | npx sql-formatter --config sql-formatter.json  | sed 's/\sdelimiter.*/\ndelimiter ;/g' > $@

clean:
	rm -f $(AFTER)

all: $(AFTER)

.PHONY: all clean

# ORIG npx sql-formatter -l mysql --config sql-formatter.json $< | sed 's/\sdelimiter.*/\ndelimiter ;/g' > $@
