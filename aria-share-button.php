<?php
/*
Plugin Name: Aria Share Button
Plugin URI: https://coindej.com
description: View Share Button in posts
Version: 2.0
Author: CoinDej - AriaHaman Group
Author URI: https://coindej.com
License: GPL2
*/
function asb_social_sharing_buttons($content) {
    global $post;
    if(is_singular() || is_home()){

        // Get current page URL
        $asbURL = urlencode(get_permalink());

        // Get current page title
        $asbTitle = str_replace( ' ', '%20', get_the_title());

        // Get Post Thumbnail for pinterest
        $asbThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

        // Construct sharing URL without using any script
        $twitterURL = 'https://twitter.com/intent/tweet?text='.$asbTitle.'&amp;url='.$asbURL.'&amp;via=asb';
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$asbURL;
        $googleURL = 'https://plus.google.com/share?url='.$asbURL;
        $bufferURL = 'https://bufferapp.com/add?url='.$asbURL.'&amp;text='.$asbTitle;
        $whatsappURL = 'whatsapp://send?text='.$asbTitle . ' ' . $asbURL;
        $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$asbURL.'&amp;title='.$asbTitle;

        // Based on popular demand added Pinterest too
        $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$asbURL.'&amp;media='.$asbThumbnail[0].'&amp;description='.$asbTitle;

        // Add sharing button at the end of page/page content
        $content .= '<!-- asb.com social sharing. Get your copy here: http://asb.me/1VIxAsz -->';
        $content .= '<div class="asb-social">';
        $content .= '<h5>SHARE ON</h5> <a class="asb-link asb-twitter" href="'. $twitterURL .'" target="_blank">Twitter</a>';
        $content .= '<a class="asb-link asb-facebook" href="'.$facebookURL.'" target="_blank">Facebook</a>';
        $content .= '<a class="asb-link asb-whatsapp" href="'.$whatsappURL.'" target="_blank">WhatsApp</a>';
        $content .= '<a class="asb-link asb-googleplus" href="'.$googleURL.'" target="_blank">Google+</a>';
        $content .= '<a class="asb-link asb-buffer" href="'.$bufferURL.'" target="_blank">Buffer</a>';
        $content .= '<a class="asb-link asb-linkedin" href="'.$linkedInURL.'" target="_blank">LinkedIn</a>';
        $content .= '<a class="asb-link asb-pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank">Pin It</a>';
        $content .= '</div>';

        return $content;
    }else{
        // if not a post/page then don't include sharing button
        return $content;
    }
};


add_filter( 'the_content', 'asb_social_sharing_buttons');






function asb_add_theme_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );

    wp_enqueue_style( 'slider', plugin_dir_url( __FILE__ ) . 'assets/style.css', array(), '1.1', 'all');

    // wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array ( 'jquery' ), 1.1, true);

//    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
//        wp_enqueue_script( 'comment-reply' );
//    }
//
// tnx Rasool Abdolahi
}
add_action( 'wp_enqueue_scripts', 'asb_add_theme_scripts' );