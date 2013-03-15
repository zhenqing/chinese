#!/usr/bin/perl -w

	use CGI; 
	use File::Basename;
	use Encode;
		
	$request = new CGI; 
	
	# Dfine encoding that used for file names convertion
	# EAFlashUpload sends file names in UTF8.
	my $target_encoding = "ISO-8859-1";
	
	# Define data that will be used for response
	my $response_string;
	
	# Define a path for storing uploaded files.
	# We assume that folder is in the same location that upload script.
	# Make sure your directory can be read and written to by script; 
	# on a shared UNIX server, this usually means setting the mode to 777 
	# (for example, by issuing the chmod 777 upload command at the command line). 
	# Check with your web hosting provider if you're not sure what you need to do.
	$upload_dir = dirname($ENV{'PATH_TRANSLATED'})."/UploadedFiles/";
	
	# Retrieve the file name
	my $filename = $request->param("Filedata");
	# Convert the name to target encoding
	$filename = encode($target_encoding, decode_utf8($filename));
			
	# By default, the file field has "Filedata" name.
	# Below code retrieves a filehandle.
	my $filehandle = $request->upload("Filedata");
		
	# Check if file exists in the request.
	if($filehandle)	
	{
		open UPLOADFILE, ">$upload_dir/$filename"; 
		binmode UPLOADFILE;		
		while ( <$filehandle> ) 
		{ 
		 print UPLOADFILE; 		 
		} 		
		close UPLOADFILE;

		$response_string = "The file \"$filename\" has been uploaded successfully!";		
	}
	else
	{
		$response_string = "<eaferror>The file has not been sent!</eaferror>";
	}

		
	print $request->start_html();	
	print $response_string;
	print $request->end_html();