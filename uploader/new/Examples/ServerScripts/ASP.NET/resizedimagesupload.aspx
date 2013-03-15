<%@ Page language="c#"%>
<% 

        string ImageFolder = Server.MapPath("") + "\\UploadedFiles\\";					
		string ThumbRelPath = Request.CurrentExecutionFilePath.Replace(System.IO.Path.GetFileName(Request.CurrentExecutionFilePath), "");

        if (Request.Files != null && Request.Files.Count > 0)
        {
            try
            {
                
                HttpPostedFile uploadedFile = Request.Files[0];
                if (uploadedFile != null && uploadedFile.FileName != "")
                {
                    uploadedFile.SaveAs(ImageFolder + System.IO.Path.GetFileName(uploadedFile.FileName));

                    Response.Write(String.Format("thumbUrl={0}UploadedFiles/{1}", ThumbRelPath, System.IO.Path.GetFileName(uploadedFile.FileName)));
                    
                }
                
            }
            catch (Exception ex)
            {
                Response.Write(String.Format("<eaferror>An error occured during file handling: {0}</eaferror>", ex.Message));
            }
        }
        else
        {
            Response.Write("<eaferror>The images have not been sent.</eaferror>");
        }
			
%>