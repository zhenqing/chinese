<?PHP
/*
some important php.ini parameters related to file upload:

file_uploads  boolean (Default value is true)
Whether or not to allow HTTP file uploads.
 
upload_tmp_dir string
The temporary directory used for storing files when doing file upload. Must be writable by whatever user PHP is running as. If not specified PHP will use the system's default.

upload_max_filesize integer (Default value is 2M (2 MB))
The maximum size of an uploaded file.
When an integer is used, the value is measured in bytes.

max_input_time integer 
This sets the maximum time in seconds a script is allowed to parse input data, like POST, GET and file uploads.

post_max_size integer (Default value is 8M (8 MB))
Sets max size of post data allowed. This setting also affects file upload. To upload large files, this value must be larger than upload_max_filesize.   If memory limit is enabled by your configure script, memory_limit also affects file uploading. Generally speaking, memory_limit should be larger than post_max_size .  When an integer is used, the value is measured in bytes.

memory_limit  integer
This sets the maximum amount of memory in bytes that a script is allowed to allocate.
*/

//restore session code begin. if you don't use session or cookie just ignor below code section.
if( isset($_POST['browser_cookie']) && $_POST['browser_cookie'] != "")
{
	//retrive cookie from form field value. The EAFlashUpload sends the cookie as a value of form field due to Flash API limitations.
	$cookie = split(";", $_POST['browser_cookie']);
	
	foreach($cookie as $value)
	{
		$nvpair = split("=", $value);	
		$parsedcookie[trim($nvpair[0])] = $nvpair[1];
	}
	$_COOKIE = $parsedcookie;
	
	session_start();	
}
//restore session code end
//!!! If you don't use session or cookie then delete above code. !!!//

//existing folder on the server for files storing with write access
$uploaddir = dirname($_SERVER['SCRIPT_FILENAME'])."/UploadedFiles/";

// define encoding for path names
$codepage = "ISO-8859-1";

//check file existence in the request
if ( count($_FILES) > 0 )
{
	$file = $_FILES["Filedata"];
	
	//check on upload errors
	if ( $file['error'] != UPLOAD_ERR_OK )
	{
		switch( $file['error'] )
		{
			case UPLOAD_ERR_INI_SIZE:
				echo "<eaferror>The uploaded file exceeds the upload_max_filesize directive in php.ini.</eaferror>";
				break;
			case UPLOAD_ERR_FORM_SIZE:
				echo "<eaferror>Uploader didn't allow such file size</eaferror>";
				break;
			case UPLOAD_ERR_PARTIAL:
				echo "<eaferror>Uploaded file hasn't been complete uploaded</eaferror>";
				break;
			case UPLOAD_ERR_NO_FILE:
				echo "<eaferror>File hasn't been uploaded</eaferror>";
				break;
		}
		
		return;
	}
	
	//Use this code if the existing files might be rewritten.
	//$uploadfile = $uploaddir . mb_convert_encoding( basename($file['name']), $codepage , 'UTF-8' );

	//define a full file path
	$fileName = $uploaddir . mb_convert_encoding( basename($file['name']), $codepage , 'UTF-8' );
	// check on duplicate file names and if there is a file with the same name add "_(<counter>)" at the end of the name of the new file
	$uniqueFileName = $fileName;
	for($k = 1; $k < 50; $k++)
	{
		if(!file_exists($uniqueFileName))
		{
			break;
		}
		else
		{
			$pathInfo = pathinfo($fileName);
			$uniqueFileName = sprintf("%s/%s_(%s).%s", $pathInfo['dirname'], $pathInfo['filename'], $k, $pathInfo['extension']);
		}

	}
	
	//move uploaded file from temp location		
	if ( move_uploaded_file( $file['tmp_name'], $uniqueFileName ) )
	{
		// retrive form values
		if( isset($_POST['file_Description']) )
		{
			// some useful code, ex: storing description into DB
		}
		
		// This is simple check of what images are being uploaded.
        if (isset($_POST["resized_name"]))
        	echo sprintf("thumbUrl=%s", dirname($_SERVER['PHP_SELF']) . "/UploadedFiles/" . basename($uniqueFileName));
        else
        	echo sprintf("origImageUrl=%s&description=%s", dirname($_SERVER['PHP_SELF']) . "/UploadedFiles/" . basename($uniqueFileName), $_POST['file_Description']);
		
	}
	else
	{
		echo "<eaferror>Can't move file from temporary directory to destination. Please check read/write permissions of destination folder: $uploaddir.</eaferror>";
	}
	
}
else
{
	echo "<eaferror>Request didn't contain the file. Usually this situation occures if request size exceeds the post_max_size directive in php.ini.</eaferror>";
}
?>