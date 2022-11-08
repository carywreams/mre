include config.mk

DATA_SRC = $(wildcard *.sql)
PDF_SRC = $(wildcard *.Rmd)
PDF_DST = $(patsubst %.Rmd,%.pdf,$(PDF_SRC))
PNG_SRC = $(wildcard *-png.R)
PNG_DST = $(patsubst %-png.R,%.png,$(PNG_SRC))

# PANDOC Options for complete Syllabus
# SYLOPT = --toc --toc-depth=2 --number-sections
SYLOPT = -V margin-left=2.5cm -V margin-right=2.5cm \
	-V margin-top=2cm -V margin-bottom=1.25in
# convert to pdf
# compress pdf with ps2pdf

%.png: %-png.R floc.dat
	@./$<
	#-----------------------------------------------------
	@ls -al $@

%.pdf: %.Rmd src.dat
	@$(LORX) --no-echo --silent -e "rmarkdown::render('$<',output_format='pdf_document',output_file='_tmp.pdf',quiet=TRUE)"
	@$(LOPS2PDF) _tmp.pdf $@
	@$(LODEL) _tmp.pdf
	#-----------------------------------------------------
	@ls -al $@

pdf: $(PDF_DST)

png: $(PNG_DST)

clean:
	rm -f $(PDF_DST) $(PNG_DST)

all: $(PDF_DST) $(PNG_DST)

.PHONY: clean all pdf png
