
<!--Navbar-->
<div id="navbar-wrapper">
	<div id="navbar">
		<ul>
			<?php foreach($navtabs as $page => $link): ?>
			<li class="nav-tab">
				<a href="<?php echo $link?>" title="<?php echo $page?>"><?php echo $page?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<div class="content">

