#!/usr/bin/Rscript
suppressMessages(library(tidyverse))
suppressMessages(library(gt))
suppressMessages(library(glue))
suppressMessages(library(ggplot2, warn.conflicts = FALSE))
suppressMessages(library(kableExtra,warn.conflicts = FALSE))
suppressMessages(library(knitr, warn.conflicts = FALSE))
src_data <- read.csv('src.dat',sep='|',header=TRUE)
png('dst.png',width=1200,height=800)
ggplot(data=src_data,aes(x=format(as.Date(record_date),"%W"),y=var_0)) +
  geom_col() +
  facet_wrap(~category,ncol=2,drop=FALSE) +
  ggtitle('ggtitle') +
  xlab('Week Number') +
  ylab('var_0')
dev.off()
