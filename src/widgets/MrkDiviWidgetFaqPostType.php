<?php
/**
 *
 * Staff Widget
 *
 */
class MrkDiviWidgetFaqPostType extends DiviCustomWidget
{

    public function __construct($dir)
    {
        $this->config = array(
            'name' => 'FAQ Post Type',
            'slug' => 'mrk_divi_widget_faq_post_type',
        );

        $this->addField(
            array(
                'title_text' => array(
                'label'           => __('Widget title', 'et_builder'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => __('Title to display before the grid.', 'et_builder'),
                ),
            )
        );

        $this->addField(
                array(
                    'enable_search' => array(
                        'label'             => 'Enable Search',
                        'type'              => 'yes_no_button',
                        'description'       => 'Show search form.',
                        ),
                )
        );

        $this->addField(array(
                 'include_categories' => array(
                    'label'           => esc_html__( 'Include from only these categories', 'et_builder' ),
                    'renderer'        => 'et_builder_include_custom_categories_option',
                    'render_options'  => array('term_name' => 'faq_category'),
                    'option_category' => 'basic_option',
                    'description'     => esc_html__( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
                ),
      ));

        $this->addField(
                array(
                    'admin_label' => array(
                    'label'       => __('Admin Label', 'et_builder'),
                    'type'        => 'text',
                    'description' => __('This will change the label of the module in the builder for easy identification.', 'et_builder'),
                    ),
                )
            );

        parent::__construct($dir);
    }
}

new MrkDiviWidgetFaqPostType($dir);
