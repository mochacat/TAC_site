<div id="left-column">
	<div id="main-featured" class="box">
	<div class="feature-wrap">
	<a href="<?php echo $main_link?>" alt="Home page">
		<div class="main-block">
			<div class="main-box opacity"></div>
			<div class="main-caption">
				<h3><?php echo $main_title?></h3>
			</div>
		</div>
		<div class="main-tab">
			<img src="/img/site/featured_corner.png">
		</div>
		<div class="main-image">
			<img src="<?php echo $main_image; ?>" alt="<?php echo $main_title; ?>" style="width:565px; height:377px">		
		</div>		
	</a>
	</div>
	</div>
	<div id="featured-logo">
		<img src="<?= base_url().'img/site/featuredlogo.png'?>" title="Featured">
	</div>
	<div>
		
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
		
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(function() 
		{
		$('.more').live("click",function() 
		{
		var ID = $(this).attr("id");
		if(ID)
		{
		$("#more"+ID).html('<img src="/img/site/ajax-loader.gif" />');

		$.ajax({
			type: "POST",
			url: '<?= base_url(); ?>reviews',
			data: "lastmsg="+ ID,
			dataType: "html",
			async:true,
			cache: false,
			success: function(html){
			$("ol#updates").append(html);
			$("#more"+ID).remove(); // removing old more button
			}
			});
			}
		else
		{
		$(".morebox").html('The End');// no results
		}

		return false;
		});
		});
		
	</script>
	<script type="text/javascript">
		$(function() {
    $(".recent-thumb box").hover(
    function() {
        $(this).css('background-color', '#ff0')
    }, function() {
        $(this).css('background-color', '')
    });
});​
	</script>
	<div id='recent-container'>
	<ol class="timeline" id="updates">
	<?php echo $recent_content; ?>
	</div>
	</ol>
	</div>
<div id="right-column">
	<div id="page-title">
		<img src="<?= base_url().'img/site/reviewslogo.png' ?>" alt="Reviews">
	</div>
	<div class="stamp">
		<a href="<?= base_url()?>" title="The Alternative Chronicle">
			<img src="<?= base_url().'img/site/TAC-logo.png'?>" alt="The Alternative Chronicle Stamp" style="height:150px">
		</a>
	</div>
	<div id="tag-line">
		<a href="<?= base_url().'whats-this'?>" title="What's This?">
			<img src="<?= base_url().'img/site/tagline.png'?>" alt="Geeks and Artists vs. Culture" style="height:24px">
		</a>
	</div>
	<div id="categories" class="box">
		<div id="browse" class="box">
			<h4>Browse by Category</h4>
		</div>
		<div class="cat-tab">
			<a href="/film" title="Film">Film</a>
		</div>
		<div class="cat-tab">
			<a href="/festivals" title="Festivals">Festivals</a>
		</div>
		<div class="cat-tab">
			<a href="/art_music" title="Art & Music Reviews">Art &amp Music</a>
		</div>
		<div class="cat-tab">
			<a href="/tv" title="Television">Television</a>
		</div>
		<div class="cat-tab">
			<a href="/books_comics" title="Book & Comic Reviews">Books &amp Comics</a>
		</div>
	</div>
	<div class="morebox"></div>
	<div id="donate-block">
		<p>Thank you for supporting independent media!</p>
		<div id="donate-button">
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_donations">
		<input type="hidden" name="business" value="mylastserenade707@sbcglobal.net">
		<input type="hidden" name="lc" value="US">
		<input type="hidden" name="item_name" value="The Alternative Chronicle">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="currency_code" value="USD">
		<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
		</div>
	</div>
	<div class="morebox"></div>
	<div class="stamp">
		<a href="<?= base_url().'chronicle_cast'?>" title="Chronicle Cast">
			<img src="<?= base_url().'img/site/chroncast-logo.png'?>" alt="Chronicle Cast" style="height:110px">
		</a>
	</div>
	<div class="morebox"></div>
	<div id="fb-find">
		<div class="fb-like-box" data-href="http://www.facebook.com/pages/The-Alternative-Chronicle/106639599705?fref=ts" data-width="336" data-height="400" data-show-faces="true" data-stream="false" data-header="true"></div>		
	</div>
	<a class="twitter-timeline" href="https://twitter.com/AltChronicle" data-widget-id="317890490433413120">Tweets by @AltChronicle</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<a class="twitter-timeline" href="https://twitter.com/AltChronicle" data-widget-id="317890490433413120">Tweets by @AltChronicle</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

