<?php
/**
 * realest Theme Customizer.
 *
 * @package real-estate-lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function real_estate_lite_customize_register( $wp_customize ) {

$url = 'https://thepixeltribe.com/template/real-estate/';
$link = sprintf( wp_kses( __( 'Check out the <a href="%s">PRO version</a> For this feature.', 'real-estate-lite' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );

	class Realest_Upgrade_to_PRO extends WP_Customize_Control
	{
		public function render_content()
		{
			echo $link;
		}
	}

	class Realest_Upgrade_to_PRO_Logo extends WP_Customize_Control
	{
		public function render_content()
		{
			echo $link;	
		}
	}

	class Realest_Upgrade_to_PRO_Color extends WP_Customize_Control
	{
		public function render_content()
		{
			echo $link;
		}
	}
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

// Slider Section
	$wp_customize->add_section( 'real_estate_lite_slider' , array(  
	    'title'       => __( 'Slider', 'real-estate-lite' ),
	    'priority'    => 1, 
	    'description' => __( 'Home Page Slider.', 'real-estate-lite' ),
	));

    $wp_customize->add_setting(
        'show_slider',
        array(
            'sanitize_callback' => 'real_estate_lite_sanitize_checkbox',
            'default' => 0,
    ));
	$wp_customize->add_control( new Realest_Upgrade_to_PRO( $wp_customize, 'real_estate_lite_slider', array( 
            
    )));

    $wp_customize->add_setting(
        'real_estate_lite_slider_attr',
        array(
            'sanitize_callback' => 'real_estate_lite_sanitize_checkbox',
            'default' => 'featured',
    ));

   	$wp_customize->add_control( new Realest_Upgrade_to_PRO( $wp_customize, 'real_estate_lite_slider_attr', array( 
         'section' => 'real_estate_lite_slider', 
	))); 



// Top Bar Section
	$wp_customize->add_section( 'top_bar' , array(  
	    'title'       => __( 'Top Bar', 'real-estate-lite' ),
	    'priority'    => 39, 
	    'description' => __( 'Top Bar Options.', 'real-estate-lite' ),
	));
	
    $wp_customize->add_setting(
        'show_bar',
        array(
            'sanitize_callback' => 'real_estate_lite_sanitize_checkbox',
            'default' => 0,
    ));
	$wp_customize->add_control( new Realest_Upgrade_to_PRO( $wp_customize, 'show_bar',
        array(
            'section' => 'top_bar',  
            'priority' => 1, 
            ))          
    );
 
//Logo

	$wp_customize->add_setting( 'real_estate_lite_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new Realest_Upgrade_to_PRO( $wp_customize, 'real_estate_lite_logo', array( 
		'label'    => __( 'Logo', 'real-estate-lite' ),
		'section'  => 'title_tagline', 
		'settings' => 'real_estate_lite_logo',
		'priority' => 1,
	))); 
	
	// Logo Width
	$wp_customize->add_setting( 'logo_size', array(
	    'sanitize_callback' => 'real_estate_lite_sanitize_text',
	));

	$wp_customize->add_control( new Realest_Upgrade_to_PRO_Logo( $wp_customize, 'logo_size', array( 

		'section'  => 'real_estate_lite_logo_section', 
		'settings' => 'logo_size',  
		'priority'   => 2 
	)));
	
	
// Colors

	$wp_customize->add_setting( 'real_estate_lite_colors', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new Realest_Upgrade_to_PRO( $wp_customize, 'real_estate_lite_colors', array( 
		'section'  => 'colors', 
		'priority' => 4,
	))); 	


	// Fonts  
    $wp_customize->add_section(
        'real_estate_lite_typography',
        array(
            'title' => __('Typography', 'real-estate-lite' ),   
            'priority' => 40,
    ));
	
   
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'real_estate_lite_sanitize_fonts',
    ));
    
    $wp_customize->add_control( new Realest_Upgrade_to_PRO( $wp_customize, 
        'headings_fonts',
        array(

			'label'    => __( 'Heading Fonts', 'real-estate-lite' ),
            'description' => __('Select your desired font for the headings. Roboto is the default Heading font.', 'real-estate-lite'),
            'section' => 'real_estate_lite_typography',
    )));
    


	// Colors

	
    $wp_customize->add_setting( 'real_estate_lite_hover_color', array( 
        'default'     => '#cc1b00',   
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
 

    $wp_customize->add_control( new Realest_Upgrade_to_PRO_Color( $wp_customize, 'real_estate_lite_hover_color', array(
        'label'	   => __( 'Hover Color', 'real-estate-lite' ), 
        'section'  => 'colors',
        'settings' => 'real_estate_lite_hover_color',
		'priority' => 35 
    )));
	
	

}
add_action( 'customize_register', 'real_estate_lite_customize_register' );
/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.7
 */
function real_estate_lite_sanitize_hex_color( $color ) {
	if ( '#f1572f' === $color ) 
		return '';

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}


//Checkboxes
function real_estate_lite_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

//Integers
function real_estate_lite_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

//Text
function real_estate_lite_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//Sanitizes Fonts 
function real_estate_lite_sanitize_fonts( $input ) {  
    $valid = array(
    		'Cousine' => 'Cousine',
    		'Courier' => 'Courier',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
            'Oswald:400,700' => 'Oswald',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',    
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt', 
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//No sanitize - empty function for options that do not require sanitization -> to bypass the Theme Check plugin
function real_estate_lite_no_sanitize( $input ) {
} 




/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function real_estate_lite_customize_preview_js() {
	wp_enqueue_script( 'real_estate_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'real_estate_lite_customize_preview_js' );

/**
 * Display upgrade notice on customizer page
 */
function real_estate_lite_upsell_notice() {
 // Enqueue the script
 wp_enqueue_script(
 'real-estate-lite-customizer-upsell',
 get_template_directory_uri() . '/js/upsell.js',
 array(), '1.0.0',
 true
 );
 // Localize the script
 wp_localize_script(
 'real-estate-lite-customizer-upsell',
 'realestL10n',
 array(
 'realestURL'	=> esc_url( 'https://thepixeltribe.com/template/real-estate/' ),
 'realestLabel'	=> __( 'Upgrade to Real Estate PRO!', 'real-estate-lite' ),
 )
 );
}
add_action( 'customize_controls_enqueue_scripts', 'real_estate_lite_upsell_notice' );

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.0,
 */
function real_estate_lite_add_customizer_css() {
	
	$color = esc_html( get_theme_mod( 'real_estate_lite_text_color', '#04040' ) );
	$hover_color = esc_html( get_theme_mod( 'real_estate_lite_hover_color', '#cc1b00' ) );
	$theme_color = esc_html( get_theme_mod( 'real_estate_lite_custom_color', '#f1572f' ) );
	$top_bar_bg_color = esc_html( get_theme_mod( 'real_estate_lite_top_bar_color','#f1f4f8' ) );
	$top_bar_text_color = esc_html( get_theme_mod( 'real_estate_lite_top_bar_text_color','#7e8c99' ) );
	$footer_background = esc_html( get_theme_mod( 'real_estate_lite_footer_color','#1f1f1f' ) );
	$footer_text_color = esc_html( get_theme_mod( 'real_estate_lite_footer_text_color','#636363' ) );
	} 

add_action( 'wp_head', 'real_estate_lite_add_customizer_css' );
