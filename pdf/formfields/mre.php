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

  $p->set_option('logging={filename=./mre.log classes={api=1 warning=2}}');
  $p->set_option("errorpolicy=return");
  $p->set_option( "SearchPath={  {../fonts}  }");

  // original optlist:
  // $optlist = "tempdirname /usr/tmp masterpassword=masterpassword permissions={nomodify} compatibility=1.7ext8  optimize=true inmemory=true viewerpreferences={printscaling none}";
  
  // REQUIRED FOR MRE: optimize = true must be present.
  // remove this option and the problem is NOT reproducible
  //
  $optlist = "optimize=true ";
  if ($p->begin_document($outfilename, $optlist) == 0) {
    die("Error: " . $p->get_errmsg());
  }

  // using a font outline makes no difference for this issue
  $p->set_option("FontOutline={NotoSerif-Regular=NotoSerif-Regular.ttf}");
  $font = $p->load_font("NotoSerif-Regular", "winansi","simplefont embedding nosubsetting");
  if ($font == 0) {
    die("Error: " . $p->get_errmsg());
  }

  $p->begin_page_ext(612, 792, '');

  /* The tooltip will be used as rollover text for the field */

  $optlist = "tooltip={Enter your response here} " .
    "bordercolor={gray 0} multiline=true fontsize=auto font=" . $font;
  
  // REQUIRED FOR MRE: dimensions of the two boxes must match
  // a difference of as little as 1 point in either width or height will hide the issue
  $width = 200;
  $height = 80;
  $llx0 = 72; $lly0 = 200;
  $llx1 = 65; $lly1 = 320;

  $p->create_field($llx0,$lly0,$llx0 + $width,$lly0 + $height, "firstbox", "textfield", $optlist);
  $p->create_field($llx1,$lly1,$llx1 + $width,$lly1 + $height, "secondbox", "textfield", $optlist);

  $p->end_page_ext("");

  $p->end_document("");

  $buf = $p->get_buffer();
  $len = strlen($buf);
  header("Content-Length: $len");
  header("Content-type: application/octet-stream");
  header("Content-Disposition: attachment; filename=mre.pdf");
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
