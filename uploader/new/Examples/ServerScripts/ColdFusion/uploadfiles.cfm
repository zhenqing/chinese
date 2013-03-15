<!--- Check that file exists in the request --->
<cfif isDefined("Form.Filedata")>

  <cfset uploadDir = GetDirectoryFromPath(ExpandPath("UploadedFiles/")) />
  
  <cftry>
    <!--- Save file to demanded location --->
    <cffile action="upload" filefield="Filedata" destination = "#uploadDir#" nameconflict="makeunique">
    <cfif #File.fileWasSaved#>
         <cfoutput>The file was successfully uploaded!</cfoutput>
    <cfelse>          
          <cfoutput><eaferror>The file has not been saved. Please check read/write permissions of destination folder.</eaferror></cfoutput>
    </cfif>
    <cfcatch type="Any">
      <cfoutput><eaferror>The file has not been saved. Please check destination folder exists and has read/write permissions.</eaferror></cfoutput>
    </cfcatch>
  </cftry>

<cfelse>       
  <cfoutput><eaferror>The file has not been sent.</eaferror></cfoutput>  