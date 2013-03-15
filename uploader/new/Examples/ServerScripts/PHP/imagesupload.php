<?PHP
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

//!!! If you don't use session then delete above code. !!!//


/*
the example use GD library. It may not be installed by default, if so
uncomment below line in the php.ini file:
extension=php_gd2.dll
and add the following line
--with-gd
*/

//existing folder on the server for images storing with write access
$uploaddir = dirname($_SERVER['SCRIPT_FILENAME'])."/UploadedFiles/";
//existing folder on the server for thumbnails storing with write access
$thumbdir = dirname($_SERVER['SCRIPT_FILENAME'])."/UploadedFiles/";
// define encoding for path names
$codepage = "ISO-8859-1";

//preferable size of the thumbnail
$thumbWidth = 120;
$thumbHeight = 120;

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
		//define an extension
		$ext = substr($uniqueFileName, strrpos($uniqueFileName,".") + 1 );
		//open file
		$image;
		if( strcasecmp($ext, "jpeg") == 0 || strcasecmp($ext, "jpg") == 0 )
		{
			$image = imagecreatefromjpeg( $uniqueFileName );
		}
		elseif( strcasecmp($ext, "png") == 0 )
		{
			$image = imagecreatefrompng( $uniqueFileName );
		}
		elseif( strcasecmp($ext, "gif") == 0 )
		{
			$image = imagecreatefromgif( $uniqueFileName );
		}
		else
		{
			echo "<eaferror>This type of file doesn't supported</eaferror>";
			return;
		}
		//scale operation 
		$thumbRatio = $thumbWidth/$thumbHeight;
		$imageWidth = imagesx( $image );
		$imageHeight = imagesy( $image );
		$imageRatio = $imageWidth/$imageHeight;
		if ( $thumbRatio < $imageRatio )
			$thumbHeight = $thumbWidth/$imageRatio;
		else
			$thumbWidth = $thumbHeight*$imageRatio;
		$thumbimage = imagecreatetruecolor((int)$thumbWidth, (int)$thumbHeight);
		
		// Resize
		if(!@imagecopyresampled($thumbimage, $image, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $imageWidth, $imageHeight))
		{
			echo "<eaferror>Can't create a thumbnail.</eaferror>";
			return;
		}
		
		//save thumbnail
		$thumbpath = "";
		if( strcasecmp($ext, "jpeg") == 0 )
		{
			$thumbpath = $thumbdir.basename($uniqueFileName, ".jpeg");
		}
		elseif ( strcasecmp($ext, "jpg") == 0 )
		{
			$thumbpath = $thumbdir.basename($uniqueFileName, ".jpg");
		}
		elseif( strcasecmp($ext, "png") == 0 )
		{
			$thumbpath = $thumbdir.basename($uniqueFileName, ".png");
		}
		elseif( strcasecmp($ext, "gif") == 0 )
		{
			$thumbpath = $thumbdir.basename($uniqueFileName, ".gif");
		}
		
		$thumbpath = $thumbpath . "_thumb.gif";			
		imagegif( $thumbimage, $thumbpath);			
		
		echo "thumbUrl=" . dirname($_SERVER['PHP_SELF']) . "/UploadedFiles/" . basename($thumbpath);
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