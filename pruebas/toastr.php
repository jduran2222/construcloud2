<html lang="en">
<head>
    <title>Jquery - notification popup box using toastr JS</title>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
</head>
<body>


<div class="container text-center">
	<br/>
		<h2>Jquery - notification popup box using toastr JS Plugin</h2>
	<br/>
	<button class="success btn btn-success">Success</button>
	<button class="error btn btn-danger">Error</button>
	<button class="info btn btn-info">Info</button>
	<button class="warning btn btn-warning">Warning</button>
</div>	


<script type="text/javascript">
	$(".success").click(function(){
		toastr.success('We do have the Kapua suite available.', 'Success Alert', {timeOut: 5000})
	});


	$(".error").click(function(){
		toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})
	});


	$(".info").click(function(){
		toastr.info('It is for your kind information', 'Information', {timeOut: 5000})
	});


	$(".warning").click(function(){
		toastr.warning('It is for your kind warning', 'Warning', {timeOut: 5000})
	});
</script>