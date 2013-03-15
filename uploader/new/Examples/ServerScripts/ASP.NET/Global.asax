<%@ Application Language="C#" %>
<script runat="server">

	    /*
	        C# Global.asax file for ASP.NET examples.
	        The Flash Player of Non-IE (FireFox, Safari etc.) browsers doesn’t send browser cookies with upload request. 
	        Therefore, server-side applications that use cookies (ex: authentication, session tracking (state maintenance)) doesn’t work properly.
			The EAFlashUpload automaticaly retrieves browser cookie and sends it as form field value.     
	    */
        void Application_EndRequest(Object sender, EventArgs e)
        {
            //if (System.IO.Path.GetFileName(Request.FilePath).ToLower() == "the name of EAFlashUpload container page" && Response.Cookies.Count > 0)
            
            // In your final solution use above code instead below.
            if (Response.Cookies.Count > 0)
            {
                foreach (string s in Response.Cookies.AllKeys)
                {
                    // Sience ASP.NET 2.0 HttpOnly flag is set for session cookie therefore it cannot be retrieved via JavaScript.
                    // Here we remove "HttpOnly" flag manualy. 
                    // You can check the name of requested page and allow below behavior for specific pages only.
                    if (s == System.Web.Security.FormsAuthentication.FormsCookieName || s.ToLower().Equals("asp.net_sessionid"))
                        Response.Cookies[s].HttpOnly = false;
                }
            }
        }      
    
	    void Application_BeginRequest(object sender, EventArgs e)
        {
            
            string cookieString = Request.Form["browser_cookie"];

            try
            {    
	            if (cookieString != null)
                {
                    Hashtable sCookie = new Hashtable();
                    ParseCookies(cookieString, sCookie);

                    foreach (string key in sCookie.Keys)
                    {
                        if (Request.Cookies.Get(key) == null)
                        {
                            Request.Cookies.Add((HttpCookie)sCookie[key]);
                        }
                        else
                        {
                            Request.Cookies.Set((HttpCookie)sCookie[key]);
                        }
                         
                    }
                }
            }
            catch(Exception ex)
            {
	            Response.Write(ex.Message);
            }


        }

        private void ParseCookies(string cookies, Hashtable cookiesCollection)
        {
            string[] parts = cookies.Split(';');
            string buffer;
            string[] aBuffer;
            HttpCookie cookie = null;
            string currentName = "";

            for (int i = 0; i < parts.Length; i++)
            {
                buffer = parts[i].Trim();
                aBuffer = buffer.Split(new char[] { '=' }, 2);
                if (aBuffer.Length > 1)
                {
                    if (aBuffer[0] != "path")
                    {
                        currentName = aBuffer[0];
                        cookie = new HttpCookie(aBuffer[0]);
                        cookie.Value = aBuffer[1];

                        if (cookiesCollection.ContainsKey(aBuffer[0])) { cookiesCollection[aBuffer[0]] = cookie; }
                        else { cookiesCollection.Add(aBuffer[0], cookie); }
                    }
                    else
                    {
                        HttpCookie tempCookie = (HttpCookie)cookiesCollection[currentName];
                        tempCookie.Path = aBuffer[1];
                        cookiesCollection[currentName] = tempCookie;
                    }
                }
            }
        }
		   
</script>
