<?php 
use Carbon_Fields\Block;
use Carbon_Fields\Field;

$demoBlock = Block::make(__('Demo Block'))
        ->add_fields(array(
            Field::make( 'text', 'heading', __( 'Block Heading' ) ),
        ))
        ->set_description(__('A demo block'))
        ->set_keywords([__('block')])
        ->set_category($this->blockCategorySlug)
        ->set_icon( 'book-alt' )
        ->set_mode( 'both' ) //Allow preview and editor
        ->set_editor_style('carbon-fields-blocks-stylesheet')
        ->set_style('carbon-fields-blocks-stylesheet')
        ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
            //Pass the attributes to the template part
            get_template_part('template-parts/blocks/demo','', ['fields' => $fields,'attributes' => $attributes,'inner_blocks' => $inner_blocks]); 
        });

$demoBlock->settings['mode'] = 'preview';
