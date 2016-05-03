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

    if ( !is_null($include_categories) || $include_categories ) {
        $terms_args['include']  = $include_categories;
    }

    $terms = get_terms( 'faq_category', $terms_args );

    ?>

   @if($enable_search == 'on')
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
    @endif

    @foreach($terms as $term)
        <?php
            $shortcode = array();

            $shortcode[]  = sprintf('[et_pb_section fullwidth="off" specialty="off" admin_label="Section" custom_padding="0|0|0|0"][et_pb_row admin_label="Row"][et_pb_column type="4_4" custom_padding="0|0|0|0"][et_pb_text admin_label="Text" background_layout="light" text_orientation="left" use_border_color="off" border_color="#ffffff" border_style="solid"]%s[/et_pb_text]', $term->name);

            $args = array(
                    'post_type' => $custom_post_type,
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

                $shortcode[] = sprintf('[et_pb_toggle admin_label="Toggle" title="%s" open="off" use_border_color="off" border_color="#ffffff" border_style="solid"]%s[/et_pb_toggle]', get_the_title(), get_the_content());
            }

            $shortcode[] = '[/et_pb_column][/et_pb_row][/et_pb_section]';

        ?>
        {{ do_shortcode(implode('', $shortcode)) }}

@endforeach