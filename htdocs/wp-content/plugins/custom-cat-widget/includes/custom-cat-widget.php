<?php

class Custom_Cat_Widget extends WP_Widget {

	public $name = 'Custom Cateogory Widget';
	public $description = 'Widget for displaying custom categories as list.';
	/* List all controllable options here along with a default value. 
	The values can be distinct for each instance of the widget. */
	public $control_options = array();


	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_options = array(
			'classname'    => __CLASS__,
			'description'    => $this->description,
		);

		parent::__construct( __CLASS__, $this->name,$widget_options,$this->control_options);
	}

	/**
	 * Front-end display of widget.
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		echo '<ul>';

		$args = array( 'taxonomy' => 'topics' );

		$terms = get_terms('topics', $args);

	    foreach ($terms as $term) {
	    	echo '<li class="cat-item cat-item-cust-' . $term->term_id . '"><a class="button" href="' . get_term_link( $term->slug, $term->taxonomy ) . '" title="' . sprintf(__('View all posts filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';
	    }


		echo '</ul>';
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}

	//!!! Static Functions
	static function register_custom_cat_widget()
	{
		register_widget(__CLASS__);
	}


} // class Custom_Cat_Widget

/* EOF */