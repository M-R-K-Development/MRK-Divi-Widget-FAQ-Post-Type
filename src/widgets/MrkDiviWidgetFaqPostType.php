<?php
/**
 *
 * FAQ Post Widget
 *
 */
class MrkDiviWidgetFaqPostType extends ET_Builder_Module
{
    public $name = 'FAQ Post Type';
    public $slug = 'mrk_divi_widget_faq_post_type';
    public $fields;


    public function __construct(){
        $this->setup();
        parent::__construct();
    }


    public function setup(){
        $this->_init_fields();
    }

    private function _init_fields()
    {
        $this->fields = array();
        $this->fields['display_title'] = array(
                        'label'             => 'Display Title',
                        'type'              => 'yes_no_button',
                        'options' => array(
                            'off' => __( "No", 'et_builder' ),
                            'on'  => __( 'Yes', 'et_builder' ),
                        ),
                        'description'       => 'Would you like to display a title on the FAQ Block?',
                        'affects'           => array(
                                    '#et_pb_title_text'
                                ),
                )
        ;

        $this->fields['title_text'] = array(
                'label'           => __('Widget title', 'et_builder'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => __('Title to display before the grid.', 'et_builder'),
                'depends_show_if' => 'on',
            );

        $this->fields['enable_search'] = array(
                        'label'             => 'Enable Search',
                        'type'              => 'yes_no_button',
                        'options' => array(
                            'off' => __( "No", 'et_builder' ),
                            'on'  => __( 'Yes', 'et_builder' ),
                        ),
                        'description'       => 'Show search form.',
                )
        ;

        $this->fields['enable_groups'] = array(
                        'label'             => 'Group by Category',
                        'type'              => 'yes_no_button',
                        'options' => array(
                            'off' => __( "No", 'et_builder' ),
                            'on'  => __( 'Yes', 'et_builder' ),
                        ),
                        'description'       => 'If you would like your FAQs grouped by category.',
                )
        ;

        $this->fields['filter_by_category_on'] = array(
                        'label'             => 'Only show specific Categories',
                        'type'              => 'yes_no_button',
                        'options' => array(
                            'off' => __( "No", 'et_builder' ),
                            'on'  => __( 'Yes', 'et_builder' ),
                        ),
                        'description'       => 'Select to filter outpt by specific categories.',
                        'affects'           => array(
                                    '#et_pb_include_categories'
                                ),
                )
        ;

        $this->fields['display_cat_title'] =array(
                        'label'             => 'Display Category Title',
                        'type'              => 'yes_no_button',
                        'options' => array(
                            'off' => __( "No", 'et_builder' ),
                            'on'  => __( 'Yes', 'et_builder' ),
                        ),
                        'description'       => 'Select to output h3 titles around category listings.',
                )
        ;

        $this->fields['include_categories'] = array(
                    'label'           => esc_html__( 'Include from only these categories', 'et_builder' ),
                    'renderer'        => 'et_builder_include_faq_categories_option',
                    'render_options'  => array('term_name' => 'faq_category'),
                    'option_category' => 'basic_option',
                    'description'     => esc_html__( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
                    'depends_show_if' => 'on',
      );

        $this->fields['admin_label'] = array(
                    'label'       => __('Admin Label', 'et_builder'),
                    'type'        => 'text',
                    'description' => __('This will change the label of the module in the builder for easy identification.', 'et_builder'),
                )
            ;
    }


          public function init()
      {
          $this->whitelisted_fields = array_keys($this->fields);

        /*
         * Prefix the slug with et_pb
         */
        if (strpos($this->slug, 'et_pb_') !== 0) {
            $this->slug = 'et_pb_'.$this->slug;
        }

        $defaults = array();

        foreach ($this->fields as $field => $options) {
          if (isset($options['default'])) {
              $defaults[$field] = $options['default'];
          }
        }

        $this->field_defaults = $defaults;
      }


    /**
     * Get Fields
     *
     * @return [type] [description]
     */
    public function get_fields(){
      return $this->fields;
    }

     public function shortcode_callback( $atts, $content = null, $function_name ) {
        extract($atts);
        ob_start();
        require MRK_FAQ_DIVI_WIDGET_DIR . '/src/templates/mrk_divi_widget_faq_post_type.php';
        return ob_get_clean();
    }

}

new MrkDiviWidgetFaqPostType();
