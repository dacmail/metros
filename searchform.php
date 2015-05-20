<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="wrapper"><input type="text" class="field" name="s" id="s" placeholder="Busca y pulsa enter" value="<?php the_search_query(); ?>"/></div>
</form>