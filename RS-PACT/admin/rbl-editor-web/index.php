<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Riversand | RBL Editor</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./assets/images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon"/>
    <script src="assets/js/5c8ed5667f.js"></script>


    <link href="assets/css/valera-round-font.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/material-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/css/style.css">

  </head>
  <body id="body">
    <header id="header" class="fixed-top">
      <div class="container d-flex">
        <div class="logo mr-auto">
          <a href="#"
            ><img src="./assets/images/rs-logo2.png" alt="" class="img-fluid"
          /></a>
        </div>
      </div>
    </header>
    <!--  End Header -->

    <nav class="navbar navbar-inverse navbar--top navbar-dark" id="nav">
		<div class="navbar-header d-flex col">
		   <a class="navbar-brand" href="#"><i class="fa fa-cube"></i>RBL<b>editor</b></a>  		
        </div>

        <ul class="nav navbar-nav navbar-left ml-auto">
            <!-- <li class="nav-item active"  data-toggle= "tooltip" data-placement="bottom" title="Bold"><a href="#" class="nav-link"><i class="fas fa-bold"></i></a></li> -->
            <!-- <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="Italic"><a href="#" class="nav-link"><i class="fa fa-italic"></i></a></li> -->
            <!-- <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="Highlight Text"><a href="#" class="nav-link"><i class="fas fa-highlighter"></i></a></li> -->
            <!-- <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="Validation Format"><a href="#" class="nav-link"><i class="fa fa-check-circle"></i></a></li> -->


             <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="API Validation" onclick="APIValidation()"><a href="#" class="nav-link"><i class="fa fa-file-code "></i></a></li>
            
             <li class="nav-item dropdown" >
            <a  aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span id="selected">Select File Type</span><span class="caret"></span></a>
            <ul class="dropdown-menu" id="BRtype" >
            <li><a href="#" class="dropdown-item" onclick="setBRType('computation') "><i class="fa fa-calculator"></i>Computation</a></li>
            <li><a href="#" class="dropdown-item" onclick="setBRType('validation')"><i class="fa fa-check-circle"></i>Validation</a></li>
            <li><a href="#" class="dropdown-item" onclick="setBRType('computationpostprocess')"><i class="fas fa-tasks"></i>Computation Post Process</a></li>
            <li><a href="#" class="dropdown-item" onclick="setBRType('validationpostprocess')"><i class="fas fa-tasks"></i>Validation Post Process</a></li>
            </ul>


            

            <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="Word Format" onclick="wordFormat()"><a href="#" class="nav-link"><i class="fa fa-align-center"></i></a></li>
            <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="Word Reformat" onclick="wordReformat();"><a href="#" class="nav-link"><i class="fa fa-align-justify"></i></a></li>
            <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="Copy Inline" onclick="copy()"><a href="#" class="nav-link"><i class="fa fa-files-o"></i></a></li>
            <!-- <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="Word Style"><a href="#" class="nav-link"><i class="fa fa-file-word-o"></i></a></li> -->
            <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="Line Numbering"><a href="#" class="nav-link" onclick="lineNumbering()"><i class="fa fa-list-ol"></i></a></li>
            <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="Clear Editor"><a href="#" class="nav-link" onclick="clearEditor()" ><i class="fa fa-paint-brush "></i></a></li>
            <!-- <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="Settings"><a href="#" class="nav-link"><i class="fa fa-cog "></i></a></li> -->
            
            <li class="nav-item dropdown" >
              <a  aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span id="theme-menu">Select Theme</span><span class="caret"></span></a>
              <ul class="dropdown-menu multi-column columns-2" id="themetype" >
                <div class="row">
                    <div class="col-sm-6">
                      <ul class="multi-column-dropdown">
                        <h6 class="dropdown-header"><b><i>Bright Themes</i></b></h6>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('chrome') ; editorTheme()" onmouseover="setTheme('chrome') ; editorTheme()">Chrome</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('clouds') ; editorTheme()" onmouseover="setTheme('clouds') ; editorTheme()">Clouds</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('crimson_editor') ; editorTheme()" onmouseover="setTheme('crimson_editor') ; editorTheme()">Crimson Editor</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('dawn') ; editorTheme()" onmouseover="setTheme('dawn') ; editorTheme()">Dawn</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('dreamweaver') ; editorTheme()" onmouseover="setTheme('dreamweaver') ; editorTheme()">Dreamweaver</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('eclipse') ; editorTheme()" onmouseover="setTheme('eclipse') ; editorTheme()">Eclipse</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('github') ; editorTheme()" onmouseover="setTheme('github') ; editorTheme()">GitHub</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('iplastic') ; editorTheme()" onmouseover="setTheme('iplastic') ; editorTheme()">IPlastic</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('solarized_light') ; editorTheme()" onmouseover="setTheme('solarized_light') ; editorTheme()">Solarized Light</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('textmate') ; editorTheme()" onmouseover="setTheme('textmate') ; editorTheme()">TextMate</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('tomorrow') ; editorTheme()" onmouseover="setTheme('tomorrow') ; editorTheme()">Tomorrow</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('kuroir') ; editorTheme()" onmouseover="setTheme('kuroir') ; editorTheme()">Kuroir</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('katzenmilch') ; editorTheme()" onmouseover="setTheme('katzenmilch') ; editorTheme()">KatzenMilch</a></li>
                        <li><a href="#" style="height: 30px;" class="dropdown-item" onclick="setTheme('sqlserver') ; editorTheme()" onmouseover="setTheme('sqlserver') ; editorTheme()">SQL Server</a></li>
                        <h6 class="dropdown-header"><b><i>Dark Themes</i></b></h6>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('ambiance') ; editorTheme()" onmouseover="setTheme('ambiance') ; editorTheme()">Ambiance</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('chaos') ; editorTheme()" onmouseover="setTheme('chaos') ; editorTheme()">Chaos</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('clouds_midnight') ; editorTheme()" onmouseover="setTheme('clouds_midnight') ; editorTheme()">Clouds Midnight</a></li>

                      </ul>
                    </div> 
                    <div class="col-sm-6">
                      <ul class="multi-column-dropdown">
                        <h6 class="dropdown-header"><b><i>Dark Themes</i></b></h6>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('dracula') ; editorTheme()" onmouseover="setTheme('dracula') ; editorTheme()">Dracula</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('cobalt') ; editorTheme()" onmouseover="setTheme('cobalt') ; editorTheme()">Cobalt</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('gruvbox') ; editorTheme()" onmouseover="setTheme('gruvbox') ; editorTheme()">Gruvbox</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('gob') ; editorTheme()" onmouseover="setTheme('gob') ; editorTheme()">Green on Black</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('idle_fingers') ; editorTheme()" onmouseover="setTheme('idle_fingers') ; editorTheme()">idle Fingers</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('kr_theme') ; editorTheme()" onmouseover="setTheme('kr_theme') ; editorTheme()">krTheme</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('merbivore') ; editorTheme()" onmouseover="setTheme('merbivore') ; editorTheme()">Merbivore</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('merbivore_soft') ; editorTheme()" onmouseover="setTheme('merbivore_soft') ; editorTheme()">Merbivore Soft</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('mono_industrial') ; editorTheme()" onmouseover="setTheme('mono_industrial') ; editorTheme()">Mono Industrial</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('monokai') ; editorTheme()" onmouseover="setTheme('monokai') ; editorTheme()">Monokai</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('nord_dark') ; editorTheme()" onmouseover="setTheme('nord_dark') ; editorTheme()">Nord Dark</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('pastel_on_dark') ; editorTheme()" onmouseover="setTheme('pastel_on_dark') ; editorTheme()">Pastel on dark</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('solarized_dark') ; editorTheme()" onmouseover="setTheme('solarized_dark') ; editorTheme()">Solarized Dark</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('terminal') ; editorTheme()" onmouseover="setTheme('terminal') ; editorTheme()">Terminal</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('tomorrow_night') ; editorTheme()" onmouseover="setTheme('tomorrow_night') ; editorTheme()">Tomorrow Night</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('tomorrow_night_blue') ; editorTheme()" onmouseover="setTheme('tomorrow_night_blue') ; editorTheme()">Tomorrow Night Blue</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('tomorrow_night_bright') ; editorTheme()" onmouseover="setTheme('tomorrow_night_bright') ; editorTheme()">Tomorrow Night Bright</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('tomorrow_night_eighties') ; editorTheme()" onmouseover="setTheme('tomorrow_night_eighties') ; editorTheme()">Tomorrow Night 80s</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('twilight') ; editorTheme()" onmouseover="setTheme('twilight') ; editorTheme()">Twilight</a></li>
                        <li><a href="#" style="height: 20px;" class="dropdown-item" onclick="setTheme('vibrant_ink') ; editorTheme()" onmouseover="setTheme('vibrant_ink') ; editorTheme()">Vibrant Ink</a></li>
                      </ul>
                    </div>
                  </div>  
              </ul>
            </li>



               <li class="nav-item"data-toggle= "tooltip" data-placement="bottom" title="dark mode" onclick="darkMode()"><a href="#" class="nav-link"><i class="fas fa-adjust " ></i></a></li>
               </li>

        </ul>
    </nav>
