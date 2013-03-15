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

                // retrieve a file description
                string fDescription = "";
                if (Request.Form["file_Description"] != null)
                {
                    fDescription = Request.Form["file_Description"];

                    // some useful code, ex: storing description into DB
                }
                Response.Write(String.Format("The file \"{0}\" has been uploaded <br />Description: {1} <br />", Path.GetFileName(uploadedFile.FileName), fDescription));


                // The following code is related to UploadDescription.html example only //
                if (Request.Form["menu"] != null)
                {
                    Response.Write("Some menu: " + Request.Form["menu"].ToString() + "<br />");
                }

                if (Request.Form["author"] != null)
                {
                    Response.Write("Author: " + Request.Form["author"].ToString());
                }
                // The above code is related to UploadDescription.html example only //

                Response.Write("<hr />");
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
