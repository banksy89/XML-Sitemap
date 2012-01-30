<?php
/*****************************************************************
* A simple script to create an XML sitemap,
* by a given URL within the URI. Only gets the links from the provided
* page. ( I said it was quick!! )
*
* To use:
*		You MUST provide a query string of url with the site url.
*		EXAMPLE: create.php?url=thisismysite.co.uk
*		With the .co.uk or .com at the end.
*
* @author Ashley Banks
* @created 16/01/2012
******************************************************************/

// Get the specified URL to use
$url = $_GET['url'];

// The path to put the sitemap - change at will
$path = '';

// The name of the xml file to create - substringing so that we don't have all the http:// shit.
if ( substr ( $url, 0, 11 ) == 'http://www.' )
{
	$create_file = $path . substr ( $url, 11, strlen( $url ) ) . '.xml';
}
else
{
	$create_file = $path . $url . '.xml';	
	// As http:// wasn't provided we must add it in to read the file.
	$url = 'http://www.' . $url;
}

// Initiate DOM class and load the file by $url
$dom = new DOMDocument;
$dom->preserveWhiteSpace = FALSE;
$dom->loadHTMLFile( $url );

// Filter the results by all a tags.
$filtered = $dom->getElementsByTagName( 'a' ); 

$cnt = $filtered->length;

// Loop through and build string seperated by commas to explode later.
for ( $i = 0; $i < $cnt; $i++ ) 
{
    $node = $filtered->item( $i );
    $result .= $node->getAttribute( 'href' ) . ",";
}

$result = explode ( ',', $result );

// Check if it exists - if it does we remove it to build it again.
if ( file_exists ( $create_file ) )
{
	unlink( $create_file ); 
}

// Create the .xml file.
$_xml_file = fopen ( $create_file, 'w' );

// Output the header of the XML file
$xml = "</urlset>\n" ;
$xml .= '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xml .= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">' . "\n";

// Loop the results building the XML up.
foreach ( $result as $key => $value )
{
	if ( !!$value && $value != '#' )
	{
		$xml .= " <url>\n";
		
		if ( $value == '/' )
			$xml .= ' <loc>' . strip_tags ( $url . '/' ) . '</loc>' . "\n";
		
		else
			$xml .= ' <loc>' . strip_tags ( $url . '/' . $value ) . '</loc>' . "\n";
		
		
		$xml .= "  <priority>1</priority>\n";
		$xml .= " </url>\n";	
	}
}

// Close the xml file content
$xml .= "</urlset>\n";

// close our files.
fwrite ( $_xml_file, $xml );
fclose ( $_xml_file );

// This is if you want to force a download - otherwise it just creates it on the server or wherever the
// working directory is held!
include ( 'download.php' );

force_download( $create_file );

?>