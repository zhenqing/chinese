<%@ Page language="c#"%>
<%@ Import Namespace="System.IO" %>
<script language="CS" runat="server">
    protected void Page_Load(object sender, EventArgs e)
    {
        // The EAFlashUpload control sends files in separate requests, 
        // so below code is executed for each file.

        // define folders for files storing.        
        string UploadFolder = Server.MapPath("") + "\\UploadedFiles\\";
        // retrieve relative path for thumbnails and images folder
        string RelPath = Request.CurrentExecutionFilePath.Replace(System.IO.Path.GetFileName(Request.CurrentExecutionFilePath), "");

        // check if file persits in the request and 
        // if above condition is true store file to UploadFolder location
        if (Request.Files != null && Request.Files.Count > 0)
        {
            HttpPostedFile uploadedFile = Request.Files[0];

            try
            {
                //Storing the file
                uploadedFile.SaveAs(UploadFolder + uploadedFile.FileName);

                // retrieve a file description
                string fDescription = "";
                if (Request.Form["file_Description"] != null)
                {
                    fDescription = Request.Form["file_Description"];

                    // some useful code, ex: storing description into DB
                }

                // This is simple check of what images are being uploaded.
                if (Request.Form["resized_name"] != null)
                    Response.Write(String.Format("thumbUrl={0}UploadedFiles/{1}", RelPath, uploadedFile.FileName));
                else
                    Response.Write(String.Format("origImageUrl={0}UploadedFiles/{1}&description={2}", RelPath, uploadedFile.FileName, Request.Form["file_Description"]));
                
            }
            catch(Exception ex)
            {
                Response.Write(String.Format("<eaferror>An error occured during file handling: {0}</eaferror>", ex.Message));
            }
        }
        else
        {
            Response.Write("<eaferror>The file has not been sent.</eaferror>");
        }
    }

</script>
