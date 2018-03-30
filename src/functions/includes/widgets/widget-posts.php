<?php

class Posts_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'posts_widget',
			'description' => __( 'Displays a posts list.', 'rampensau' ),
		);
		parent::__construct(
      'posts_widget',
      esc_html__( 'Posts', 'rampensau' ),
      $widget_ops
    );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		// echo 'social widget';

		if( ! array_key_exists( 'number', $instance ) ) {
			$instance['number'] = 4;
		}

		if( ! array_key_exists( 'offset', $instance ) ) {
			$instance['offset'] = 0;
		}

    $args = [
      'post_type'      => 'podcast',
      'style'          => 'big-images',
			'posts_per_page' => $instance['number'],
			'offset'				 => $instance['offset']
    ];

		echo '<div class="widget widget-posts">' . get_posts_list($args) . '</div>';
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {

		$number_default = 3;
		$offset_default = 0;

		$number = ! empty( $instance['number'] ) ? $instance['number'] : $number_default;
		$offset = ! empty( $instance['offset'] ) ? $instance['offset'] : $offset_default;


    $output = '';

    // List Type
    // $output .= '<div class="widget-admin-item">';
    // $output .= '<label>' . __('List type', 'rampensau') . '</label>';
    // $output .= '<select name="list-type">';
    // $output .= '<option>' . __('Latest posts') . '</option>';
    // $output .= '<option>' . __('First posts') . '</option>';
    // $output .= '<option>' . __('Random posts') . '</option>';
    // $output .= '<option>' . __('Selected posts') . '</option>';
    // $output .= '</select>';
    // $output .= '</div>';

    // List Style
    // $output .= '<div class="widget-admin-item">';
    // $output .= '<label>' . __('List style', 'rampensau') . '</label>';
    // $output .= '<select name="list-type">';
    // $output .= '<option>' . __('Big images') . '</option>';
    // $output .= '<option>' . __('Small images') . '</option>';
    // $output .= '<option>' . __('No images') . '</option>';
    // $output .= '<option>' . __('Only images') . '</option>';
    // $output .= '</select>';
    // $output .= '</div>';

    // Post Type
    // $output .= '<div class="widget-admin-item">';
    // $output .= '<label>' . __('Post type', 'rampensau') . '</label>';
    // $output .= '<select name="type">';
    // $output .= '<option value="all">All</option>';
    // $output .= '<option value="post">Post</option>';
		//
    // $get_post_types_args = [ '_builtin' => false];
    // foreach ( get_post_types( $get_post_types_args, 'names' ) as $post_type ) {
    //   $output .=  '<option value="' . $post_type . '">' . ucfirst($post_type) . '</option>';
    // }
    // $output .= '</select>';
    // $output .= '</div>';

    // Category
    // $output .= '<div class="widget-admin-item">';
    // $output .= '<label>' . __('Post category', 'rampensau') . '</label>';
    // $output .= '<select name="category">';
    // $output .= '<option>Dummy Category</option>';
    // $output .= '</select>';
    // $output .= '</div>';

    // Tag
    // $output .= '<div class="widget-admin-item">';
    // $output .= '<label>' . __('Post tag', 'rampensau') . '</label>';
    // $output .= '<select name="tag">';
    // $output .= '<option>Dummy Tag</option>';
    // $output .= '</select>';
    // $output .= '</div>';

    // Post Number
    $output .= '<div class="widget-admin-item">';
    $output .= '<label>' . __('Number of Posts', 'rampensau') . '</label>';
    $output .= '<input type="text" value="' . esc_attr( $number ) . '" id="' . esc_attr( $this->get_field_id( 'number' ) ) . '" name="' . esc_attr( $this->get_field_name( 'number' ) ) . '">';
    $output .= '</div>';

		// Offset
		$output .= '<div class="widget-admin-item">';
		$output .= '<label>' . __('Offset', 'rampensau') . '</label>';
		$output .= '<input type="text" value="' . esc_attr( $offset ) . '" id="' . esc_attr( $this->get_field_id( 'offset' ) ) . '" name="' . esc_attr( $this->get_field_name( 'offset' ) ) . '">';
		$output .= '</div>';


    echo $output;
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved

		$instance = array();

		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
		$instance['offset'] = ( ! empty( $new_instance['offset'] ) ) ? strip_tags( $new_instance['offset'] ) : '';

		return $instance;
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Posts_Widget' );
});
