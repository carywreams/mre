<?php
/* 
* required software: PDFlib/PDFlib+PDI/PPS 9
* required data: font file
* inspired by starter_formfields cookbook script 
*
*/
$outfilename = "";

try {
  $p = new PDFlib();

  $p->set_option('logging={filename=./mre.log classes={api=1 warning=1}}');
  /* This means we must check return values of load_font() etc. */
  $p->set_option("errorpolicy=exception");
  /* all strings are expected as utf8 */
  $p->set_option("stringformat=utf8");
  $p->set_option( "SearchPath={  {../fonts}  }");


  /*
* Prevent changes with a master password.
* Linearize with inmemory=true to avoid creation of temporary files on
* disk.
*/

  //    $optlist = "compatibility=1.7ext8 optimize inmemory=true masterpassword=pdflib permissions={nomodify}";
  $optlist = "tempdirname /usr/tmp masterpassword=djflhdsjfhlsjfhlkjdsa permissions={nomodify} compatibility=1.7ext8  optimize=true inmemory=true viewerpreferences={printscaling none}";
  if ($p->begin_document($outfilename, $optlist) == 0) {
    die("Error: " . $p->get_errmsg());
  }

  $p->set_option("FontOutline={NotoSerif-Regular=NotoSerif-Regular.ttf}");
  $font = $p->load_font("NotoSerif-Regular", "winansi","simplefont embedding nosubsetting");
  if ($font == 0) {
    die("Error: " . $p->get_errmsg());
  }

  $p->begin_page_ext(612, 792, '');

  /* The tooltip will be used as rollover text for the field */

  $optlist = "tooltip={Enter your response here} " .
    "bordercolor={gray 0} multiline=true fontsize=auto font=" . $font;
  $p->create_field(72,200,272,280, "firstbox", "textfield", $optlist);
  $p->create_field(65,320,265,400, "secondbox", "textfield", $optlist);

  $p->end_page_ext("");

  $p->end_document("");

  $buf = $p->get_buffer();
  $len = strlen($buf);
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Pragma: public");
  header("Content-Length: $len");
  header("Content-type: application/octet-stream");
  header("Content-Disposition: attachment; filename=mre-fn.pdf");
  print $buf;

}
catch (PDFlibException $e) {
  die("PDFlib exception occurred in starter_formfields sample:\n" .
    "[" . $e->get_errnum() . "] " . $e->get_apiname() . ": " .
    $e->get_errmsg() . "\n");
}
catch (Throwable $e) {
  die("PHP exception occurred: " . $e->getMessage() . "\n");
}

$p = 0;
?>
