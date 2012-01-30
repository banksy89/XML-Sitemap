<?php
/**
* This forces a download by a given file.
*
* @author Ashley Banks.
*
*/
function force_download ( $filename )
{
	if ( !$filename ) 
	{
		die ( 'must provide a file to download!' );		
	}
	else 
	{
		$path = $filename;
		
		if ( file_exists( $path ) && is_readable( $path ) ) {
			
			$size = filesize( $path );
			header( 'Content-Type: application/octet-stream' );
			header( 'Content-Length: ' . $size );
			header( 'Content-Disposition: attachment; filename=' . $filename );
			header( 'Content-Transfer-Encoding: binary' );
		
			$file = fopen( $path, 'rb' );
		
			if ( $file ) 
			{
				fpassthru( $file );
				exit;
			} 
			else 
			{
				echo $err;
			}
		} 
		else 
		{
			die ( 'Appears to be a problem with downloading that file.' );		
		}
	
	}		
}
?>