<!-- Editor -->
    <div id="editor" ></div>
       
    <!-- ======= Footer ======= -->
 <footer id="footer">
	<div class="container py-4">
	  <a href="https://www.riversand.com/" class="logofooter"><img src="https://pact.riversand.com/assets/images/rs-logo2.png" ></a>
	  <div class="copyright">&copy; 2020 Riversand All Rights Reserved.
	  </div>  
	</div>
    </footer>
    <!-- End Footer -->

    

 

    <script src="assets/js/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/mode-javascript.js"></script>
    <script src="assets/js/ext-language_tools.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>

    <!-- ===THEMES=== -->
    <script src="assets/js/worker-javascript.js"></script>
    <script src="assets/js/themes/theme-ambiance.js"></script>
    <script src="assets/js/themes/theme-chaos.js"></script>
    <script src="assets/js/themes/theme-chrome.js"></script>
    <script src="assets/js/themes/theme-clouds.js"></script>
    <script src="assets/js/themes/theme-clouds_midnight.js"></script>
    <script src="assets/js/themes/theme-cobalt.js"></script>
    <script src="assets/js/themes/theme-crimson_editor.js"></script>
    <script src="assets/js/themes/theme-dawn.js"></script>
    <script src="assets/js/themes/theme-dracula.js"></script>
    <script src="assets/js/themes/theme-dreamweaver.js"></script>
    <script src="assets/js/themes/theme-eclipse.js"></script>
    <script src="assets/js/themes/theme-github.js"></script>
    <script src="assets/js/themes/theme-gob.js"></script>
    <script src="assets/js/themes/theme-gruvbox.js"></script>
    <script src="assets/js/themes/theme-idle_fingers.js"></script>
    <script src="assets/js/themes/theme-iplastic.js"></script>
    <script src="assets/js/themes/theme-katzenmilch.js"></script>
    <script src="assets/js/themes/theme-kr_theme.js"></script>
    <script src="assets/js/themes/theme-kuroir.js"></script>
    <script src="assets/js/themes/theme-merbivore.js"></script>
    <script src="assets/js/themes/theme-merbivore_soft.js"></script>
    <script src="assets/js/themes/theme-mono_industrial.js"></script>
    <script src="assets/js/themes/theme-monokai.js"></script>
    <script src="assets/js/themes/theme-pastel_on_dark.js"></script>
    <script src="assets/js/themes/theme-solarized_dark.js"></script>
    <script src="assets/js/themes/theme-solarized_light.js"></script>
    <script src="assets/js/themes/theme-sqlserver.js"></script>
    <script src="assets/js/themes/theme-terminal.js"></script>
    <script src="assets/js/themes/theme-textmate.js"></script>
    <script src="assets/js/themes/theme-tomorrow.js"></script>
    <script src="assets/js/themes/theme-tomorrow_night.js"></script>
    <script src="assets/js/themes/theme-tomorrow_night_blue.js"></script>
    <script src="assets/js/themes/theme-tomorrow_night_bright.js"></script>
    <script src="assets/js/themes/theme-tomorrow_night_eighties.js"></script>
    <script src="assets/js/themes/theme-twilight.js"></script>
    <script src="assets/js/themes/theme-vibrant_ink.js"></script>

    <script>
      let editor = ace.edit("editor");
      editor.session.setMode("ace/mode/javascript");
      editor.setTheme("ace/theme/eclipse");
      editor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: true,
      });
      editor.setValue("", 0);
      editor.completers.push({
        getCompletions: function (editor, session, pos, prefix, callback) {
          setTimeout(function () {
            callback(null, [
              {
                // string used for filtering
                value: "customCompletion",
                // optional, allows to display a caption different from value
                caption: "!!customCompletion!!",
                // optional, snippet that can be inseted instead of value
                snippet: "${2}insert${1:This}${2}Instead$0",
                // short description
                meta: "foo",
              },
              {
                value: "customCompletion2",
              },
            ]);
          }, 500);
        },
      });
    </script>
  </body>
</html>
