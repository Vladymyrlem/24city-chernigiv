<?php
namespace ACFFrontendForm\Module\Actions;

use ACFFrontendForm\Plugin;
use ACFFrontendForm\Module;
use ACFFrontendForm\Module\Classes\ActionBase;
use ACFFrontendForm\Module\Widgets;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

	
class SendEmail extends ActionBase{

	public $site_domain = '';

	public function get_name() {
		return 'email';
	}

	public function get_label() {
		return __( 'Email', 'acf-frontend-form-element' );
	}


	public function register_settings_section( $widget ) {

		$site_domain = acfef_get_site_domain();
		
		$repeater = new \Elementor\Repeater();

		$widget->start_controls_section(
			 'section_email',
			[
				'label' => $this->get_label(),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'more_actions' => $this->get_name(),
				],
			]
		);
		
		$widget->add_control(
			'email_shortcodes',
			[
				'label' => __( 'Email Shortcodes', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
			]
		);		
		$widget->start_popover();
			$widget->add_control(
				'custom_field_shortcode',
				[
					'label' => __( 'Custom Field', 'elementor-pro' ),
					'type' => Controls_Manager::RAW_HTML,
					'label_block' => true,
					'raw' => "<input class='elementor-form-field-shortcode' value='[acf name=\"field_name\"]' readonly />",
					'separator' => 'after',
				]
			);
		
			$widget->add_control(
				'post_title_shortcode',
				[
					'label' => __( 'Post Title', 'elementor-pro' ),
					'type' => Controls_Manager::RAW_HTML,
					'label_block' => true,
					'raw' => "<input class='elementor-form-field-shortcode' value='[acf name=\"post_title\"]' readonly />",
					'separator' => 'after',
				]
			);
			$widget->add_control(
				'post_content_shortcode',
				[
					'label' => __( 'Post Content', 'elementor-pro' ),
					'type' => Controls_Manager::RAW_HTML,
					'label_block' => true,
					'raw' => "<input class='elementor-form-field-shortcode' value='[acf name=\"post_content\"]' readonly />",
					'separator' => 'after',
				]
			);
			$widget->add_control(
				'post_excerpt_shortcode',
				[
					'label' => __( 'Post Excerpt', 'elementor-pro' ),
					'type' => Controls_Manager::RAW_HTML,
					'label_block' => true,
					'raw' => "<input class='elementor-form-field-shortcode' value='[acf name=\"post_excerpt\"]' readonly />",
					'separator' => 'after',
				]
			);
			$widget->add_control(
				'featured_image_shortcode',
				[
					'label' => __( 'Featured Image', 'elementor-pro' ),
					'type' => Controls_Manager::RAW_HTML,
					'label_block' => true,
					'raw' => "<input class='elementor-form-field-shortcode' value='[acf name=\"featured_image\"]' readonly />",
					'separator' => 'after',
				]
			);
			$widget->add_control(
				'post_url_shortcode',
				[
					'label' => __( 'Post URL', 'elementor-pro' ),
					'type' => Controls_Manager::RAW_HTML,
					'label_block' => true,
					'raw' => "<input class='elementor-form-field-shortcode' value='[acf name=\"post_url\"]' readonly />",
					'separator' => 'after',
				]
			);
			$widget->add_control(
				'username_shortcode',
				[
					'label' => __( 'Username', 'elementor-pro' ),
					'type' => Controls_Manager::RAW_HTML,
					'label_block' => true,
					'raw' => "<input class='elementor-form-field-shortcode' value='[acf name=\"username\"]' readonly />",
					'separator' => 'after',
				]
			);
			$widget->add_control(
				'user_email_shortcode',
				[
					'label' => __( 'User Email', 'elementor-pro' ),
					'type' => Controls_Manager::RAW_HTML,
					'label_block' => true,
					'raw' => "<input class='elementor-form-field-shortcode' value='[acf name=\"user_email\"]' readonly />",
					'separator' => 'after',
				]
			);
			$widget->add_control(
				'user_first_shortcode',
				[
					'label' => __( 'User First Name', 'elementor-pro' ),
					'type' => Controls_Manager::RAW_HTML,
					'label_block' => true,
					'raw' => "<input class='elementor-form-field-shortcode' value='[acf name=\"first_name\"]' readonly />",
					'separator' => 'after',
				]
			);
			$widget->add_control(
				'user_last_shortcode',
				[
					'label' => __( 'User Last Name', 'elementor-pro' ),
					'type' => Controls_Manager::RAW_HTML,
					'label_block' => true,
					'raw' => "<input class='elementor-form-field-shortcode' value='[acf name=\"last_name\"]' readonly />",
					'separator' => 'after',
				]
			);
		$widget->end_popover();
		
		$repeater->add_control(
			 'email_id',
			[
				'label' => __( 'Email Name', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Email Name', 'acf-frontend-form-element' ),
				'default' => __( 'Email Name', 'acf-frontend-form-element' ),
				'label_block' => true,
				'description' => __( 'Give this email an identifier', 'acf-frontend-form-element' ),
			]
		);
		
		$repeater->start_controls_tabs( 'tabs_to_emails' );

		$repeater->start_controls_tab(
			'tab_to_email',
			[
				'label' => __( 'To', 'elementor-pro' ),
			]
		);

		$repeater->add_control(
			 'email_to',
			[
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'show_label' => false,
				'default' => get_option( 'admin_email' ),
				'placeholder' => get_option( 'admin_email' ),
				'description' => __( 'Separate emails with commas. <br> To display the names and addresses, use the following format: Name&lt;address&gt;.', 'acf-frontend-form-element' ),
				'render_type' => 'none',
			]
		);
		
		$repeater->end_controls_tab();
		
		$repeater->start_controls_tab(
			'tab_to_cc_email',
			[
				'label' => __( 'Cc', 'elementor-pro' ),
			]
		);
		
		$repeater->add_control(
			 'email_to_cc',
			[
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,				
				'show_label' => false,
				'default' => '',
				'description' => __( 'Separate emails with commas. <br> To display the names and addresses, use the following format: Name&lt;address&gt;.', 'acf-frontend-form-element' ),
				'render_type' => 'none',
			]
		);
		
		$repeater->end_controls_tab();
		
		$repeater->start_controls_tab(
			'tab_to_bcc_email',
			[
				'label' => __( 'Bcc', 'elementor-pro' ),
			]
		);

		$repeater->add_control(
			 'email_to_bcc',
			[
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,				
				'show_label' => false,	
				'default' => '',
				'description' => __( 'Separate emails with commas. <br> To display the names and addresses, use the following format: Name&lt;address&gt;.', 'acf-frontend-form-element' ),
				'render_type' => 'none',
			]
		);
		
		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();
				
		$repeater->add_control(
			'tabs_email_to_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		
		$repeater->start_controls_tabs( 'tabs_from_emails' );

		$repeater->start_controls_tab(
			'tab_from_email',
			[
				'label' => __( 'From', 'elementor-pro' ),
			]
		);
		
		$repeater->add_control(
			 'email_from',
			[
				'label' => __( 'From Email', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,				
				'default' => 'email@' . $site_domain,
				'render_type' => 'none',
			]
		);

		$repeater->add_control(
			 'email_from_name',
			[
				'label' => __( 'From Name', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,			
				'default' => get_bloginfo( 'name' ),
				'render_type' => 'none',
			]
		);		
		
		$repeater->end_controls_tab();
		
		$repeater->start_controls_tab(
			'tab_reply_to_email',
			[
				'label' => __( 'Reply-To', 'elementor-pro' ),
			]
		);
		
		$repeater->add_control(
			 'email_reply_to',
			[
				'label' => __( 'Reply-To Email', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,				
				'render_type' => 'none',
			]
		);
		
		$repeater->add_control(
			 'email_reply_to_name',
			[
				'label' => __( 'Reply-To Name', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,				
				'render_type' => 'none',
			]
		);		
		
		$repeater->end_controls_tab();		

		$repeater->end_controls_tabs();
		
		$repeater->add_control(
			'tabs_email_from_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			 'email_subject',
			[
				'label' => __( 'Subject', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'New message from [acf name="_username"]', 'acf-frontend-form-element' ),
				'label_block' => true,
				'render_type' => 'none',
			]
		);

		$repeater->add_control(
			 'email_content',
			[
				'label' => __( 'Message', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => 'Hello, this is [acf name="_username"]...',
				'label_block' => true,
				'render_type' => 'none',
			]
		);


		$repeater->add_control(
			 'form_metadata',
			[
				'label' => __( 'Meta Data', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'label_block' => true,
				'separator' => 'before',
				'default' => [
					'date',
					'time',
					'page_url',
					'user_agent',
					'remote_ip',
					'credit',
				],
				'options' => [
					'date' => __( 'Date', 'acf-frontend-form-element' ),
					'time' => __( 'Time', 'acf-frontend-form-element' ),
					'user_agent' => __( 'User Agent', 'acf-frontend-form-element' ),
					'remote_ip' => __( 'Remote IP', 'acf-frontend-form-element' ),
					'credit' => __( 'Credit', 'acf-frontend-form-element' ),
				],
				'render_type' => 'none',
			]
		);

		$repeater->add_control(
			 'email_content_type',
			[
				'label' => __( 'Send As', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'html',
				'render_type' => 'none',
				'options' => [
					'html' => __( 'HTML', 'acf-frontend-form-element' ),
					'plain' => __( 'Plain', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$widget->add_control(
			'emails_to_send',
			[
				'label' => __( 'Emails', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ email_id }}}',
			]
		);

		$widget->end_controls_section();
	}
	
	public function run( $post_id, $settings, $step_index = false, $steps = false ){	

		if( $settings[ 'emails_to_send' ] ){
			foreach( $settings[ 'emails_to_send' ] as $email ){
				$send_email = true;
				
				if( $step_index !== false ){
					$steps = $settings[ 'form_steps' ];
					$step_emails = explode( ',', $steps[ $step_index ][ 'emails_to_send' ] );
					if( ! in_array( $email[ 'email_id' ], $step_emails ) ){
						$send_email = false;
					}
				}
				
				if( $send_email ){
					$send_html = 'plain' !== $email[ 'email_content_type' ];
					$line_break = $send_html ? '<br>' : "\n";

					$fields = [
						'email_to' => get_option( 'admin_email' ),
						'email_to_cc' => '',
						'email_to_bcc' => '',					
						'email_from' => get_bloginfo( 'admin_email' ),
						'email_from_name' => get_bloginfo( 'name' ),
						'email_reply_to' => 'noreplay@' . acfef_get_site_domain(),
						'email_reply_to_name' => '',
						/* translators: %s: Site title. */
						'email_subject' => sprintf( __( 'New message from "%s"', 'elementor-pro' ), get_bloginfo( 'name' ) ),
						'email_content' => 'An ACF Frontend form has been filled out on your site',

					];

					foreach ( $fields as $key => $default ) {
						$setting = trim( $email[ $key ] );
						$setting = $this->replace_setting_shortcodes( $setting, $post_id );
						if ( ! empty( $setting ) ) {
							$fields[ $key ] = $setting;
						}
					}

					$email_meta = $this->get_meta( $email[ 'form_metadata' ], $line_break );


					if ( ! empty( $email_meta ) ) {
						$fields[ 'email_content' ] .= $line_break . '---' . $line_break . $line_break . $email_meta;
					}

					$headers = sprintf( 'From: %s <%s>' . "\r\n", $fields[ 'email_from_name' ], $fields[ 'email_from' ] );
					$headers .= sprintf( 'Reply-To: %s <%s>' . "\r\n", $fields[ 'email_reply_to_name' ], $fields[ 'email_reply_to' ] );

					if ( $send_html ) {
						$headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
					}

					$cc_header = '';
					if ( ! empty( $fields[ 'email_to_cc' ] ) ) {
						$cc_header = 'Cc: ' . $fields['email_to_cc'] . "\r\n";
					}

					/**
					 * Email headers.
					 *
					 * Filters the additional headers sent when the form send an email.
					 *
					 * @since 1.0.0
					 *
					 * @param string|array $headers Additional headers.
					 */
					$headers = apply_filters( 'acfef/wp_mail_headers', $headers );

					/**
					 * Email content.
					 *
					 * Filters the content of the email sent by the form.
					 *
					 * @since 1.0.0
					 *
					 * @param string $email_content Email content.
					 */
					$fields[ 'email_content' ] = apply_filters( 'acfef/wp_mail_message', $fields[ 'email_content' ] );

					$email_sent = wp_mail( $fields[ 'email_to' ], $fields[ 'email_subject' ], $fields[ 'email_content' ], $headers . $cc_header );

					if ( ! empty( $fields[ 'email_to_bcc' ] ) ) {
						$bcc_emails = explode( ',', $fields[ 'email_to_bcc' ] );
						foreach ( $bcc_emails as $bcc_email ) {
							wp_mail( trim( $bcc_email ), $fields[ 'email_subject' ], $fields[ 'email_content' ], $headers );
						}
					}

					/**
					 * ACF Frontend form mail sent.
					 *
					 * Fires when an email was sent successfully.
					 *
					 * @since 1.0.0
					 *
					 * @param $settings   array of settings of this widget.
					 * @param $email      array of settings of this email.
					 * @param $fields     array of field keys and values from the form submission
					 */
					do_action( 'acfef/mail_sent', $settings, $email, $fields, $step_index );
				}
			}
		}

		return $post_id;
	}	
	
	public function replace_setting_shortcodes( $setting, $post_id ) {
		
		return preg_replace_callback( '/(\[acf[^]]*name="(\w+)"[^]]*\])/', function( $matches ) use( $post_id ) {
			$value = '';
			$field = get_field_object( $matches[2], $post_id );
			if ( $field ){
				if( $field[ 'type' ] == 'image' ){
					$img_url = '';
					if( $field[ 'return_format' ] == 'array' ){
						$img_url = $field[ 'value' ][ 'url' ];
					}
					if( $field[ 'return_format' ] == 'url' ){
						$img_url = $field[ 'value' ];
					}
					if( $field[ 'return_format' ] == 'id' ){
						$img_url = wp_get_attachment_url( $field[ 'value' ] );
					}

					$value = '<img src="' . $img_url . '"/>';
				}else{
					if( is_array( $field[ 'value' ] ) ){
						$value = implode( ', ', $field[ 'value' ] );
					}else{
						$value = $field[ 'value' ];
					}
				}
			}else{		
				$edit_post = get_post( $post_id );
				if( $edit_post ){
					if( $matches[2] == 'post_title' ){
						$value = $edit_post->post_title;
					}
					if( $matches[2] == 'post_content' ){
						$value = $edit_post->post_content;
					}
					if( $matches[2] == 'post_excerpt' ){
						$value = $edit_post->post_excerpt;
					}
					if( $matches[2] == 'featured_image' ){
						$post_thumbnail_id = get_post_thumbnail_id( $post_id );
						$value = '<img src="' . wp_get_attachment_url( $post_thumbnail_id ) . '"/>';
					}
					if( $matches[2] == 'post_url' ){
						$value = get_permalink( $post_id );
					}
				}
				$edit_user = wp_get_current_user();
				if( strpos( $post_id, 'user' ) !== false ){
					$user_id = explode( '_', $post_id )[1];
					$edit_user = get_user_by( 'ID', $user_id );
				}
				if( $edit_user ){
					if( $matches[2] == 'username' ){
						$value = $edit_user->user_login;
					}
					if( $matches[2] == 'user_email' ){
						$value = $edit_user->user_email;
					}
				}
			}
			return $value;

		}, $setting );
		

	}
	
	private function get_meta( $form_metadata, $line_break ){
		if ( empty( $form_metadata ) ) {
			return;
		}
		
		$email_meta = '';
		$meta = [];
		foreach ( $form_metadata as $type ) {
			switch ( $type ) {
				case "date":
					$meta = [
						'title' => __( 'Date', 'elementor-pro' ),
						'value' => date_i18n( get_option( 'date_format' ) ),
					];
					break;
				case "time":
					$meta = [
						'title' => __( 'Time', 'elementor-pro' ),
						'value' => date_i18n( get_option( 'time_format' ) ),
					];
					break;

				case "user_agent":
					$meta = [
						'title' => __( 'User Agent', 'elementor-pro' ),
						'value' => $_SERVER[ 'HTTP_USER_AGENT' ],
					];
					break;

				case "remote_ip":
					$meta = [
						'title' => __( 'Remote IP', 'elementor-pro' ),
						'value' => acfef_get_client_ip(),
					];
					break;
				case "credit":
					$meta = [
						'title' => __( 'Powered by', 'elementor-pro' ),
						'value' => __( 'ACF Frontend', 'elementor-pro' ),
					];
					break;
			}			
			$email_meta .= $this->field_formatted( $meta ) . $line_break;
		}

		return $email_meta;
	}
	
	private function field_formatted( $field ) {
		$formatted = '';
		if ( ! empty( $field['title'] ) ) {
			$formatted = sprintf( '%s: %s', $field['title'], $field['value'] );
		} elseif ( ! empty( $field['value'] ) ) {
			$formatted = sprintf( '%s', $field['value'] );
		}

		return $formatted;
	}

}
