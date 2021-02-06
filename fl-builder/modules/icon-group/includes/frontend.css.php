<?php

FLBuilder::render_module_css('icon', $id, array(
	'align'                => '',
	'bg_color'             => $settings->bg_color,
	'bg_hover_color'       => $settings->bg_hover_color,
	'color'                => $settings->color,
	'hover_color'          => $settings->hover_color,
	'icon'                 => '',
	'link'                 => '',
	'link_target'          => '',
	'size'                 => $settings->size,
	'size_unit'            => $settings->size_unit,
	'size_medium'          => $settings->size_medium,
	'size_medium_unit'     => $settings->size_medium_unit,
	'size_responsive'      => $settings->size_responsive,
	'size_responsive_unit' => $settings->size_responsive_unit,
	'text'                 => '',
	'three_d'              => $settings->three_d,
));

?>
<?php
foreach ( $settings->icons as $i => $icon ) :
	$index = $i + 1;

	if ( ! empty( $icon->bg_color ) ) {

		foreach ( array( '', 'medium', 'responsive' ) as $device ) {

			$key      = empty( $device ) ? 'size' : "size_{$device}";
			$unit_key = "{$key}_unit";

			if ( isset( $settings->{ $key } ) && ! empty( $settings->{ $key } ) ) {

				FLBuilderCSS::rule( array(
					'media'    => $device,
					'selector' => ".fl-node-$id .fl-module-content .fl-icon:nth-child($index) i",
					'props'    => array(
						'line-height' => array(
							'value' => $settings->{ $key } * 1.75,
							'unit'  => $settings->{ $unit_key },
						),
						'height'      => array(
							'value' => $settings->{ $key } * 1.75,
							'unit'  => $settings->{ $unit_key },
						),
						'width'       => array(
							'value' => $settings->{ $key } * 1.75,
							'unit'  => $settings->{ $unit_key },
						),
					),
				) );
			}
		}
	}

	?>

	<?php if ( isset( $icon->color ) && ! empty( $icon->color ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon i,
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon i:before {
		color: <?php echo FLBuilderColor::hex_or_rgb( $icon->color ); ?>;
	}
	<?php endif; ?>

	<?php if ( isset( $icon->bg_color ) && ! empty( $icon->bg_color ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon i {
		background: <?php echo FLBuilderColor::hex_or_rgb( $icon->bg_color ); ?>;
		border-radius: 100%;
		-moz-border-radius: 100%;
		-webkit-border-radius: 100%;
		text-align: center;
	}
	<?php endif; ?>
	<?php if ( isset( $icon->hover_color ) && ! empty( $icon->hover_color ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):hover .fl-icon i,
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):focus .fl-icon i,
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):hover .fl-icon i:before,
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):focus .fl-icon i:before,
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):hover .fl-icon a i,
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):focus .fl-icon a i,
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):hover .fl-icon a i:before,
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):focus .fl-icon a i:before {
		color: <?php echo FLBuilderColor::hex_or_rgb( $icon->hover_color ); ?>;
	}
	<?php endif; ?>
	<?php if ( isset( $icon->bg_hover_color ) && ! empty( $icon->bg_hover_color ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):hover .fl-icon i,
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):focus .fl-icon i,
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):hover .fl-icon a i,
	.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-wrap:nth-child(<?php echo $index; ?>):focus .fl-icon a i {
		background: <?php echo FLBuilderColor::hex_or_rgb( $icon->bg_hover_color ); ?>;
	}
	<?php endif; ?>


	/**
	 * Text Color
	 */
	 <?php if ( $settings->text_color ) : ?>
		/* Get color from text color control */
	 .fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text,
	 .fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text a,
	 .fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text p {
	 	color: <?php echo FLBuilderColor::hex_or_rgb( $settings->text_color ); ?>;
	 }
 	<?php elseif ( $icon->bg_color ) : ?>
		/* Get color from icon background color control */
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text p {
		 color: <?php echo FLBuilderColor::hex_or_rgb( $icon->bg_color ); ?>;
		}
	<?php elseif ( $icon->color ) : ?>
		/* Get color from icon color control */
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text p {
		 color: <?php echo FLBuilderColor::hex_or_rgb( $icon->color ); ?>;
		}
	<?php elseif ( $settings->bg_color ) : ?>
		/* Get color from global background color control */
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text p {
		 color: <?php echo FLBuilderColor::hex_or_rgb( $settings->bg_color ); ?>;
		}
	<?php elseif ( $settings->color ) : ?>
		/* Get color from global color control */
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index; ?>) .fl-icon-text p {
		 color: <?php echo FLBuilderColor::hex_or_rgb( $settings->color ); ?>;
		}
	<?php endif; ?>

	/**
	 * Text Hover Color
	 */
	 <?php if ( $settings->text_hover_color ) : ?>
		/* Get color from text hover color control */
	 .fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text,
	 .fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text,
	 .fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text a,
	 .fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text a,
	 .fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text p,
	 .fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text p {
	 	color: <?php echo FLBuilderColor::hex_or_rgb( $settings->text_hover_color ); ?>;
	 }
 	<?php elseif ( $icon->bg_hover_color ) : ?>
		/* Get color from icon background hover color control */
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text p,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text p {
		 color: <?php echo FLBuilderColor::hex_or_rgb( $icon->bg_hover_color ); ?>;
		}
	<?php elseif ( $icon->hover_color ) : ?>
		/* Get color from icon hover color control */
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text p,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text p {
		 color: <?php echo FLBuilderColor::hex_or_rgb( $icon->hover_color ); ?>;
		}
	<?php elseif ( $settings->bg_hover_color ) : ?>
		/* Get color from global background hover color control */
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text p,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text p {
		 color: <?php echo FLBuilderColor::hex_or_rgb( $settings->bg_hover_color ); ?>;
		}
	<?php elseif ( $settings->hover_color ) : ?>
		/* Get color from global hover color control */
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text a,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):hover .fl-icon-text p,
		.fl-node-<?php echo $id; ?> .fl-icon-wrap:nth-child(<?php echo $index ?>):focus .fl-icon-text p {
		 color: <?php echo FLBuilderColor::hex_or_rgb( $settings->hover_color ); ?>;
		}
	<?php endif; ?>

<?php endforeach; ?>

/**
 * Text Typography
 */
<?php
	FLBuilderCSS::typography_field_rule( array(
   'settings'    => $settings,
   'setting_name'    => 'text_typography',
   'selector'    => ".fl-node-$id .fl-icon-text, .fl-node-$id .fl-icon-text a, .fl-node-$id .fl-icon-text p",
 	) );
?>

/* Left */
.fl-node-<?php echo $id; ?> .fl-icon-group-left .fl-icon {
	margin-right: <?php echo $settings->spacing; ?>px;
}

/* Center */
.fl-node-<?php echo $id; ?> .fl-icon-group-center .fl-icon {
	margin-left: <?php echo $settings->spacing; ?>px;
	margin-right: <?php echo $settings->spacing; ?>px;
}

/* Right */
.fl-node-<?php echo $id; ?> .fl-icon-group-right .fl-icon {
	margin-left: <?php echo $settings->spacing; ?>px;
}
