<?php
/**
 * Settings page
 */
defined( 'ABSPATH' ) || exit;
?>
<style type="text/css">
    .bpbm-tab{
        display: none;
    }

    .bpbm-tab.active{
        display: block;
    }

    td.attachments-formats ul{
        display: inline-block;
        vertical-align: top;
        padding: 0 30px 0 0;
        margin-top: 5px;
    }

    td.attachments-formats ul > strong{
        display: block;
        margin-bottom: 5px;
    }

    .cols{
        overflow: hidden;
    }

    .cols .col{
        width: 49%;
        float: left;
    }

    @media only screen and (max-width: 1050px){
        .cols .col{
            width: 100%;
            float: none;
        }
    }

    .wordplus-host{
        padding: 11px 15px;
        font-size: 14px;
        text-align: left;
        margin: 25px 20px 0 2px;
        background-color: #fff;
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }

    .wordplus-host .go-order{
        display: block;
        margin: 0 auto;
        max-width: 300px;
        height: 35px;
        line-height: 35px;
        background-color: #1bdb68;
        font-size: 16px;
        font-weight: 600;
        color: #fff;
        text-align: center;
        vertical-align: middle;
        text-decoration: none;
        border: 2px solid transparent;
        padding: 0 25px;
        touch-action: manipulation;
        cursor: pointer;
        background-image: none;
        white-space: nowrap;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-transition: color 0.3s ease-out, background-color 0.3s ease-out;
        -o-transition: color 0.3s ease-out, background-color 0.3s ease-out;
        transition: color 0.3s ease-out, background-color 0.3s ease-out;
    }

    .wordplus-host .go-order:hover{
        background-color: #15ae52;
    }

    .bpbm-tab .form-table th{
        width: auto;
    }

    input[type=checkbox], input[type=radio]{
        margin: 0 5px 0 0;
    }
</style>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var hash = location.href.split('#')[1];
        if(typeof hash != 'undefined'){
            var selector = jQuery("#bpbm-tabs > a[href='#"+ hash+"']");
            jQuery('#bpbm-tabs > a').removeClass('nav-tab-active');
            jQuery('.bpbm-tab').removeClass('active');

            jQuery( selector ).addClass('nav-tab-active');
            jQuery( '#' + hash ).addClass('active');
        }


        $('input[name="mechanism"]').change(function () {
            var mechanism = $('input[name="mechanism"]:checked').val();

            $('.ajax, .websocket').hide();
            $('.' + mechanism).show();

            if(mechanism == 'websocket'){
                $('input[name="miniChatsEnable"]').attr('disabled', false);
                $('input[name="miniThreadsEnable"]').attr('disabled', false);
                $('input[name="messagesStatus"]').attr('disabled', false);
            } else {
                $('input[name="miniChatsEnable"]').attr('disabled', true);
                $('input[name="miniThreadsEnable"]').attr('disabled', true);
                $('input[name="messagesStatus"]').attr('disabled', true);
            }
        });

        $("#bpbm-tabs > a").on('click touchstart', function(event){
            event.preventDefault();
            event.stopPropagation();

            if( $(this).hasClass('nav-tab-active') ) return false;

            var selector = $(this).attr('href');
            window.history.pushState("", "", selector);

            $('#bpbm-tabs > a').removeClass('nav-tab-active');
            $('.bpbm-tab').removeClass('active');

            $(this).addClass('nav-tab-active');
            $(selector).addClass('active');
        });
    });
