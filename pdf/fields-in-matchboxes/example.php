<?php
/*
 * adapted from
 * Wrap text around images:
 * Place images within a Textflow
 *
 * Case 4:
 * Place some images at certain text positions within a Textflow by using the
 * "matchbox" and "matchbox end" inline options when placing the Textflow for
 * indicating the image positions.
 *
 * Required software: PDFlib/PDFlib+PDI/PPS 10
 * Required data: image file
 */
$searchpath = "../input/";
require_once 'MatchboxIterable.php';

$outfile = "";
$title = "Wrap Text around Form Fields";

$tf = 0;
$imageoptlist = ""; $numoptlist = ""; $textoptlist = "";
$llx = 100; $lly = 50; $urx = 450; $ury = 800;
$posx = 0; $posy = 0;


try {
    $p = new pdflib();

    $p->set_option("searchpath={" . $searchpath . "}");

    /* This means we must check return values of load_font() etc. */
    $p->set_option("errorpolicy=return");
    $p->set_option("charref=true");

    if ($p->begin_document($outfile, "") == 0)
        throw new Exception("Error: " . $p->get_errmsg());

    $p->set_info("Creator", "PDFlib Cookbook");
    $p->set_info("Title", $title );


    $image = $p->load_image("auto", "kraxi_logo_text.tif", "");
    if ($image == 0)
        throw new Exception("Error: " . $p->get_errmsg());

    /* ------------------------------------------------------------------
     * Case 4:
     * Place images at certain text positions within a line of a Textflow
     * by using the "matchbox" and "matchbox end" inline options when
     * placing the Textflow for indicating the image positions.
     * ------------------------------------------------------------------
     */

    /* Text containing the macros defined in the option list below */
    $text =
        "Have a look at our new paper plane models!" .
        "<nextline><nextparagraph>" .
        "Long Distance Glider <nextline>".
		"With this paper rocket you can send all your messages " .
		"<nextline>".
		"<nextline>".
		"<nextline><&inputline><&end>".
		"<nextline>".
        "even when sitting in a hall or in the cinema pretty near the back. " .
        "Print a photo of the paper plane by pressing the " .
        "<nextline><&print><&end> button. " .
        "<nextline><&print><&end> button. " .
        "<nextline><&print><&end> button. " .
        "Save a description of the paper plane by pressing the ".
        "<nextline><&saveas><&end> button.";

    /* Options list for creating the Textflow.
     * For each image to be placed within the Textflow a macro is defined
     * to specify the matchbox rectangle for the image to be placed in and
     * the Textflow to wrap around.
     * The macro "print" specifies a matchbox called "print".
     * "boxwidth=40" defines the width of the matchbox rectangle.
     * "boxheight {ascender descender}" defines the vertical extent of the
     * matchbox rectangle using the ascender of the font on the top and the
     * descender at the bottom. "offsettop=2" adds an offset of 2 on the top
     * of the rectangle.
     * The macro "saveas" specifies a matchbox called "saveas" with similar
     * options.
     * The macro "end" is used to finish the matchbox.
     */
    $textoptlist =
        "macro {" .
        "print {matchbox={name=print boxwidth=20 " .
            "boxheight={ascender descender} offsettop=2}} " .
        "saveas {matchbox={name=saveas boxwidth=20 " .
            "boxheight={ascender descender} offsettop=2}} " .
        "inputline {matchbox={name=input " .
            " offsettop=0} } " .
		"end {matchbox={end} } " .
		" } " .
        "fontname=NotoSerif-Regular fontsize=14 " .
        "fillcolor={gray 0} leading=140% alignment=justify";

    /* Add some text to the Textflow */
    $tf = $p->create_textflow($text, $textoptlist);
    if ($tf == 0)
        throw new Exception("Error: " . $p->get_errmsg());

    $p->begin_page_ext(0, 0, "width=a4.width height=a4.height");

    /* Create a bookmark on the current page */
    $p->create_bookmark("Case 4: Inline options \"matchbox\" and " .
        "\"matchbox end\" for create_textflow()", "");

    $posy = $ury;

    do {
        /* Fit the Textflow */
        $result = $p->fit_textflow($tf, $llx, $lly, $urx, $ury,
            "verticalalign=justify linespreadlimit=120% ");

		// builds an overview
		$mi = new MatchboxIterable($p);
		//die(print_r(['mi->valid'=>$mi->valid()?'TRUE':'FALSE'],true));

		// having retrieved all matchboxes, lets process them
		while( $mi->valid() ) {
			$mbtype = $mi->current();

				switch ($mbtype->name) {
				case 'print':
				case 'saveas':
					$p->create_field($mbtype->x1,$mbtype->y1,$mbtype->x1+$mbtype->width,$mbtype->y1+$mbtype->height,
						$mbtype->fieldname,
						"checkbox","buttonstyle=star");
					break;

				case 'input':
					$p->create_field($mbtype->x1,$mbtype->y1,$mbtype->x1+350,$mbtype->y1+50,
						$mbtype->fieldname,
						"textfield","multiline backgroundcolor={rgb 0.95 0.95 0} bordercolor={gray 0} font=1 fontsize=12");
					break;

				default:
					die(print_r([$mbtype->name],true));
					break;

			}

			$mi->next();
		}

        if ($result == "_boxfull"){
            $p->end_page_ext("");
            $p->begin_page_ext(0, 0, "width=a4.width height=a4.height");
            $posy = $ury;
        }
        else if ($result != "_stop")
        {
            /* "_boxempty" happens if the box is very small and doesn't
             * hold any text at all.
             */
            if ($result == "_boxempty")
                throw new Exception ("Error: Textflow box too small");
            else
            {
                /* Any other return value is a user exit caused by
                 * the "return" option; this requires dedicated code to
                 * deal with.
                 */
                throw new Exception ("User return '" . $result .
                        "' found in Textflow");
            }
        }
    } while ($result != "_stop");

    $p->delete_textflow($tf);

    $p->end_page_ext("");
    $p->close_image($image);

    $p->end_document("");

    $buf = $p->get_buffer();
    $len = strlen($buf);

    header("Content-type: application/pdf");
    header("Content-Length: $len");
    header("Content-Disposition: inline; filename=wrap_text_around_images.pdf");
    print $buf;

} catch (PDFlibException $e) {
    echo("PDFlib exception occurred:\n".
        "[" . $e->get_errnum() . "] " . $e->get_apiname() .
        ": " . $e->get_errmsg() . "\n");
    exit(1);
} catch (Throwable $e) {
    echo("PHP exception occurred: " . $e->getMessage() . "\n");
    exit(1);
}

$p = 0;

?>
