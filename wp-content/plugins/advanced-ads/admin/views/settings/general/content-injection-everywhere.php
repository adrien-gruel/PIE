<input id="advanced-ads-injection-everywhere" type="number" value="<?php echo esc_attr( $everywhere ); ?>" min="-1" name="<?php echo esc_attr( ADVADS_SLUG ); ?>[content-injection-everywhere]">
<p class="description"><?php esc_html_e( 'Some plugins and themes trigger ad injections where it shouldn’t happen. Therefore, Advanced Ads ignores injected placements on non-singular pages and outside the loop. However, this can cause problems with some themes. Set this option to -1 in order to enable unlimited ad injection at your own risk, set it to 0 to keep it disabled or choose a positive number to enable the injection only in the first x posts on your archive pages.', 'advanced-ads' ); ?></p>