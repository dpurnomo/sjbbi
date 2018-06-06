		<!--iOS specific -->
		<link rel="apple-touch-startup-image" href="../img/sjbbi/launch.png">
		<link rel="shortcut icon" href="../assets/img/sjbbi/favicon.ico" type="image/x-icon" /> 
		<link rel="apple-touch-icon" href="../assets/img/sjbbi/apple-touch-icon.png" /> 
		<link rel="apple-touch-icon" sizes="57x57" href="../assets/img/sjbbi/apple-touch-icon-57x57.png" /> 
		<link rel="apple-touch-icon" sizes="72x72" href="../assets/img/sjbbi/apple-touch-icon-72x72.png" /> 
		<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/sjbbi/apple-touch-icon-76x76.png" /> 
		<link rel="apple-touch-icon" sizes="114x114" href="../assets/img/sjbbi/apple-touch-icon-114x114.png" /> 
		<link rel="apple-touch-icon" sizes="120x120" href="../assets/img/sjbbi/apple-touch-icon-120x120.png" /> 
		<link rel="apple-touch-icon" sizes="144x144" href="../assets/img/sjbbi/apple-touch-icon-144x144.png" /> 
		<link rel="apple-touch-icon" sizes="152x152" href="../assets/img/sjbbi/apple-touch-icon-152x152.png" /> 
		<link rel="apple-touch-icon" sizes="180x180" href="../assets/img/sjbbi/apple-touch-icon-180x180.png" /> 

<meta name="apple-mobile-web-app-capable" content="yes">

<!--Javascript to prevent WebApp to open links to Safari - iOS only -->
<script type="text/javascript">
	
	if(("standalone" in window.navigator) && window.navigator.standalone){
	
	var noddy, remotes = false;
	
	document.addEventListener('click', function(event) {
	
	noddy = event.target;
	
	while(noddy.nodeName !== "A" && noddy.nodeName !== "HTML") {
	noddy = noddy.parentNode;
	}
	
	if('href' in noddy && noddy.href.indexOf('http') !== -1 && (noddy.href.indexOf(document.location.host) !== -1 || remotes))
	{
	event.preventDefault();
	document.location.href = noddy.href;
	}
	
	},false);
	}
	</script>
