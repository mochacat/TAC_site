<?php echo doctype('html5') ?>

<html>
	<head>
		<title><?php echo $title ?></title>
		<meta charset="UTF-8">
		<?php if (isset($meta_desc)) :?>
		<meta name="description" content="<?php echo $meta_desc ?>">
		<?php endif;?>
		<?php if (isset($meta_key)) :?>
		<meta name="keywords" content="<?php echo $meta_key ?>">
		<?php endif;?>
		<meta name="robots" content="all">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script src="js/jquery-ui-1.8.16.custom.min.js"></script>
		<meta name="google-site-verification" content="NtlQqJUOm-6md6gAo0jvRyD4htCvTFImCi5lZsoTmdY" />
		<?php echo link_tag('css/jquery-ui-1.8.16.custom.css'); ?>
		<!--[if lt IE 9]>
		<script src="dist/html5shiv.js"></script>
		<![endif]-->
		<?php if (isset($slider_resources)){
			echo $slider_resources;
		} ?>
		<?php echo link_tag('css/stylesheet.css'); ?>
  		<link href="/img/site/favicon.ico" rel="icon" type="image/x-icon" />
  		<script type="text/javascript" src="http://mediaplayer.yahoo.com/js"></script>
  		<!--Google Analytics -->
  		<script>
  			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  			ga('create', 'UA-39767758-1', 'thealternativechronicle.com');
  			ga('send', 'pageview');
  		</script>
	</head>
	<body>
		<!--Header-->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
  		var js, fjs = d.getElementsByTagName(s)[0];
  		if (d.getElementById(id)) return;
  		js = d.createElement(s); js.id = id;
  		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
 		 fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="container">
			<div id="header">
				<div id="social-links">
					<?php foreach ($social_links as $social_link) { ?>
					<a href="<?= $social_link['url'] ?>" title="<?= $social_link['title'] ?>">
						<img src="<?php echo base_url().$social_link['img'] ?>" alt="<?php echo base_url().$social_link['title'] ?>" style="height: <?php echo $social_height; ?>px;">
					</a>
					<?php } ?>
					<a href="<?= base_url().'rss'?>" title="Subscribe to our RSS feed!">
						<img src="<?= base_url().'img/site/rsslogo.png'?>" alt="RSS" style="height:45px;">
					</a>
				</div>
					<a href="<?php echo base_url()?>" title="Home page">
						<img src="<?php echo base_url()."img/site/AltChron3.png"?>" alt="The Alternative Chronicle" id="logo">
					</a>
			</div>

			