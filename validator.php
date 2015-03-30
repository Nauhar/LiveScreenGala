<?php
if ($_GET['gala'] != "sodomie") {
	header('Location: 404');
	die();
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>JNM | Video Message</title>
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
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 5px auto -60px;
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
	Penser a bien approuver dans l'ordre (haut en premier) sinon le message ne s'affichera pas!
	<a href="validator.php?gala=sodomie&<?php echo time(); ?>" class="btn btn-primary"><i class="icon-refresh icon-white"></i> Rafraichir</a><br /><br />
<?php

require_once("db.inc.php");
$query = mysql_query("SELECT * FROM jnm__messages WHERE Validation=0 ORDER BY Date ASC");
$hasOne = false;
while ($row = mysql_fetch_array($query)) {
$hasOne = true;
?>
<div id="post-<?php echo $row['IDMessage']; ?>">
	<b>Auteur: </b><?php echo $row['Auteur']; ?><br />
	<b>Message: </b><?php echo $row['Message']; ?><br />
	<a href="#" onclick="allow(<?php echo $row['IDMessage']; ?>);" class="btn btn-success">Approuver</a>  <a href="#" onclick="disallow(<?php echo $row['IDMessage']; ?>);" class="btn btn-danger">Supprimer</a>
</div>
<hr />
<?php } 

if (!$hasOne) {
?>
<i>Aucun message en attente</i>
<? }?>


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
function allow(id) {
	$.post("rpc.php", {op:'approve', passwd:'JNMNancy_No_Haxx_Plz_kthx', p:id}, function(data) {
//		window.location = 'validator.php?jnm=nancy54&'+new Date().getTime();
		$("#post-" + id).slideUp();
	});
}

function disallow(id) {
	$.post("rpc.php", {op:'disapprove', passwd:'JNMNancy_No_Haxx_Plz_kthx', p:id}, function(data) {
//		window.location = 'validator.php?jnm=nancy54&'+new Date().getTime();
		$("#post-" + id).slideUp();
	});
}
</script>
      </div>
    </div>
  </body>
</html>
