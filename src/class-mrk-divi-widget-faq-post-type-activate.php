<?php

class MRK_Divi_Widget_Faq_Post_Type_Activate{

    public static function activate(){
        custom_post_type_faq();
        flush_rewrite_rules();
    }

}
