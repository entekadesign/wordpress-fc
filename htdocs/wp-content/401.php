<?php
header( 'HTTP/1.1 401 Authorization Required' );
header( 'Status: 401 Authorization Required' );
$siteurl = 'http://www.fatcatchdesign.com';
$themedir = '/wp-content/themes/Bones-FC';
list($type, $message, $file, $line) = error_get_last();
$error = "Error type: ".$type."\nFile: ".$file."\nLine: ".$line."\nMessage: ".$message.".";
mail( "marco@fatcatchdesign.com", "Authorization Required", "A FatCatchDesign.com user attempted login with invalid credentials.\n".$error, "From: FatCatch Design <noreply@fatcatchdesign.com>"."\r\n"."X-Mailer: PHP/".phpversion()."\r\n"."X-Priority: 2 (Normal)" );
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
	<title>FatCatch Design &#9642; Authorization Required</title>
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

								<h1><span>401 ERROR</span></h1>

								<article id="maintenance_mode" class="clearfix">

									<section>

										<p class="hyphenate">You have entered login credentials that are invalid for <a href="<?php echo $siteurl; ?>" rel="nofollow" title="FatCatch Design home page">FatCatch Design</a>. The administrator has been notified.</p><p class="hyphenate">Login using valid credentials.</p> 

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