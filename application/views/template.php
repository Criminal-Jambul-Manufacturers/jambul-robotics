<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>{pagetitle}</title>
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/css/default.css"/>
	</head>
	<body>
        <div id="title">
            <img id="title-img" src="/assets/img/logo.png" height="100px" width="100px" /><h1>Jambul Robotics</h1>
        </div>
        <div id="header-container">
            <header id="header">
                {headcontent}
            </header>
        </div>
        <div id="container">
            <div id="content">
                {content}
            </div>
			<footer id="footer">
                {footcontent}
            </footer>
        </div>
        <script src="/assets/js/jquery-3.1.1.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
	</body>
</html>