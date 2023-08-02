# README

+   attempting to get return codes of either -1 or 0 from fit_table
+   altered sample script from PDFlib to reproduce possible error
    +   receiving ``'_error'`` as return code instead of -1 or 0

## Updated Instructions from PDFlib

+   use ``errorpolicy=return`` (instead of ``..=exception``)
+   for dev, dump the errnum to detect the specific failure
+   for prod, react to the specific errnum(s) appropriately
+   see section 3.1.1 in the 10.0.1 Tutorial documentation for more information
+   Warning: these error numbers may change between releases. re-validation required
