<?php 
/**
 * A custom widget using the standard WP Widget class from the Widgets API. 
 * 
 * @param construct Constructor function where you can define your widget’s parameters.
 * @param widget    Contains the output of the widget.
 * @param form      Determines widget settings in the WordPress dashboard.
 * @param update    Updates widget settings.
 */

class Melody_Threewide_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'melody_threewide_widget',
            __('Melody Three-wide Page Widget', 'melody'),
            array ( 
                'description' => __( 'Sectionalized widget for landing page. Two Wide', 'melody' ), 
            )
        );
    }

    // Creating widget front-end
    public function widget( $args, $instance ) 
    {   
        /* Registered sidebar can only use before/after arguments once per sidebar. 
         * Some widgets like the gallery will take these arguments away from other widgets.
         * So we forced to use HTML tags here to replace args.
        */
        $title   = apply_filters( 'widget_title', 
                                    $instance['title'] );
        $content_one = apply_filters( 'widget_content_one', 
                                        $instance['content_one'] );
        $content_two = apply_filters( 'widget_content_two', 
                                        $instance['content_two'] );
        $content_three = apply_filters( 'widget_content_three', 
                                        $instance['content_three'] );
        
        // output
        
        if ( ! empty ( $title ) ) {
        echo '<header class="wide-container">
        <h3>' . esc_html( $title ) . '</h3>
        </header>'; 
        }
        echo '<div class="textwidget melody-html-widget-three">';
        echo '<div class="mldywidget-first-child padded">';
        echo wp_kses_post( $content_one );
        echo '</div>
        <div class="mldywidget-second-child padded">';
        echo wp_kses_post( $content_two );
        echo '</div>
        <div class="mldywidget-third-child padded">';
        echo wp_kses_post( $content_three );
        echo '</div>
        </div>';

        // before and after widget arguments are not used here
    }
    // Creating widget Backend
    public function form( $instance ) 
    {
        if ( isset( $instance[ 'title' ] ) ){
            $title   = $instance[ 'title' ];
        } else {
            $title   = __( 'Melody Two Sections Wide Area', 'melody' );
        }
        if ( isset( $instance[ 'content_one' ] ) ){
            $content_one = $instance[ 'content_one' ];
        } else {
            $content_one = '';
        } 
        if ( isset( $instance[ 'content_two' ] ) ){
            $content_two = $instance[ 'content_two' ];
        } else {
            $content_two = '';
        } 
        if ( isset( $instance[ 'content_three' ] ) ){
            $content_three = $instance[ 'content_three' ];
        } else {
            $content_three = '';
        } ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php esc_html_e( 'Title:', 'melody' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
            name="<?php echo $this->get_field_name( 'title' ); ?>" 
            type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <fieldset>
        <label for="<?php echo $this->get_field_id( 'content_one' ); ?>">
        <?php esc_html_e( 'HTML or Text:', 'melody' ); ?></label>
            <textarea class="widefat" 
                id="<?php echo $this->get_field_id( 'content_one' ); ?>" 
                cols="25" rows="10" 
                name="<?php echo $this->get_field_name( 'content_one' ); ?>"><?php echo wp_kses_post( $content_one ); ?></textarea>
        </fieldset>
        <fieldset>
        <label for="<?php echo $this->get_field_id( 'content_two' ); ?>">
        <?php esc_html_e( 'HTML or Text:', 'melody' ); ?></label>
            <textarea class="widefat" 
                id="<?php echo $this->get_field_id( 'content_two' ); ?>" 
                cols="25" rows="10" 
                name="<?php echo $this->get_field_name( 'content_two' ); ?>"><?php echo wp_kses_post( $content_two ); ?></textarea>
        </fieldset>
        <fieldset>
        <label for="<?php echo $this->get_field_id( 'content_three' ); ?>">
        <?php esc_html_e( 'HTML or Text:', 'melody' ); ?></label>
            <textarea class="widefat" 
                id="<?php echo $this->get_field_id( 'content_three' ); ?>" 
                cols="25" rows="10" 
                name="<?php echo $this->get_field_name( 'content_three' ); ?>"><?php echo wp_kses_post( $content_two ); ?></textarea>
        </fieldset>
        
        <?php
    }
   
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) 
    {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) 
                            ? strip_tags( $new_instance['title'] ) : '';

        $instance['content_one'] = ( ! empty( $new_instance['content_one'] ) ) 
                            ? wp_unslash( $new_instance['content_one'] ) : '';
        $instance['content_two'] = ( ! empty( $new_instance['content_two'] ) ) 
                            ? wp_unslash( $new_instance['content_two'] ) : '';
        $instance['content_three'] = ( ! empty( $new_instance['content_three'] ) ) 
                            ? wp_unslash( $new_instance['content_three'] ) : '';
        
            return $instance;
    }
} // ends class

/** #A9
 * Adding melody threewide page sectional widget
 * 
 * @param register_widget
 * @since 1.0.1
 */
function melody_register_threewide_widget() {
	register_widget( 'melody_threewide_widget' );
}
// A9
add_action( 'widgets_init', 'melody_register_threewide_widget' ); 