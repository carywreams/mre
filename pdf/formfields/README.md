# Description

Two, non-synchronized form fields show content of last-edited form field upon re-opening of the PDF until the form field displaying the incorrect content gains focus. Once it gains focus, the correct content is shown. If the original contents remain unchanged, once the field loses focus, it will again display the incorrect content from the other field. If the content is changed, the updated content will be displayed _and_ the font size may change once the field loses focus.

+   Generate pdf using the mre.php script, php8.0 
    +   note: optimize=true must be included; removing this option will hide the issue
    +   note: both form fields must have _precisely_ the same dimensions; a difference of as little as 1pt in either dimension will hide the issue
+   Open the PDF with Google Chrome (I used the command line, but doubt that it matters)
+   enter distinct content into the top box
+   enter distinct content into the bottom box
+   use down-arrow option, electing "With My Changes", and provide a file name
+   open the PDF with a PDF reader, to varying degrees of success:
    +   GNOME Document Viewer 3.36.10: will open and display content for last-entered field in both form fields
    +   FireFox will open and display correct content for both form fields
    +   Google Chrome will open and display content for last-entered field in both form fields

## Version Info

+   PDFlib 9.3.1
+   php8.0
+   Google Chrome
    +   version: 98.0.4758.102 (Official Build) (64-bit) 
    +   Revision: 273bf7ac8c909cde36982d27f66f3c70846a3718-refs/branch-heads/4758@{#1151}
    +   OS: Linux
+   GNOME Document Viewer 3.36.10
+   Mozilla Firefox 97.0



## Directory Files

+   pdflib.upr, stock sample from PDFlib-9.3.1-Linux-x64-php/bind/data/pdflib.upr
    +   eliminates error message in log file
    +   available or not, does not impact reproducibility
+   licensekeys.txt, empty file 
    +   eliminates error message in log file
    +   available or not, does not impact reproducibility
+   Makefile - just needed a script
+   mre-filled.pdf - original pdf file, filled in google-chrome and "saved with my changes"
+   mre.log - the pdflib log, api=1 warning=2
+   mre.pdf - the original pdf file, prior to being filled
+   mre.php - the minimal script
    +   eliminated errors
    +   removed as much optional content as reasonably possible
