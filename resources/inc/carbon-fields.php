<?php
//Code for setting up Carbon Fields
use Carbon_Fields\Container;
use Carbon_Fields\Block;
use Carbon_Fields\Field;


class ThemeCarbonFields {

    //Global Variables for Easy Naming
    private $blockCategory;
    private $blockCategoryIcon;
    private $blockCategorySlug;

    function __construct()
    {
        //Global Variables for Easy Naming
        $this->blockCategory = 'My Custom Blocks';
        $this->blockCategorySlug = 'my-custom-blocks';
        $this->blockCategoryIcon = 'smiley';

        add_filter('block_categories_all',[$this,'create_block_categories'],10,2); //Create our block category
        add_action( 'carbon_fields_register_fields', [$this,'crb_attach_theme_options'] ); //Set up theme options
        add_action( 'after_setup_theme', [$this,'crb_load'] ); //Load carbon fields
        add_action( 'carbon_fields_register_fields', [$this,'add_custom_blocks'] ); //Add custom blocks
        add_action( 'after_setup_theme', [$this,'crb_initialize_carbon_yoast'] ); //Yoast Setup
        add_action( 'admin_enqueue_scripts', [$this,'crb_enqueue_admin_scripts'] ); //Yoast Setup
        add_filter( 'allowed_block_types', array($this,'cf_allowed_block_types') ); // Disable most default blocks

    }

    //Function to disable most default blocks
     function cf_allowed_block_types( $allowed_blocks ) {
    return array(
        'core/image',
        'core/paragraph',
        'core/heading',
        'core/list',
        'carbon-fields/demo-block'
    );
    }

    // Function to set up our block category
        function create_block_categories ($categories,$post) {
         return array_merge(
            $categories,
            array(
                array(
                    'slug' => $this->blockCategorySlug,
                    'title' => $this->blockCategory,
                    'icon'  => $this->blockCategoryIcon,
                ),
            )
        );

    }



    //Set Up Theme Options 
    public function crb_attach_theme_options() {
        Container::make( 'theme_options', __( 'Theme Options','tailwind-blocks' ) )
            ->set_page_file( 'theme-options' ) //Set admin URL
            ->set_icon('dashicons-admin-generic')
            ->set_page_menu_title('Site Options')
            ->add_fields( array(
                Field::make( 'text', 'tel', 'Phone Number' )
                    ->set_attribute( 'placeholder', '***** ******' ),
                Field::make( 'text', 'email', 'Email Address' )
                    ->set_attribute( 'placeholder', 'hello@yoursite.com' ),
                Field::make( 'urlpicker', 'facebook', 'Facebook' ),
                Field::make( 'urlpicker', 'twitter', 'Twitter' ),
                Field::make( 'urlpicker', 'linkedin', 'LinkedIn' ),
                Field::make( 'image', 'fallback_header', __( 'Fallback Header Image' ) )
                      ->set_help_text( "The image used when no featured image is set on a page/post" )
            ) );
    }

    public function crb_load() {
        require( get_template_directory() .  '/vendor/autoload.php' );
        \Carbon_Fields\Carbon_Fields::boot();
    }

    //Add the Custom Blocks
    public function add_custom_blocks() {
        // Enqueue Stylesheets and Fonts for Blocks
        wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css', array(), '1.0' );
        wp_register_style('carbon-fields-blocks-stylesheet', get_template_directory_uri().'/css/app.css'); //Enqueue style

    //START BLOCK
    include_once(__DIR__ . '/blocks/demo.php');

        
    }

    // Set Up Yoast with Carbon Fields
    public function crb_initialize_carbon_yoast() {
        include_once get_template_directory(). '/vendor/autoload.php';
        new \Carbon_Fields_Yoast\Carbon_Fields_Yoast;
    }

    public function crb_enqueue_admin_scripts() {
        wp_enqueue_script( 'crb-admin', get_stylesheet_directory_uri() . '/resources/js/admin.js', array( 'carbon-fields-yoast' ) );
    }
}

$themeCarbonFields = new ThemeCarbonFields;