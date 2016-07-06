<?php
    /**
     * Type of custom post to collect
     * @var string
     */
    $custom_post_type = 'faq';
    $i                = 0;

    $terms_args = array(
        'orderby' => 'name',
        'order'   => 'ASC',
    );

    if(isset($include_categories)){
        if ( !is_null($include_categories) || $include_categories ) {
            $terms_args['include']  = $include_categories;
        }
    }

    $terms = get_terms( 'faq_category', $terms_args );

    $shortcode = array();

    if($display_title =='on'){
        if(isset($title_text)){
           $shortcode[]  = sprintf('[et_pb_section fullwidth="off" specialty="off" admin_label="Section" custom_padding="0|0|0|0"][et_pb_row admin_label="Row"][et_pb_column type="4_4" custom_padding="0|0|0|0"][et_pb_text admin_label="Text" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"]<h2>%s</h2>[/et_pb_text]', $title_text);
        }
    }

    ?>



   <?php if($enable_search == 'on') :?>
    <div class="et_pb_search et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_search_0">
        <form role="search" method="get" class="et_pb_searchform" action="/" _lpchecked="1">
            <div>
                <label class="screen-reader-text" for="s">Search for:</label>
                <input type="hidden" name="post_type" value="{{ $custom_post_type }}" />
                <input type="text" value="" name="s" class="et_pb_s" style="padding-right: 74px;">
                <input type="submit" value="Search" class="et_pb_searchsubmit">
            </div>
        </form>
    </div>
    <?php endif; ?>

    <?php if($enable_groups == 'on') :?>

    <?php foreach($terms as $term) :?>
            <?php

                $shortcode[] = '[et_pb_section fullwidth="off" specialty="off" admin_label="Section" custom_padding="0|0|0|0"][et_pb_row admin_label="Row"][et_pb_column type="4_4" custom_padding="0|0|0|0"]';

                if ($display_cat_title == 'on'){

                    $shortcode[]  = sprintf('[et_pb_text admin_label="Text" background_layout="light" text_orientation="center" use_border_color="off" border_color="#ffffff" border_style="solid"]<h3>%s</h3>[/et_pb_text]', $term->name);
                }

                $args = array(
                        'post_type' => $custom_post_type,
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'faq_category',
                            'field'    => 'slug',
                            'terms'    => $term->slug,
                             ),
                          ),
                );

                $query = new WP_Query( $args );

                while ($query->have_posts()) {
                    $query->the_post();

                    $shortcode[] = sprintf('[et_pb_toggle admin_label="Toggle" title="%s" open="off" use_border_color="off" border_color="#ffffff" border_style="solid"]%s[/et_pb_toggle]',get_the_title() ,get_the_content());
                }

                $shortcode[] = '[/et_pb_column][/et_pb_row][/et_pb_section]';

            ?>
        <?php endforeach;?>

        <?php else : ?>

        <?php
        $shortcode[] = '[et_pb_section fullwidth="off" specialty="off" admin_label="Section" custom_padding="0|0|0|0"][et_pb_row admin_label="Row"][et_pb_column type="4_4" custom_padding="0|0|0|0"]';

            $args = array(
                'post_type' => $custom_post_type,
                'posts_per_page' => -1);

                $query = new WP_Query( $args );

                while ($query->have_posts()) {
                    $query->the_post();

                    $shortcode[] = sprintf('[et_pb_toggle admin_label="Toggle" title="%s" open="off" use_border_color="off" border_color="#ffffff" border_style="solid"]%s[/et_pb_toggle]',get_the_title() ,get_the_content());
                }

                $shortcode[] = '[/et_pb_column][/et_pb_row][/et_pb_section]';
        ?>

    <?php endif; ?>

    <?php echo do_shortcode(implode('', $shortcode)); ?>
