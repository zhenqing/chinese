<?PHP

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
		echo "thumbUrl=" . dirname($_SERVER['PHP_SELF']) . "/UploadedFiles/" . basename($uniqueFileName);			
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