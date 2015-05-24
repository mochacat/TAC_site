
	<div id="recent">
		<a href="<?= base_url()?>">
		<img src="<?= base_url().'img/site/recentlogo.png' ?>" alt="Recent">
		</a>
	</div>
	<div class="column">
		<a href="<?= base_url().'reviews' ?>"><h2>REVIEWS</h2></a>
		<div class="morebox"></div>
		<ul>
		<?php foreach ($recent_reviews as $index => $recent_review): ?>
		<li>
			<div class="home-info">
				<div class="home-title">
					<p><a href="<?=$recent_review['link']?>" title="<?=$recent_review['title']?>"> <?= $recent_review['title']?></a></p>
				</div>
				<div class="home-thumb box">
					<div class="thumb">
						<a href="<?=$recent_review['link']?>" title="<?=$recent_review['title']?>">
							<img src="<?=$recent_review['image']?>" alt="<?=$recent_review['title']?>">
						</a>
					</div>
				</div>	
			</div>
		</li>
		<?php endforeach ?>
		</ul>
		<div class="morebox"><div class="more"><a href="<?= base_url().'reviews' ?>">More</a></div></div>
	</div>
	<div class="column30"></div>
	<div class="column">
		<a href="<?= base_url().'specials' ?>">
		<h2>SPECIALS</h2>
		</a>
		<div class="morebox"></div>
		<ul>
		<?php foreach ($recent_specials as $index => $recent_special): ?>
		<li>
			<div class="home-info">
				<div class="home-title">
					<p><a href="<?=$recent_special['link']?>" title="<?=$recent_special['title']?>"> <?= $recent_special['title']?></a></p>
				</div>
				<div class="home-thumb box">
					<div class="thumb">
						<a href="<?=$recent_special['link']?>" title="<?=$recent_special['title']?>">
							<img src="<?=$recent_special['image']?>" alt="<?=$recent_special['title']?>">
						</a>
					</div>
				</div>	
			</div>
		</li>
		<?php endforeach ?>
		</ul>
		<div class="morebox"><div class="more"><a href="<?= base_url().'specials' ?>">More</a></div></div>
	</div>
</div>
<div id="right-column">
	<div id="tag-line">
		<div class="tag-logo">
		<a href="<?= base_url()?>" title="The Alternative Chronicle">
		<img src="<?= base_url().'img/site/TAC-logo.png'?>" alt="The Alternative Chronicle Stamp" style="height:150px">
		</a>
		</div>
		<a href="<?= base_url().'whats-this'?>" title="What's This?">
			<img src="<?= base_url().'img/site/tagline.png'?>" alt="Geeks and Artists vs. Culture" style="height:24px">
		</a>
	</div>
	<div id="categories" class="box">
		<div id="browse" class="box">
			<h4>Browse by Category</h4>
		</div>
		<div class="cat-tab">
			<a href="<?= base_url().'film'?>" title="Film">Film</a>
		</div>
		<div class="cat-tab">
			<a href="<?= base_url().'festivals'?>" title="Festivals">Festivals</a>
		</div>
		<div class="cat-tab">
			<a href="<?= base_url().'art_music'?>" title="Art & Music Reviews">Art &amp Music</a>
		</div>
		<div class="cat-tab">
			<a href="<?= base_url().'tv'?>" title="Television">Television</a>
		</div>
		<div class="cat-tab">
			<a href="<?= base_url().'books_comics'?>" title="Book & Comic Reviews">Books &amp Comics</a>
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
	<div id="fb-find">
		<div class="fb-like-box" data-href="http://www.facebook.com/pages/The-Alternative-Chronicle/106639599705?fref=ts" data-width="330" data-height="400" data-show-faces="true" data-stream="false" data-header="true"></div>		
	</div>
	<div class="hitme"><div class="aligncenter"><a href="<?= base_url().$random ?>" title="Hit Me!"><h3>Hit Me!</h3></a></div></div>
</div>
