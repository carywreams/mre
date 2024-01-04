SRC:=$(sort $(wildcard *.php))
DST:=$(patsubst %.php,%.pdf,$(SRC))

%.pdf: %.php
	php8.1 <$^ >$@

all: clean $(DST)
	file $(DST)

clean:
	rm -rf *.pdf

.PHONY: clean all
