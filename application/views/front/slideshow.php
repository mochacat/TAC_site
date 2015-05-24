<div id="left-column">
<div class="slider-wrapper theme-default">
<div id="slideshow" class="nivoSlider" style="height: <?php echo $height; ?>px;">
    <?php $i = 0;
    foreach ($banners as $banner) { ?>
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" title="#caption<?php echo $i; ?>"/></a>
    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" title="#caption<?php echo $i; ?>"/>
    <?php } 
    $i ++;
    ?>
    <?php } ?>
</div><!-- close #slider -->
<?php foreach($captions as $key => $caption) :?>
    <div id="caption<?php echo $key; ?>" class="nivo-html-caption">
    	<div class="nivo-content">
    		<div class="nivo-title">
    			<h3>
    			<a href="<?php echo $caption['link']; ?>"> <?php echo $caption['title']; ?></a>
    			</h3>
    		</div>
        	<div class="nivo-author">
        		<p>By <?php echo $caption['author']; ?></p>
        	</div>
        </div>
    </div>
<?php endforeach; ?>


<script type="text/javascript">
$(window).load(function() {
	$('#slideshow').nivoSlider({
        effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
        slices: 1, // For slice animations
        boxCols: 1, // For box animations
        boxRows: 1, // For box animations
        animSpeed: 100, // Slide transition speed
        pauseTime: 5000, // How long each slide will show
        startSlide: 0, // Set starting Slide (0 index)
        directionNav: true, // Next & Prev navigation
        controlNav: false, // 1,2,3... navigation
        controlNavThumbs: false, // Use thumbnails for Control Nav
        pauseOnHover: false, // Stop animation while hovering
        manualAdvance: false, // Force manual transitions
        prevText: 'Prev', // Prev directionNav text
        nextText: 'Next', // Next directionNav text
        randomStart: false, // Start on a random slide
        beforeChange: function(){}, // Triggers before a slide transition
        afterChange: function(){}, // Triggers after a slide transition
        slideshowEnd: function(){}, // Triggers after all slides have been shown
        lastSlide: function(){}, // Triggers when last slide is shown
        afterLoad: function(){} // Triggers when slider has loaded
    });
});
</script>
</div>
