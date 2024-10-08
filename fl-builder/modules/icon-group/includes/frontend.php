<div class="fl-icon-group fl-icon-group-<?php echo $settings->align; ?>">
<?php

	foreach ( $settings->icons as $key => $icon ) {

		if ( ! is_object( $icon ) ) {
			continue;
		}

		// Text ID based on icon group module and icon position
		$text_id = $key . '-' . $module->node;

		$icon_settings = array(
			'bg_color'        => $settings->bg_color,
			'bg_hover_color'  => $settings->bg_hover_color,
			'color'           => $settings->color,
			// 'exclude_wrapper' => true,
			'hover_color'     => $settings->hover_color,
			'icon'            => $icon->icon,
			'link'            => $icon->link,
			'link_target'     => isset( $icon->link_target ) ? $icon->link_target : '_blank',
			'link_nofollow'   => isset( $icon->link_nofollow ) ? $icon->link_nofollow : 'nofollow',
			'size'            => $settings->size,
			'text'            => $icon->text,
			'text_id'					=> $text_id,
			'three_d'         => $settings->three_d,
		);

		/* Only icons with links */
		if ( $icon->link ) {
			FLBuilder::render_module_html( 'icon', $icon_settings );
		}
	}

?>
</div>
