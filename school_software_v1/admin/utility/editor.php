<?php include("../attachment/session.php"); ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi">
	
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	 <script type="text/javascript">

      // Load the Google Transliterate API
      google.load("elements", "1", {
            packages: "transliteration"
          });

      var transliterationControl;
      function onLoad() {
        var options = {
            sourceLanguage: 'en',
            destinationLanguage: ['hi'],
            transliterationEnabled: true,
            shortcutKey: 'ctrl+g'
        };
        // Create an instance on TransliterationControl with the required
        // options. 
        transliterationControl =
          new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textfields with the given ids.
        var ids = ["message_box" ];
        transliterationControl.makeTransliteratable(ids);

        // Add the STATE_CHANGED event handler to correcly maintain the state
        // of the checkbox.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.STATE_CHANGED,
            transliterateStateChangeHandler);

        // Add the SERVER_UNREACHABLE event handler to display an error message
        // if unable to reach the server.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_UNREACHABLE,
            serverUnreachableHandler);

        // Add the SERVER_REACHABLE event handler to remove the error message
        // once the server becomes reachable.
        transliterationControl.addEventListener(
            google.elements.transliteration.TransliterationControl.EventType.SERVER_REACHABLE,
            serverReachableHandler);

        // Set the checkbox to the correct state.
        document.getElementById('checkboxId').checked =
          transliterationControl.isTransliterationEnabled();

        // Populate the language dropdown
        var destinationLanguage =
          transliterationControl.getLanguagePair().destinationLanguage;
        var languageSelect = document.getElementById('languageDropDown');
        var supportedDestinationLanguages =
          google.elements.transliteration.getDestinationLanguages(
            google.elements.transliteration.LanguageCode.ENGLISH);
       
      }

      // Handler for STATE_CHANGED event which makes sure checkbox status
      // reflects the transliteration enabled or disabled status.
      function transliterateStateChangeHandler(e) {
        document.getElementById('checkboxId').checked = e.transliterationEnabled;
      }

      // Handler for checkbox's click event.  Calls toggleTransliteration to toggle
      // the transliteration state.
      function checkboxClickHandler() {
        transliterationControl.toggleTransliteration();
      }

      // Handler for dropdown option change event.  Calls setLanguagePair to
      // set the new language.
      function languageChangeHandler() {
        var dropdown = document.getElementById('languageDropDown');
        transliterationControl.setLanguagePair(
            google.elements.transliteration.LanguageCode.ENGLISH,
            dropdown.options[dropdown.selectedIndex].value);
      }

      // SERVER_UNREACHABLE event handler which displays the error message.
      function serverUnreachableHandler(e) {
        document.getElementById("errorDiv").innerHTML =
            "Transliteration Server unreachable";
      }

      // SERVER_UNREACHABLE event handler which clears the error message.
      function serverReachableHandler(e) {
        document.getElementById("errorDiv").innerHTML = "";
      }
      google.setOnLoadCallback(onLoad);

	  
function copy_text2(){
   var divToPrint1=CKEDITOR.instances.editor.getData();
    divToPrint1.select();
    document.execCommand('copy');
	alert_new("text successfully copied to clipboard");
}

function print_text1()
{
   var divToPrint=CKEDITOR.instances.editor.getData();
   newWin= window.open("");
   newWin.document.write(divToPrint);
   newWin.print();
   newWin.close();
}


	function hindi_typing(){
    $("#hindi_type").show();
    $("#suggestion").show();
     $("#message_box").focus();

}

function get_text() 
            {
			var x1=document.getElementById("message_box").value;
			var x2=document.getElementById("count_value").value;
			var res=x1.split(" ");
			var count=res.length;
			var count1=count-3;
			if(parseInt(count)>parseInt(x2))
			{
			
		    var desc = CKEDITOR.instances.editor.getData();
			var res2 = desc.replace("<p>", "");
			var res3 = res2.replace("</p>", "");
			if(count1<0){
			}else{
			 var res4=res3+res[count1];
			 CKEDITOR.instances.editor.setData(res4);
			 }
			
			 
			}
 //alert_new("HTML: " + $("#cke_1_contents").html());
            
 document.getElementById("count_value").value=count;
	}
	  
    </script>			
 <section class="content-header">
      <h1>
        Utilities Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	 <li><a href="javascript:get_content('utility/utilities')"><i class="fa fa-dashboard"></i>Utilities</a></li>
	  <li class="active">Editor</li>
      </ol>
    </section>
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
<form method="post" enctype="multipart/form-data">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
		   <div class="box-body">
			<div class="box-header with-border">
								  <h3 class="box-title">Editor</h3>
			</div>
			             <div class="col-md-12"  >	
				<h3>Don't Know Hindi Typing? Don't Worry Click Here </h3>
			  <input type="button"  class="btn btn-success" value="click" onclick="hindi_typing();">
			  <h4 style="display:none" id="suggestion">Press Space for showing Content in Editor and change font style etc by selecting Content in Editor </h4>
              </div>
			<div class="col-md-12" style="display:none" id="hindi_type">

                <div class="col-md-2" style="display:none">	
					<input type="checkbox" id="checkboxId" onclick="javascript:checkboxClickHandler()"></input>
					<span class="slider"></span>
              </div>

			 
			  <input type="hidden" id="count_value" value="1" ></input>
              <input type="text" id="message_box" rows="2" onKeyUp="get_text()" name="content" class="form-control">
          
		  </div>
		  <div class="col-md-12">
		   <textarea rows="6" cols="50" id="editor" name="content" class="form-control" autofocus></textarea>
             </div>
			 <div class="col-md-12">
		  <center>
		  <input type="hidden" id="copy_text" class="btn btn-success" value="Copy" onclick="copy_text2();">
		  <input type="button" class="btn btn-success" value="print" onclick="print_text1();">
		  </center>
             </div>

				
			
			
			 </div>
			 
			 
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
<!-- / All Section -->
</form>

<script>
  $(function () {  
    CKEDITOR.replace('editor')
    $('.textarea').wysihtml5()
  });
  
</script>