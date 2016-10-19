<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Realistic
 */

?>
	</div>

	<footer id="colophon" class="site-footer mdl-mega-footer" role="contentinfo">
		<div class="site-info mdl-mega-footer--bottom-section">
			<?php realistic_copyrights(); ?>
		</div><!-- .site-info -->	
		<div>
			<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t44.5;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='31' height='31'><\/a>")
//--></script><!--/LiveInternet-->
		</div>
	</footer><!-- #colophon -->
</div><!-- .mdl-layout -->
<?php wp_footer(); ?>
</body>
</html>
