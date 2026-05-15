<?php
/*
Plugin Name: Learning Notification Bar
Plugin URI: https://example.com
Description: Thanh thông báo cho học viên trên trang khóa học.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Render Notification Bar
 */
function lnb_render_notification_bar() {

    if (is_user_logged_in()) {

        $current_user = wp_get_current_user();
        $username = $current_user->display_name;

        $message = "👋 Chào <strong>$username</strong>, bạn đã sẵn sàng bắt đầu bài học hôm nay chưa?";

    } else {

        $login_url = wp_login_url();

        $message = '
        🔒 Đăng nhập để lưu tiến độ học tập!
        <a href="'.$login_url.'" 
           style="
                color:#fff;
                margin-left:10px;
                text-decoration:underline;
                font-weight:600;
           ">
           Đăng nhập
        </a>';
    }

    return '
    <div class="lnb-notification-bar">
        '.$message.'
    </div>';
}

/**
 * Shortcode
 */
add_shortcode(
    'learning_notification_bar',
    'lnb_render_notification_bar'
);

/**
 * CSS
 */
function lnb_styles() {
    ?>
    <style>
        .lnb-notification-bar{
            width:100%;
            background:linear-gradient(90deg,#7c3aed,#2563eb);
            color:#fff;
            text-align:center;
            padding:14px 20px;
            font-size:15px;
            font-weight:500;
            position:relative;
            z-index:9999;
        }

        .lnb-notification-bar a{
            color:#fff;
        }
    </style>
    <?php
}

add_action('wp_head', 'lnb_styles');