<?php

/**
 * @class FLIconGroupModule
 */
class FLIconGroupModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Icon Group', 'fl-builder' ),
			'description'     => __( 'Display a group of linked Font Awesome icons.', 'fl-builder' ),
			'category'        => __( 'Media', 'fl-builder' ),
			'editor_export'   => false,
			'partial_refresh' => true,
			'icon'            => 'star-filled.svg',
		));
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLIconGroupModule', array(
	'icons' => array(
		'title'    => __( 'Icons', 'fl-builder' ),
		'sections' => array(
			'general' => array(
				'title'  => '',
				'fields' => array(
					'icons' => array(
						'type'         => 'form',
						'label'        => __( 'Icon', 'fl-builder' ),
						'form'         => 'icon_group_form', // ID from registered form below
						'preview_text' => 'icon', // Name of a field to use for the preview text
						'multiple'     => true,
					),
				),
			),
		),
	),
	'style' => array( // Tab
		'title'    => __( 'Style', 'fl-builder' ), // Tab title
		'sections' => array( // Tab Sections
			'structure' => array( // Section
				'title'  => __( 'Icon', 'fl-builder' ), // Section Title
				'fields' => array( // Section Fields
					'size'    => array(
						'type'       => 'unit',
						'label'      => __( 'Size', 'fl-builder' ),
						'default'    => '30',
						'sanitize'   => 'floatval',
						'responsive' => true,
						'units'      => array( 'px', 'em', 'rem' ),
						'slider'     => true,
						'preview'    => array(
							'type' => 'none',
						),
					),
					'spacing' => array(
						'type'     => 'unit',
						'label'    => __( 'Spacing', 'fl-builder' ),
						'default'  => '10',
						'sanitize' => 'absint',
						'units'    => array( 'px' ),
						'slider'   => true,
						'preview'  => array(
							'type' => 'none',
						),
					),
					'align'   => array(
						'type'    => 'align',
						'label'   => __( 'Alignment', 'fl-builder' ),
						'default' => 'center',
						'preview' => array(
							'type' => 'none',
						),
					),
				),
			),
			'colors'    => array( // Section
				'title'  => __( 'Icon Colors', 'fl-builder' ), // Section Title
				'fields' => array( // Section Fields
					'color'          => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Color', 'fl-builder' ),
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'      => 'css',
							'selector'  => '.fl-icon i, .fl-icon i::before',
							'property'  => 'color',
							'important' => true,
						),
					),
					'hover_color'    => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Hover Color', 'fl-builder' ),
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'      => 'css',
							'selector'  => '.fl-icon i:hover, .fl-icon i:hover::before',
							'property'  => 'color',
							'important' => true,
						),
					),
					'bg_color'       => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Background Color', 'fl-builder' ),
						'show_reset'  => true,
						'show_alpha'  => true,
					),
					'bg_hover_color' => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Background Hover Color', 'fl-builder' ),
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'none',
						),
					),
					'three_d'        => array(
						'type'    => 'select',
						'label'   => __( 'Gradient', 'fl-builder' ),
						'default' => '0',
						'options' => array(
							'0' => __( 'No', 'fl-builder' ),
							'1' => __( 'Yes', 'fl-builder' ),
						),
					),
				),
			),
			'text'    => array( // Section
				'title'  => __( 'Text', 'fl-builder' ), // Section Title
				'fields' => array( // Section Fields
					'text_color'          => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Color', 'fl-builder' ),
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'      => 'css',
							'selector'  => '.fl-icon-text, .fl-icon-text a, .fl-icon-text p',
							'property'  => 'color',
							'important' => true,
						),
					),
					'text_hover_color'    => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Hover Color', 'fl-builder' ),
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'      => 'css',
							'selector'  => '.fl-icon-text:hover, .fl-icon-text:hover a, .fl-icon-text:hover p',
							'property'  => 'color',
							'important' => true,
						),
					),
					'text_typography'  => array(
						'type'           => 'typography',
						// 'connections'    => array( 'color' ),
						'label'          => __( 'Typography', 'fl-builder' ),
						'responsive'     => true,
						'preview'        => array(
							'type'         => 'css',
							'selector'     => '.fl-icon-text, .fl-icon-text a, .fl-icon-text p',
							// 'important'    => true,
						),
					),
					// 'bg_color'       => array(
					// 	'type'        => 'color',
					// 	'connections' => array( 'color' ),
					// 	'label'       => __( 'Background Color', 'fl-builder' ),
					// 	'show_reset'  => true,
					// 	'show_alpha'  => true,
					// ),
					// 'bg_hover_color' => array(
					// 	'type'        => 'color',
					// 	'connections' => array( 'color' ),
					// 	'label'       => __( 'Background Hover Color', 'fl-builder' ),
					// 	'show_reset'  => true,
					// 	'show_alpha'  => true,
					// 	'preview'     => array(
					// 		'type' => 'none',
					// 	),
					// ),
					// 'three_d'        => array(
					// 	'type'    => 'select',
					// 	'label'   => __( 'Gradient', 'fl-builder' ),
					// 	'default' => '0',
					// 	'options' => array(
					// 		'0' => __( 'No', 'fl-builder' ),
					// 		'1' => __( 'Yes', 'fl-builder' ),
					// 	),
					// ),
				),
			),
		),
	),
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('icon_group_form', array(
	'title' => __( 'Add Icon', 'fl-builder' ),
	'tabs'  => array(
		'general' => array( // Tab
			'title'    => __( 'General', 'fl-builder' ), // Tab title
			'sections' => array( // Tab Sections
				'general' => array( // Section
					'title'  => '', // Section Title
					'fields' => array( // Section Fields
						'icon' => array(
							'type'  => 'icon',
							'label' => __( 'Icon', 'fl-builder' ),
						),
						'link' => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'fl-builder' ),
							'show_target'   => true,
							'show_nofollow' => true,
							'connections'   => array( 'url' ),
						),
					),
				),
				'text'    => array(
					'title'  => __( 'Text', 'fl-builder' ),
					'fields' => array(
						'text' => array(
							'type'          => 'editor',
							'label'         => '',
							'media_buttons' => false,
							'inline_editor' => false,
							'connections'   => array( 'string' ),
							'preview'       => array(
								'type'     => 'text',
								'selector' => '.fl-icon-text-wrap',
							),
						),
					),
				),
			),
		),
		'style'   => array( // Tab
			'title'    => __( 'Style', 'fl-builder' ), // Tab title
			'sections' => array( // Tab Sections
				'colors' => array( // Section
					'title'  => __( 'Colors', 'fl-builder' ), // Section Title
					'fields' => array( // Section Fields
						'color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'fl-builder' ),
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'hover_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Hover Color', 'fl-builder' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'bg_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'fl-builder' ),
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'bg_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'fl-builder' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
	),
));
