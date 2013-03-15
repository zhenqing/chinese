<%@ Page language="c#"%>
<%@ Import Namespace="System.Drawing" %>
<%@ Import Namespace="System.IO" %>
<script language="CS" runat="server">   

        private void Page_Load(object sender, System.EventArgs e)
        {
            // Note: if your solution will upload files as post back of ASP.NET page, 
            // place below code to if(IsPostBack){} block.
            
            
            // define folders for image and thumbnails storing.
            string ImageFolder = Server.MapPath("") + "\\UploadedFiles\\";
            string ThumbFolder = Server.MapPath("") + "\\UploadedFiles\\";
            
			// retrieve relative path for thumbnails folder
			string ThumbRelPath = Request.CurrentExecutionFilePath.Replace(System.IO.Path.GetFileName(Request.CurrentExecutionFilePath), "");
			
            // define variables that will contain image and thumbnail names.
            string imageFullPath = "";
            string thumbFullPath = "";

            // check if file persits in the request and 
            // if above condition is true store file to ImageFolder location
            if (Request.Files != null && Request.Files.Count > 0)
            {
                try
                {
                    HttpPostedFile imageFile = Request.Files[0];

                    //Storing the image
                    imageFullPath = ImageFolder + Path.GetFileName(imageFile.FileName);
                    imageFile.SaveAs(imageFullPath);


                    // create an image object, using the filename we just retrieved
                    System.Drawing.Image image = System.Drawing.Image.FromFile(imageFullPath);
                    System.Drawing.Image thumbnail = this.CreateThumbnail(image);

                    // save the image to the file
                    thumbFullPath = ThumbFolder + "thumb_" + Path.GetFileNameWithoutExtension(imageFullPath) + ".jpg";
                    thumbnail.Save(thumbFullPath, System.Drawing.Imaging.ImageFormat.Jpeg);

                    image.Dispose();
                    thumbnail.Dispose();

                    Response.Write(String.Format("thumbUrl={0}UploadedFiles/{1}", ThumbRelPath, Path.GetFileName(thumbFullPath)));
                }
                catch (Exception ex)
                {
                    Response.Write(String.Format("<eaferror>An error occured during file handling: {0}</eaferror>", ex.Message));
                }
            }
            else
            {
                Response.Write("<eaferror>The image has not been sent.</eaferror>");     
            }           
            
        }

        private System.Drawing.Image CreateThumbnail(System.Drawing.Image origImage)
        {
            System.Drawing.Image thumb;

            // define preferable size of the thumbnail, they may be changed due to scale operation.
            int width = 120;
            int height = 120;
            // retrieve original size of the image
            int origWidth = origImage.Width;
            int origHeight = origImage.Height;

            //scale operation
            //*** If the image is smaller than a thumbnail just return it
            if (origWidth < width && origHeight < height)
                return origImage;

            decimal lnRatio;
            if (origWidth > origHeight)
            {
                lnRatio = (decimal)width / origWidth;
                decimal lnTemp = origHeight * lnRatio;
                height = (int)lnTemp;
            }
            else
            {
                lnRatio = (decimal)height / origHeight;
                decimal lnTemp = origWidth * lnRatio;
                width = (int)lnTemp;
            }

            // create the actual thumbnail image
            thumb = origImage.GetThumbnailImage(width, height, new System.Drawing.Image.GetThumbnailImageAbort(ThumbnailCallback), IntPtr.Zero);

            return thumb;
        }

        // Required by method signature, but not used               
        public bool ThumbnailCallback()
        {
            return true;
        }

</script>