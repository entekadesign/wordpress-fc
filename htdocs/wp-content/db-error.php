<?php
header( 'HTTP/1.1 503 Service Temporarily Unavailable' );
header( 'Status: 503 Service Temporarily Unavailable' );
header( 'Retry-After: 3600' ); // 60 minutes
$siteurl = 'http://www.fatcatchdesign.com';
$themedir = '/wp-content/themes/Bones-FC';
list($type, $message, $file, $line) = error_get_last();
$error = "Error type: ".$type."\nFile: ".$file."\nLine: ".$line."\nMessage: ".$message.".";
mail( "marco@fatcatchdesign.com", "Database Error", "Wakey, wakey! FatCatchDesign.com is kaput! Unable to access database.\n".$error, "From: FatCatch Design <noreply@fatcatchdesign.com>"."\r\n"."X-Mailer: PHP/".phpversion()."\r\n"."X-Priority: 1 (High)" );
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
	<title>FatCatch Design &#9642; Database Error</title>
	<meta charset="utf-8" />
	<!-- Google Chrome Frame for IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<!-- mobile meta (hooray!) -->
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="shortcut icon" href="<?php echo $themedir; ?>/favicon.ico" />

	<link rel="stylesheet" href="<?php echo $themedir; ?>/library/css/style.css" type="text/css" media="screen" />
</head>
<body class="errorDB">

	<div id="container">

		<div id="page-wrapper" class="clearfix">

			<header class="header" role="banner">

				<div id="inner-header" class="wrap clearfix">

					<h1 id="logo"><a href="<?php echo $siteurl; ?>" rel="nofollow" title="FatCatch Design home page" class="image-replacement">FatCatch Design</a></h1>
		
				</div> <!-- end #inner-header -->

			</header> <!-- end header -->

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="first clearfix" role="main">

						<div id="page-header" class="clearfix">

							<div id="img-error" class="page-header-image clearfix"></div>

							<div class="page-header-text clearfix">

								<h1><span>503 ERROR</span></h1>

								<article id="maintenance_mode" class="clearfix">

									<section>

										<p class="hyphenate">A rare technical problem has disabled <a href="<?php echo $siteurl; ?>" rel="nofollow" title="FatCatch Design home page">FatCatch Design</a>. A message that it needs fixing has been sent to the administrator.</p><p class="hyphenate">Please try again later.</p> 

									</section>

								</article> <!-- end article -->

							</div>

						</div>

					</div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

			<div id="footer-pad"></div> <!-- to position footer at bottom of page -->

		</div> <!-- #page-wrapper end -->

		<footer role="contentinfo" id="page-footer">

			<div id="inner-footer" class="clearfix">

				<div id="attribution-links" class="clearfix"><ul class="clearfix"><li class="menu-item" id="fatcatch-credit">&copy; 2011-<?php echo date('y'); ?> <a href="mailto:info@fatcatchdesign.com" title="Send us an e-mail">FatCatch Design</a></li><li id="html5-logo-wrapper" class="menu-item"><a href="http://www.w3.org/html/logo/faq.html" title="Built with HTML5" data-icon="&#xe006;"><span>HTML5</span></a></li></ul></div>

			</div> <!-- end #inner-footer -->
			
		</footer> <!-- end footer -->

	</div> <!-- end #container -->

</body>
</html>
<?php die(); ?>