</script>
<div class="wrap">
    <h1><?php _e( 'BP Better Messages', 'bp-better-messages' ); ?></h1>
    <div class="nav-tab-wrapper" id="bpbm-tabs">
        <a class="nav-tab nav-tab-active" id="general-tab" href="#general"><?php _e( 'General', 'bp-better-messages' ); ?></a>
        <a class="nav-tab" id="chat-tab" href="#chat"><?php _e( 'Messages', 'bp-better-messages' ); ?></a>
        <a class="nav-tab" id="mobile-tab" href="#mobile"><?php _e( 'Mobile', 'bp-better-messages' ); ?></a>
        <a class="nav-tab" id="attachments-tab" href="#attachments"><?php _e( 'Attachments', 'bp-better-messages' ); ?></a>
        <a class="nav-tab" id="notifications-tab" href="#notifications"><?php _e( 'Notifications', 'bp-better-messages' ); ?></a>
        <a class="nav-tab" id="rules-tab" href="#rules"><?php _e( 'Rules', 'bp-better-messages' ); ?></a>
        <a class="nav-tab" id="calls-tab" href="#calls"><?php _e( 'Calls', 'bp-better-messages' ); ?></a>
    </div>
    <form action="" method="POST">
        <?php wp_nonce_field( 'bp-better-messages-settings' ); ?>
        <div id="general" class="bpbm-tab active">
            <div class="cols">
                <div class="col">
                    <table class="form-table">
                        <tbody>
                        <tr>
                            <th scope="row" style="width: 300px">
                                <?php _e( 'Refresh mechanism', 'bp-better-messages' ); ?>
                            </th>
                            <td>
                                <fieldset>
                                    <fieldset>
                                        <legend class="screen-reader-text">
                                            <span><?php _e( 'Refresh mechanism', 'bp-better-messages' ); ?></span></legend>
                                        <label><input type="radio" name="mechanism"
                                                      value="ajax" <?php checked( $this->settings[ 'mechanism' ], 'ajax' ); ?>> <?php _e( 'AJAX', 'bp-better-messages' ); ?>
                                        </label>
                                        <br>
                                        <label><input type="radio" name="mechanism" value="websocket" <?php checked( $this->settings[ 'mechanism' ], 'websocket' ); ?> <?php if(! bpbm_fs()->can_use_premium_code()) echo 'disabled'; ?>>
                                            <?php _e( 'WebSocket', 'bp-better-messages' ); ?>
                                            <?php if( ! bpbm_fs()->can_use_premium_code() ) { ?>
                                                <a style="font-size: 10px;" href="<?php echo admin_url('admin.php?page=bp-better-messages-pricing'); ?>">Get WebSocket License</a>
                                            <?php } ?>
                                        </label>
                                    </fieldset>
                                </fieldset>
                            </td>
                        </tr>

                        <tr class="ajax"
                            style="<?php if ( $this->settings[ 'mechanism' ] == 'websocket' ) echo 'display:none;'; ?>">
                            <th scope="row">
                                <?php _e( 'Thread Refresh Interval', 'bp-better-messages' ); ?>
                                <p style="font-size: 10px;"><?php _e( 'Ajax check interval on open thread', 'bp-user-reviews' ); ?></p>
                            </th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text">
                                        <span><?php _e( 'Thread Refresh Interval', 'bp-better-messages' ); ?></span></legend>
                                    <label><input type="number" name="thread_interval" value="<?php echo esc_attr( $this->settings[ 'thread_interval' ] ); ?>"></label>
                                </fieldset>
                            </td>
                        </tr>

                        <tr class="ajax"
                            style="<?php if ( $this->settings[ 'mechanism' ] == 'websocket' ) echo 'display:none;'; ?>">
                            <th scope="row">
                                <?php _e( 'Site Refresh Interval', 'bp-better-messages' ); ?>
                                <p style="font-size: 10px;"><?php _e( 'Ajax check interval on other sites pages', 'bp-user-reviews' ); ?></p>
                            </th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text">
                                        <span><?php _e( 'Thread Refresh Interval', 'bp-better-messages' ); ?></span></legend>
                                    <label><input type="number" name="site_interval" value="<?php echo esc_attr( $this->settings[ 'site_interval' ] ); ?>"></label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <?php _e( 'Number of Messages', 'bp-better-messages' ); ?>
                                <p style="font-size: 10px;"><?php _e( 'Number of Messages per request on user open thread or loading old messages through ajax', 'bp-user-reviews' ); ?></p>
                            </th>
                            <td>
                                <fieldset>
                                    <legend class="screen-reader-text">
                                        <span><?php _e( 'Thread Refresh Interval', 'bp-better-messages' ); ?></span></legend>
                                    <label><input type="number" name="messagesPerPage" value="<?php echo esc_attr( $this->settings[ 'messagesPerPage' ] ); ?>"></label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top" class="">
                            <th scope="row" valign="top">
                                <?php _e( 'Better Messages Location', 'bp-better-messages' ); ?>
                                <p style="font-size: 10px;"><?php _e( 'Choose the page where Better Messages will be located', 'bp-better-messages' ); ?></p>
                            </th>
                            <td>
                                <?php
                                global $sitepress;
                                if( defined('ICL_LANGUAGE_CODE') && !! $sitepress ){
                                    $backup_code = ICL_LANGUAGE_CODE;
                                    $default_code = $sitepress->get_default_language();
                                    $sitepress->switch_lang( $default_code );
                                    wp_dropdown_pages(array(
                                        'show_option_none' => __('Show in BuddyPress profile', 'bp-better-messages'),
                                        'name' => 'chatPage',
                                        'selected' => $this->settings[ 'chatPage' ],
                                        'option_none_value' => '0'
                                    ));
                                    $sitepress->switch_lang( $backup_code );

                                } else {
                                    wp_dropdown_pages(array(
                                        'show_option_none' => __('Show in BuddyPress profile', 'bp-better-messages'),
                                        'name' => 'chatPage',
                                        'selected' => $this->settings[ 'chatPage' ],
                                        'option_none_value' => '0'
                                    ));
                                }
                                ?>

                                <p><?php echo sprintf(__('You can use <code>%s</code> shortcode to place chat in specific place of your selected page, if you not used this shortcode all page content will be replaced.', 'bp-better-messages'), '[bp-better-messages]'); ?></p>
                            </td>
                        </tr>
                        <tr valign="top" class="">
                            <th scope="row" valign="top">
                                <?php _e( 'Combined View', 'bp-better-messages' ); ?>
                                <p style="font-size: 10px;"><?php _e( 'Always show threads list on left side of thread', 'bp-better-messages' ); ?></p>
                            </th>
                            <td>
                                <input name="combinedView" type="checkbox" <?php checked( $this->settings[ 'combinedView' ], '1' ); ?> value="1" />
                            </td>
                        </tr>
                        <tr valign="top" class="">
                            <th scope="row" valign="top">
                                <?php _e( 'Block Scroll on Hover', 'bp-better-messages' ); ?>
                                <p style="font-size: 10px;"><?php _e( 'When hovering messages container scroll of the site will be disabled to improve user experience while using messages', 'bp-better-messages' ); ?></p>
                            </th>
                            <td>
                                <input name="blockScroll" type="checkbox" <?php checked( $this->settings[ 'blockScroll' ], '1' ); ?> value="1" />
                            </td>
                        </tr>
                        <tr valign="top" class="">
                            <th scope="row" valign="top">
                                <?php _e( 'Show Private Message Link at Members List', 'bp-better-messages' ); ?>
                            </th>
                            <td>
                                <input name="userListButton" type="checkbox" <?php checked( $this->settings[ 'userListButton' ], '1' ); ?> value="1" />
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <div class="wordplus-host">
                        <a href="https://www.wordplus.host/"><img style="display: block;width: 170px;margin: 10px auto;" src="https://www.wordplus.host/templates/sixCustom/img/logo.png" alt="WordPlus.host"></a>
                        <p style="text-align: center;font-size: 18px;">Make your site <b>much faster</b> just switching host!</p>
                        <a href="https://www.wordplus.host/cart.php" target="_blank" class="go-order">Start Now</a>
                        <p style="text-align: center;font-size: 18px;">Use promocode <b>MESSAGES</b> to get 50% discount (for first month)</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="chat" class="bpbm-tab">
            <table class="form-table">
                <tbody>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Easy Start Thread', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'When clicking the Private Message button user will be immediately redirected to new thread instead of new message screen', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="fastStart" type="checkbox" <?php checked( $this->settings[ 'fastStart' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Only Friends Mode', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Allow only friends to send messages each other', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="friendsMode" type="checkbox" <?php disabled( ! function_exists('friends_check_friendship') ); ?>  <?php checked( $this->settings[ 'friendsMode' ] && function_exists('friends_check_friendship'), '1' ); ?> value="1" />
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Disable Group Threads', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Don`t allow to create threads with multiple recipients', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="disableGroupThreads" type="checkbox"  <?php checked( $this->settings[ 'disableGroupThreads' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Disable Multiple Threads', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'This will prevent users from starting few threads with same user', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="singleThreadMode" type="checkbox"  <?php checked( $this->settings[ 'singleThreadMode' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Auto Redirect to Existing Thread', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'This will redirect user to existing thread with another user if they already have thread and Disable Multiple Threads is enabled', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="redirectToExistingThread" type="checkbox"  <?php checked( $this->settings[ 'redirectToExistingThread' ], '1' ); ?> value="1" />
                    </td>
                </tr>


                <tr>
                    <th scope="row">
                        <?php _e( 'Mini Friends', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Enables mini friends list widget fixed to the bottom of browser window', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e( 'Mini Friends', 'bp-better-messages' ); ?></span></legend>
                            <label>
                                <input type="checkbox" name="miniFriendsEnable" <?php disabled( ! function_exists('friends_get_friend_user_ids') ); ?> <?php checked( $this->settings[ 'miniFriendsEnable' ] && function_exists('friends_get_friend_user_ids'), '1' ); ?> value="1">
                            </label>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e( 'Mini Threads', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Enables mini threads list widget fixed to the bottom of browser window', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e( 'Small Chats', 'bp-better-messages' ); ?></span></legend>
                            <label>
                                <input type="checkbox" name="miniThreadsEnable" <?php checked( $this->settings[ 'miniThreadsEnable' ], '1' ); ?> value="1" <?php if(! bpbm_fs()->can_use_premium_code() || $this->settings[ 'mechanism' ] == 'ajax') echo 'disabled'; ?>>
                                <?php if( ! bpbm_fs()->can_use_premium_code() ) { ?>
                                    <a style="font-size: 10px;" href="<?php echo admin_url('admin.php?page=bp-better-messages-pricing'); ?>">Get WebSocket License</a>
                                <?php } ?>
                            </label>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e( 'Mini Chats', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Enables mini chats fixed to the bottom of browser window', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e( 'Small Chats', 'bp-better-messages' ); ?></span></legend>
                            <label>
                                <input type="checkbox" name="miniChatsEnable" <?php checked( $this->settings[ 'miniChatsEnable' ], '1' ); ?> value="1" <?php if(! bpbm_fs()->can_use_premium_code() || $this->settings[ 'mechanism' ] == 'ajax') echo 'disabled'; ?>>
                                <?php if( ! bpbm_fs()->can_use_premium_code() ) { ?>
                                    <a style="font-size: 10px;" href="<?php echo admin_url('admin.php?page=bp-better-messages-pricing'); ?>">Get WebSocket License</a>
                                <?php } ?>
                            </label>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e( 'Messages Status', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Enable messages status functionality', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <fieldset>
                            <label>
                                <input type="checkbox" name="messagesStatus" <?php checked( $this->settings[ 'messagesStatus' ], '1' ); ?> value="1" <?php if(! bpbm_fs()->can_use_premium_code() || $this->settings[ 'mechanism' ] == 'ajax') echo 'disabled'; ?>>
                                <?php if(! bpbm_fs()->can_use_premium_code()) { ?>
                                    <a style="font-size: 10px;" href="<?php echo admin_url('admin.php?page=bp-better-messages-pricing'); ?>">Get WebSocket License</a>
                                <?php } ?>
                            </label>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Allow users to delete messages', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Allow users to delete their messages only', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="allowDeleteMessages" type="checkbox" <?php checked( $this->settings[ 'allowDeleteMessages' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Disable additional security check when deleting thread', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Check this if you have issue with thread deleting', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="disableDeleteThreadCheck" type="checkbox" <?php checked( $this->settings[ 'disableDeleteThreadCheck' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Search all users', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Enable search among all users when starting new thread', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="searchAllUsers" type="checkbox" <?php checked( $this->settings[ 'searchAllUsers' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Enable oEmbed for popular services', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'oEmbed YouTube, Vimeo, VideoPress, Flickr, DailyMotion, Kickstarter, Meetup.com, Mixcloud, SoundCloud and more', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="oEmbedEnable" type="checkbox" <?php checked( $this->settings[ 'oEmbedEnable' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Disable Subject', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Disable Subject when starting new thread', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="disableSubject" type="checkbox" <?php checked( $this->settings[ 'disableSubject' ], '1' ); ?> value="1" />
                    </td>
                </tr>

                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Disable Send on Enter for Desktop devices', 'bp-better-messages' ); ?>
                    </th>
                    <td>
                        <input name="disableEnterForDesktop" type="checkbox" <?php checked( $this->settings[ 'disableEnterForDesktop' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div id="mobile" class="bpbm-tab">
            <table class="form-table">
                <tbody>
                    <tr valign="top" class="">
                        <th scope="row" valign="top">
                            <?php _e( 'Enable Mobile Chat at Any Page', 'bp-better-messages' ); ?>

                            <p style="font-size: 10px;"><?php _e( 'Adds button fixed to the right corner on mobile devices, on click fully featured messaging will appear in full screen mode', 'bp-better-messages' ); ?></p>
                        </th>
                        <td>
                            <input name="mobilePopup" type="checkbox" <?php checked( $this->settings[ 'mobilePopup' ], '1' ); ?> value="1" />
                        </td>
                    </tr>

                    <tr valign="top" class="">
                        <th scope="row" valign="top">
                            <?php _e( 'Enable Full Screen on Tap for Touch Screens', 'bp-better-messages' ); ?>
                        </th>
                        <td>
                            <input name="mobileFullScreen" type="checkbox" <?php checked( $this->settings[ 'mobileFullScreen' ], '1' ); ?> value="1" />
                        </td>
                    </tr>

                    <tr valign="top" class="">
                        <th scope="row" valign="top">
                            <?php _e( 'Disable Send on Enter for Touch Screens', 'bp-better-messages' ); ?>
                        </th>
                        <td>
                            <input name="disableEnterForTouch" type="checkbox" <?php checked( $this->settings[ 'disableEnterForTouch' ], '1' ); ?> <?php if($this->settings[ 'mobileFullScreen' ] == '0') echo 'disabled'; ?> value="1" />
                        </td>
                    </tr>

                    <tr valign="top" class="">
                        <th scope="row" valign="top">
                            <?php _e( 'Disable Tap to Open for Touch Screens', 'bp-better-messages' ); ?>
                        </th>
                        <td>
                            <input name="disableTapToOpen" type="checkbox" <?php checked( $this->settings[ 'disableTapToOpen' ], '1' ); ?> <?php if($this->settings[ 'mobileFullScreen' ] == '0') echo 'disabled'; ?> value="1" />
                        </td>
                    </tr>


                    <tr valign="top" class="">
                        <th scope="row" valign="top">
                            <?php _e( 'Auto open full screen mode when opening messages page', 'bp-better-messages' ); ?>
                        </th>
                        <td>
                            <input name="autoFullScreen" type="checkbox" <?php checked( $this->settings[ 'autoFullScreen' ], '1' ); ?> <?php if($this->settings[ 'mobileFullScreen' ] == '0') echo 'disabled'; ?> value="1" />
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div id="attachments" class="bpbm-tab">
            <?php $formats = wp_get_ext_types(); unset($formats['code']); ?>
            <table class="form-table">
                <tbody>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Enable files', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Enable file sharing between users', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="attachmentsEnable" type="checkbox" <?php checked( $this->settings[ 'attachmentsEnable' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Hide Attachments', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Hides attachments from media gallery', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="attachmentsHide" type="checkbox" <?php checked( $this->settings[ 'attachmentsHide' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Random file names', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Changes file names to random to improve users privacy', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="attachmentsRandomName" type="checkbox" <?php checked( $this->settings[ 'attachmentsRandomName' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Delete attachment after', 'bp-better-messages' ); ?>
                    </th>
                    <td>
                        <input name="attachmentsRetention" type="number" value="<?php esc_attr_e( $this->settings[ 'attachmentsRetention' ] ); ?>"/> days
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Max attachment size', 'bp-better-messages' ); ?>
                    </th>
                    <td>
                        <input name="attachmentsMaxSize" type="number" value="<?php esc_attr_e( $this->settings[ 'attachmentsMaxSize' ] ); ?>"/> Mb
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e( 'Allowed formats', 'bp-better-messages' ); ?>
                    </th>
                    <td class="attachments-formats">
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span><?php _e( 'Allowed formats', 'bp-better-messages' ); ?></span>
                            </legend>
                            <?php foreach($formats as $type => $extensions){ ?>
                                <ul>
                                    <strong><?php echo ucfirst($type); ?></strong>
                                    <?php foreach($extensions as $ext){ ?>
                                        <li>
                                            <label>
                                                <input type="checkbox" name="attachmentsFormats[]" value="<?php echo $ext; ?>" <?php if(in_array($ext, $this->settings[ 'attachmentsFormats' ])) echo 'checked="checked"'; ?>>
                                                <?php echo $ext; ?>
                                            </label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </fieldset>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div id="notifications" class="bpbm-tab">
            <table class="form-table">
                <tbody>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Replace Standard BuddyPress Email Notifications', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'When enabled instead of standard notification on each new message, plugin will group messages by thread and send it every 15 minutess with cron job.', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="replaceStandardEmail" type="checkbox" <?php checked( $this->settings[ 'replaceStandardEmail' ], '1' ); ?> value="1" />
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div id="rules" class="bpbm-tab">
            <?php $roles = get_editable_roles(); ?>
            <table class="form-table">
                <tbody>
                <tr valign="top" class="">
                    <th scope="row" valign="top" style="width: 320px;">
                        <?php _e( 'Restrict the creation of a new thread', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Selected roles will not be allowed to start new threads', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <ul>
                            <?php foreach( $roles as $slug => $role ){ ?>
                                <li><input id="<?php echo $slug; ?>_1" type="checkbox" name="restrictNewThreads[]" value="<?php echo $slug; ?>" <?php if(in_array($slug, $this->settings[ 'restrictNewThreads' ])) echo 'checked="checked"'; ?>><label for="<?php echo $slug; ?>_1"><?php echo $role['name']; ?></label></li>
                            <?php } ?>
                        </ul>
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top" style="width: 320px;">
                        <?php _e( 'Restrict the creation of a new thread message', 'bp-better-messages' ); ?>
                    </th>
                    <td>
                        <input id="<?php echo $slug; ?>_2" type="text" style="width: 100%" name="restrictNewThreadsMessage" value="<?php esc_attr_e($this->settings['restrictNewThreadsMessage']); ?>">
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top" style="width: 320px;">
                        <?php _e( 'Restrict new replies', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Selected roles will not be allowed to reply', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <ul>
                            <?php foreach( $roles as $slug => $role ){ ?>
                                <li><input id="<?php echo $slug; ?>_3" type="checkbox" name="restrictNewReplies[]" value="<?php echo $slug; ?>" <?php if(in_array($slug, $this->settings[ 'restrictNewReplies' ])) echo 'checked="checked"'; ?>><label for="<?php echo $slug; ?>_3"><?php echo $role['name']; ?></label></li>
                            <?php } ?>
                        </ul>
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top" style="width: 320px;">
                        <?php _e( 'Restrict new replies message', 'bp-better-messages' ); ?>
                    </th>
                    <td>
                         <input id="<?php echo $slug; ?>_4" type="text" style="width: 100%" name="restrictNewRepliesMessage" value="<?php esc_attr_e($this->settings['restrictNewRepliesMessage']); ?>">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div id="calls" class="bpbm-tab">
            <table class="form-table">
                <tbody>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Enable Video Calls', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Allow users to make video calls between each other', 'bp-better-messages' ); ?></p>
                        <p style="font-size: 10px;"><?php _e( 'Video calls are possible only with websocket version, its using most secure and modern WebRTC technology to empower video chats.', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="videoCalls" type="checkbox" <?php checked( $this->settings[ 'videoCalls' ], '1' ); ?> value="1" <?php  if( ! bpbm_fs()->can_use_premium_code() ) echo 'disabled'; ?> />
                        <?php if( ! bpbm_fs()->can_use_premium_code() ) { ?>
                            <a style="font-size: 10px;" href="<?php echo admin_url('admin.php?page=bp-better-messages-pricing'); ?>">Get WebSocket License</a>
                        <?php } ?>
                    </td>
                </tr>
                <tr valign="top" class="">
                    <th scope="row" valign="top">
                        <?php _e( 'Enable Audio Calls', 'bp-better-messages' ); ?>
                        <p style="font-size: 10px;"><?php _e( 'Allow users to make audio calls between each other', 'bp-better-messages' ); ?></p>
                        <p style="font-size: 10px;"><?php _e( 'Audio calls are possible only with websocket version, its using most secure and modern WebRTC technology to empower audio calls.', 'bp-better-messages' ); ?></p>
                    </th>
                    <td>
                        <input name="audioCalls" type="checkbox" <?php checked( $this->settings[ 'audioCalls' ], '1' ); ?> value="1" <?php  if( ! bpbm_fs()->can_use_premium_code() ) echo 'disabled'; ?> />
                        <?php if( ! bpbm_fs()->can_use_premium_code() ) { ?>
                            <a style="font-size: 10px;" href="<?php echo admin_url('admin.php?page=bp-better-messages-pricing'); ?>">Get WebSocket License</a>
                        <?php } ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="submit">
            <input type="submit" name="save" id="submit" class="button button-primary"
                   value="<?php _e( 'Save Changes', 'bp-better-messages' ); ?>">
        </p>
    </form>
</div>