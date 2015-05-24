<div id="left-post">
	<article>
	<div class="post">
		<h1><?= $title ?></h1>
		<div class="post-details">
		<ul>
			<li><a href="<?= base_url().'authors'?>">By <?= $author ?> / /</a></li>
			<li><a href="<?= base_url().$child_link ?>"><?= $child_cat ?> / /</a></li>
			<li class="right"><time pubdate="pubdate"><?= $date ?></time></li>
		</ul>
		</div>
		<div class="info">
		</div>
		<div class="post-content">
			<?= $content ?>
		</div>
		<div class="info">
		</div>
		<?php if ($author_img !== '' && $author_about !== ''){
			echo '
		<div id="author-img">
			<img src="'.$author_img.'" alt="'.$author.'" style="width:60px; height:60px;">
		</div>
		<div id="author-desc">
			'.$author_about.'
		</div>'; }
		else{
			echo '';
		}
		?>
		<br>
		<br>
		<div class="social">
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
			<a class="addthis_button_preferred_1"></a>
			<a class="addthis_button_preferred_2"></a>
			<a class="addthis_button_preferred_3"></a>
			<a class="addthis_button_preferred_4"></a>
			<a class="addthis_button_compact"></a>
			<a class="addthis_counter addthis_bubble_style"></a>
			</div>
			<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5152c6c075b19d09"></script>
			<!-- AddThis Button END -->
		</div>
	</div>
	</article>
	<div class="morebox">
		<p>Comments</p>
	</div>
	<div class="box"><?= $disqus ?></div>
</div>
<div id="right-post" class="posts">
	<?php if(isset($parent_cat)): ?>
		<div id="page-title">
			<a href="<?= base_url().'reviews'?>" title="<?= $parent_cat ?>">
				<img src="<?php echo base_url().'img/site/'.strtolower($parent_cat).'logo.png' ?>" alt="<?= $parent_cat ?>" style="height:auto;width:253px">
			</a>
		</div>
	<?php endif; ?>
	<?php if($parent_cat == "reviews"):?>
	<div id="categories" class="box">
		<div id="browse" class="box">
			<h4>Browse Categories</h4>
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
	<?php endif?>
	<div class="morebox">
	</div>
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
	<div class="morebox">
	</div>
	<div class="stamp">
		<a href="<?= base_url().'chronicle_cast'?>" title="Chronicle Cast">
			<img src="<?= base_url().'img/site/chroncast-logo.png'?>" alt="Chronicle Cast" style="height:85px">
		</a>
	</div>
	<div class="morebox">
	</div>
	<div id="fb-find">
		<div class="fb-like-box" data-href="http://www.facebook.com/pages/The-Alternative-Chronicle/106639599705?fref=ts" data-width="252" data-height="400" data-show-faces="false" data-stream="true" data-header="true"></div>		
	</div>
	<a href="<?= base_url()?>" title="The Alternative Chronicle">
	<img src="<?= base_url().'img/site/TAC-logo.png'?>" alt="The Alternative Chronicle Stamp" style="height:150px">
	</a>
</div>
