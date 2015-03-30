<?php
require_once "db.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Gala Miage 2015 | Video Message</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">

      /* Sticky footer styles
      -------------------------------------------------- */

      html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -60px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      #footer {
        background-color: #f5f5f5;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }



      /* Custom page CSS
      -------------------------------------------------- */
      /* Not required for template or sticky footer method. */

      .container {
        width: auto;
        max-width: 680px;
      }
      .container .credit {
        margin: 20px 0;
      }

    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>Gala Miage 2015 Feed</h1>
        </div>
        <p class="lead">Tapez un message, et voyez le diffus&eacute; sur les &eacute;crans :)</p>
        <div id="post-success" class="alert alert-success hide"><b>Votre message a &eacute;t&eacute; enregistr&eacute; !</b> Il sera affich&eacute; apr&egrave;s validation :-)</div>
<form class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="inputName">Votre nom<br /><small>(20 caract&egrave;res)</small></label>
    <div class="controls">
      <input type="text" id="inputName" maxlength="20" placeholder="Votre nom" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputMessage">Votre message<br /><small>(140 caract&egrave;res)</small></label>
    <div class="controls">
      <input type="text" id="inputMessage" maxlength="140" placeholder="Votre message" required>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn" onclick="sendMsg();return false">Envoyer</button>
    </div>
  </div>
</form>
      <hr />
      <h2>Derniers messages post&eacute;s</h2>
      <div id="messages">
      </div>

      <div id="push"></div>
    </div>

    <div id="footer">
      <div class="container">
        <p class="muted credit">Page et syst&egrave;me de projection vid&eacute;o par <a href="http://www.xplod.fr/">Guillaume Lesniak</a>.</p>
      </div>
    </div>



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
function sendMsg() {
	var name = $("#inputName").val();
	var msg = $("#inputMessage").val();

	if (name != "" && msg != "") {
		$.post("rpc.php", {op: 'post', n: name, m: msg}, function(data) {
			if (data == "OK") {
				$("#post-success").fadeIn(500);
				setTimeout(function() { $("#post-success").fadeOut(400); }, 2000);
			}
		});
		$("#inputName").val("");
		$("#inputMessage").val("");
	}
}

var g_lastMsgId = 0;
var g_updateInterval = 3000;
function updateMsg() {
	$.post("rpc.php", {op: 'get', t: g_lastMsgId}, function(data) {
		var json = $.parseJSON(data);
		for (var i = json.length-1; i >= 0; i--) {
			$("#messages").prepend("<p>"+json[i].m+"<br /><small><b style='color:#AAA;'>PAR "+json[i].a.toUpperCase()+" - "+json[i].d+"</b></small></p>").hide().fadeIn(400);
			if (parseInt(json[i].t) > g_lastMsgId) { g_lastMsgId = parseInt(json[i].t); }

			if ($("#messages").children().length > 10) { $("#messages").children().last().remove(); }
		}
	});
}

function updateLoop() {
	updateMsg();
	setTimeout("updateLoop();", g_updateInterval);
}

$(function() {
	updateLoop();
});

    </script>
  </body>
</html>

