<?php

namespace Pr\Customization;


function announcement( $wp_customize ) {

	$wp_customize->add_section( 'announcement_section', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Announcement', 'rampensau' ),
	    'description' => '',
	) );


  $wp_customize->add_setting( 'show_announcement', array(
      'capability' => 'edit_theme_options',
      'default'    => 'not-active',
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'show_announcement',
    array(
      'label'     => __( 'Status', 'rampensau' ),
      'section'   => 'announcement_section',
      'settings'  => 'show_announcement',
      'type'      => 'select',
      'choices'   => array(
        'not-active' => __('Not active'),
        'active'     => __('Active')
      )
    )
  );


	$wp_customize->add_setting( 'announcement_content', array(
			'capability' => 'edit_theme_options',
			'default'    => '',
			'type'       => 'option',
		)
	);

	$wp_customize->add_control( 'announcement_content',
		array(
			'label'     => __( 'Content', 'rampensau' ),
			'section'   => 'announcement_section',
			'settings'  => 'announcement_content',
			'type'      => 'textarea'
		)
	);


	$wp_customize->add_setting( 'announcement_style', array(
			'capability' => 'edit_theme_options',
			'default'    => 'small',
			'type'       => 'option',
		)
	);

	$wp_customize->add_control( 'announcement_style',
		array(
			'label'     => __( 'Style', 'rampensau' ),
			'section'   => 'announcement_section',
			'settings'  => 'announcement_style',
			'type'      => 'select',
			'choices'   => array(
				'small' => __( 'Small', 'rampensau' ),
				'large' => __( 'Large', 'rampensau' )
			)
		)
	);


	$wp_customize->add_setting( 'announcement_bg_color', array(
			'capability' => 'edit_theme_options',
			'default'    => '#111111',
			'type'       => 'option',
		)
	);

	$wp_customize->add_control( 'announcement_bg_color',
		array(
			'label'     => __( 'Background Color', 'rampensau' ),
			'section'   => 'announcement_section',
			'settings'  => 'announcement_bg_color',
			'type'      => 'color'
		)
	);


	$wp_customize->add_setting( 'announcement_text_color', array(
			'capability' => 'edit_theme_options',
			'default'    => '#f2f2f2',
			'type'       => 'option',
		)
	);

	$wp_customize->add_control( 'announcement_text_color',
		array(
			'label'     => __( 'Text Color', 'rampensau' ),
			'section'   => 'announcement_section',
			'settings'  => 'announcement_text_color',
			'type'      => 'color'
		)
	);


	$wp_customize->add_setting( 'announcement_link', array(
			'capability' => 'edit_theme_options',
			'default'    => '',
			'type'       => 'option',
		)
	);

	$wp_customize->add_control( 'announcement_link',
		array(
			'label'       => __( 'Link', 'rampensau' ),
			'section'     => 'announcement_section',
			'settings'    => 'announcement_link',
			'type'        => 'url',
      'description' => __( 'Turns the whole announcement bar into a Link to this address. Don\'t use links in the content if you use this.', 'rampensau' ),
		)
	);
}

add_action( 'customize_register', __NAMESPACE__ . '\\announcement' );
