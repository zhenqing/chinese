  <%--
	This script's using Apache Commons Fileupload library (which require Apache Commons IO)
	to parse request, they can be downloaded from:
	commons-io: http://commons.apache.org/downloads/download_io.cgi
	commons-fileupload: http://commons.apache.org/downloads/download_fileupload.cgi
	
	See documentation of your web server to get an information about where you should place this libraries. 
	Ex. TomCat:
	"For classes and resources specific to a particular web application, place unpacked classes and resources
	under /WEB-INF/classes of your web application archive, or place JAR files containing those classes and resources
	under /WEB-INF/lib of your web application archive."
	--%>

  <%--
	Include required libraries and java classes:
  --%>
  <%@ page import="org.apache.commons.fileupload.servlet.ServletFileUpload" %>
  <%@ page import="org.apache.commons.fileupload.FileItem" %>
  <%@ page import="org.apache.commons.fileupload.disk.DiskFileItemFactory" %>
  <%@ page import="java.util.List" %>
  <%@ page import="java.io.File" %>
  <%
	
	//Folder for uploaded files
	String UploadDir = new File( application.getRealPath(request.getServletPath()) ).getParent() + "/UploadedFiles/";
	try
	{
		//Check if the request has "multipart/form-data" MIME type
		if( ServletFileUpload.isMultipartContent(request) )
		{
			ServletFileUpload fileupload = new ServletFileUpload( new DiskFileItemFactory() );
			
			//parse request and receive form fields collection
			List filelist = fileupload.parseRequest(request);
			
			//loop through the collection
			for( int i = 0; i < filelist.size(); i++ )
			{
				FileItem item = (FileItem)filelist.get(i);
				
				// Check wether the current form field is file
				if( !item.isFormField() )
				{
					//Convert a file name from UTF-8 to current system encoding.
					String filename =  new String(item.getName().getBytes(), "UTF-8");
					File file =  new File( UploadDir + filename );
					
					//Create new file
					file.createNewFile();
					
					//Write content of the file to the disk.
					item.write( file );
				}
				else
				{
					// Usfull code for form fields handling
					
					// use item.getFieldName() to get form field name
					// use item.getString() to get form field value
				}
			}
		}
		else
		{
			out.println("<eaferror>Request didn't contain the file.</eaferror>");
		}
	}
	catch(Exception e)
	{
		out.println("<eaferror>Error while handling files: " + e.toString() + "</eaferror>");
	}
  %>
