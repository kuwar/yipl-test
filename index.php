<!DOCTYPE html>
<html>
<head>
    <title>Contract Locations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- Bootstrap core CSS -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.css" rel="stylesheet" media="screen">
 
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js"></script>
    <![endif]-->
 
    <link rel="stylesheet" type="text/css" href="assets/style/style.css">

</head>
<body>
	<div class="container">
		<div class="row">
			<div id="map-outer" class="col-md-12">
				<div id="address" class="col-md-4">					
					<h2>Contract Viewers</h2>
					<address>
						<div id="contract-container"></div>
					</address>
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
							<address id="contract-details">					
							</address>
						</div>
						<div id="map-container" class="col-md-12"></div>
					</div>					
				</div>
			</div><!-- /map-outer -->
		</div> <!-- /row -->
	</div><!-- /container -->
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    
    <!-- // <script type="text/javascript" src="assets/js/maps.js"></script> -->
    <script type="text/javascript" src="assets/js/custom.js"></script>
</body>
</html>