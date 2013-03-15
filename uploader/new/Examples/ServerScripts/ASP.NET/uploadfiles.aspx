<%@ Page Language="C#" %>
<%@ Import Namespace="System.IO" %>
<script runat="server">
    protected void Page_Load(object sender, EventArgs e)
    {
        // The EAFlashUpload control sends files in separate requests, 
        // so below code is executed for each file.

        // define folders for files storing.
        string UploadFolder = Server.MapPath("") + "\\UploadedFiles\\";

        // check if file persits in the request and 
        // if above condition is true store file to UploadFolder location
        if (Request.Files != null && Request.Files.Count > 0)
        {
            HttpPostedFile uploadedFile = Request.Files[0];

            try
            {
                //Storing the file
                uploadedFile.SaveAs(UploadFolder + Path.GetFileName(uploadedFile.FileName));

                // The EAFlashUpload requires at least one symbol in the request
                Response.Write("The file has been saved.");
            }
            catch(Exception ex)
            {
                Response.Write(String.Format("<eaferror>An error occured during file handling: {0}</eaferror>",ex.Message));
            }
        }
        else
        {
            Response.Write("<eaferror>The file has not been sent.</eaferror>");
        }
    }

</script>
