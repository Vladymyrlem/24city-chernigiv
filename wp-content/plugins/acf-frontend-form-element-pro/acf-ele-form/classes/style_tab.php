<?php
namespace ACFFrontendForm\Module\Classes;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class StyleTab{

	public function style_tab_settings( $widget ){
			
		$widget->start_controls_section(
			'style_title_section',
			[
				'label' => __( 'Form Title', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'form_title!' => '',
				],
			]
		);
				
		$widget->add_responsive_control(
			'form_title_align',
			[
				'label' => __( 'Horizontal Align', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'flex-start' => __( 'Start', 'elementor' ),
					'center' => __( 'Center', 'elementor' ),
					'flex-end' => __( 'End', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .acfef-form-title' => 'justify-content: {{VALUE}}',
				],
			]
		);
		
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_title_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acfef-form-title',
			]
		);
		
		$widget->add_control(
			'form_title_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acfef-form-title' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'form_title_text_shadow',
				'selector' => '{{WRAPPER}} .acfef-form-title',
			]
		);

			
		$widget->end_controls_section();	
		
		
		//Labels Styles

		$widget->start_controls_section(
			'style_labels_section',
			[
				'label' => __( 'Labels', 'elementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$widget->add_control(
			'label_spacing',
			[
				'label' => __( 'Spacing', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'body.rtl {{WRAPPER}} .acf-form-fields.-left .acf-field label' => 'padding-left: {{SIZE}}{{UNIT}};',
					// for the label position = inline option
					'body:not(.rtl) {{WRAPPER}} .acf-form-fields.-left .acf-field label' => 'padding-right: {{SIZE}}{{UNIT}};',
					// for the label position = inline option
					'body {{WRAPPER}} .acf-form-fields.-top .acf-field label' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					// for the label position = above option
				],
			]
		);

		$widget->add_control(
			'label_text_color',
			[
				'label' => __( 'Text Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-field label, {{WRAPPER}} .acf-field label' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'mark_required_color',
			[
				'label' => __( 'Mark Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acf-required' => 'color: {{COLOR}};',
				],
				'condition' => [
					'show_mark_required' => 'yes',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .acf-field label',
			]
		);

		$widget->end_controls_section();	

		
		// Instruction Styles

		$widget->start_controls_section(
			'style_instructions_section',
			[
				'label' => __( 'Instructions', 'elementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$widget->add_control(
			'instruction_spacing',
			[
				'label' => __( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					// for the label position = inline option
					'body {{WRAPPER}} .acf-form-fields.-top p.description' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					// for the label position = above option
				],
			]
		);

		$widget->add_control(
			'instruction_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} p.description' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'instruction_typography',
				'selector' => '{{WRAPPER}} p.description',
			]
		);

		$widget->end_controls_section();
		
		//Fields Styles
		
		$widget->start_controls_section(
			'style_fields_section',
			[
				'label' => __( 'Fields', 'elementor-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$widget->add_control(
			'field_text_color',
			[
				'label' => __( 'Text Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-field input' => 'color: {{VALUE}};',
					'{{WRAPPER}} .acf-field textarea' => 'color: {{VALUE}};',
					'{{WRAPPER}} .acf-field select' => 'color: {{VALUE}};',
					'{{WRAPPER}} .acf-field span.select2-selection__rendered' => 'color: {{VALUE}};',
				],
			]
		);
		$widget->add_control(
			'field_placeholder_text_color',
			[
				'label' => __( 'Placeholder Text Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-field input::placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .acf-field textarea::placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .acf-field select::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'field_typography',
				'selector' => '{{WRAPPER}} .acf-field input, {{WRAPPER}} .acf-field textarea, {{WRAPPER}} .acf-field select, {{WRAPPER}} .select2-selection__rendered, {{WRAPPER}} .input-subgroup label',
			]
		);

		$widget->add_control(
			'field_background_color',
			[
				'label' => __( 'Background Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .acf-field:not(.acf-field-image) input:not([type=button]):not(.acf-input):not(.select2-search__field)' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .acf-field textarea' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .acf-field .acf-input select' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .acf-field .acf-input .select2-selection' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		
		$widget->add_responsive_control(
			'field_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acf-field:not(.acf-field-image) input:not([type=button]):not(.acf-input):not(.select2-search__field)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acf-field textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acf-field .acf-input select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acf-field .acf-input select *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acf-field .acf-input .select2-selection' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$widget->add_control(
			'field_border_color',
			[
				'label' => __( 'Border Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-field:not(.acf-field-image) input:not(.acf-input):not(.select2-search__field)' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .acf-field .acf-input select' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .acf-field .acf-input .select2-selection' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .acf-field .acf-input::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .acf-field textarea' => 'border-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$widget->add_control(
			'field_border_width',
			[
				'label' => __( 'Border Width', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'placeholder' => '1',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .acf-field:not(.acf-field-image) input:not(.acf-input):not(.select2-search__field)' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acf-field .acf-input select' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acf-field .acf-input .select2-selection' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',		
					'{{WRAPPER}} .acf-field .acf-input textarea' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->add_control(
			'field_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .acf-field:not(.acf-field-image) input:not(.acf-input):not(.select2-search__field)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acf-field .acf-input select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acf-field .acf-input .select2-selection' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',				
					'{{WRAPPER}} .acf-field textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$widget->end_controls_section();

		
		
		//Submit Button Styles
		
		
		
		$widget->start_controls_section(
			'style_submit_button_section',
			[
				'label' => __( 'Submit, Next and Previous Buttons', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$widget->add_control(
			'style_submit_button_spacing',
			[
				'label' => __( 'Spacing', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acfef-step-buttons' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
				
		$widget->add_responsive_control(
			'submit_button_align',
			[
				'label' => __( 'Horizontal Align', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'flex-start' => __( 'Start', 'elementor' ),
					'center' => __( 'Center', 'elementor' ),
					'flex-end' => __( 'End', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .acfef-step-buttons' => 'justify-content: {{VALUE}}',
				],
			]
		);			
		
		$widget->add_responsive_control(
			'multi_buttons_align',
			[
				'label' => __( 'Next/Previous Align', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'elementor' ),
					'space-between' => __( 'Start and End', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .acfef-multi-buttons-align' => 'justify-content: {{VALUE}}',
				],
				'condition' => [
					'multi' => 'true',
				],
			]
		);		
	

		
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'submit_button_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acfef-submit-button',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'submit_button_text_shadow',
				'selector' => '{{WRAPPER}} .acfef-submit-button',
			]
		);
				
		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'submit_button_box_shadow',
				'selector' => '{{WRAPPER}} .acfef-submit-button',
			]
		);
				
		$widget->add_responsive_control(
			'submit_button_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acfef-submit-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$widget->add_control(
			'submit_button_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acfef-submit-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$widget->add_control(
			'submit_button_text_style_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		

		$widget->start_controls_tabs( 'tabs_submit_button_style' );

		$widget->start_controls_tab(
			'tab_submit_button_normal',
			[
				'label' => __( 'Normal', 'elementor-pro' ),
			]
		);

		$widget->add_control(
			'submit_button_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acfef-submit-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'submit_button_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfef-submit-button' => 'background-color: {{VALUE}};',
				],
			]
		);

			
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'submit_button_border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .acfef-submit-button',
			]
		);

		
		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'tab_submit_button_hover',
			[
				'label' => __( 'Hover', 'elementor-pro' ),
			]
		);

		$widget->add_control(
			'submit_button_hover_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acfef-submit-button:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'submit_button_hover_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfef-submit-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$widget->add_control(
			'submit_button_hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfef-submit-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'submit_button_border_border!' => '',
				],
			]
		);

		
		$widget->end_controls_tab();

		$widget->end_controls_tabs();
			
		$widget->end_controls_section();
		
		
		$widget->start_controls_section(
			'style_draft_button_section',
			[
				'label' => __( 'Draft Button', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'save_progress_button' => 'true',
				]
			]
		);
		
		$widget->add_control(
			'style_draft_button_spacing',
			[
				'label' => __( 'Spacing', 'elementor-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acfef-draft-buttons' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
				
		$widget->add_responsive_control(
			'draft_button_align',
			[
				'label' => __( 'Horizontal Align', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'flex-start',
				'options' => [
					'flex-start' => __( 'Start', 'elementor' ),
					'center' => __( 'Center', 'elementor' ),
					'flex-end' => __( 'End', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .acfef-draft-buttons' => 'justify-content: {{VALUE}}',
				],
			]
		);			
	

		
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'draft_button_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acfef-draft-button',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'draft_button_text_shadow',
				'selector' => '{{WRAPPER}} .acfef-draft-button',
			]
		);
				
		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'draft_button_box_shadow',
				'selector' => '{{WRAPPER}} .acfef-draft-button',
			]
		);
				
		$widget->add_responsive_control(
			'draft_button_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acfef-draft-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$widget->add_control(
			'draft_button_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acfef-draft-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$widget->add_control(
			'draft_button_text_style_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		

		$widget->start_controls_tabs( 'tabs_draft_button_style' );

		$widget->start_controls_tab(
			'tab_draft_button_normal',
			[
				'label' => __( 'Normal', 'elementor-pro' ),
			]
		);

		$widget->add_control(
			'draft_button_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acfef-draft-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'draft_button_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfef-draft-button' => 'background-color: {{VALUE}};',
				],
			]
		);

			
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'draft_button_border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .acfef-draft-button',
			]
		);

		
		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'tab_draft_button_hover',
			[
				'label' => __( 'Hover', 'elementor-pro' ),
			]
		);

		$widget->add_control(
			'draft_button_hover_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acfef-draft-button:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'draft_button_hover_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfef-draft-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$widget->add_control(
			'draft_button_hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfef-draft-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'draft_button_border_border!' => '',
				],
			]
		);

		
		$widget->end_controls_tab();

		$widget->end_controls_tabs();
			
		$widget->end_controls_section();
		
		
		//Add Row Button Styles
		
		$widget->start_controls_section(
			'style_add_row_button_section',
			[
				'label' => __( 'Add New Button', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
				
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'add_row_button_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-actions a',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'add_row_button_text_shadow',
				'selector' => '{{WRAPPER}} .acf-actions a',
			]
		);
		
				
		$widget->add_responsive_control(
			'add_row_button_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acf-actions a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$widget->add_control(
			'add_row_button_text_style_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);


		$widget->add_control(
			'add_row_button_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acf-actions a' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'add_row_button_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-actions a' => 'background-color: {{VALUE}};',
				],
			]
		);

			
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'add_row_button_border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-actions a',
			]
		);
			
		$widget->add_control(
			'add_row_button_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acf-actions a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'add_row_button_box_shadow',
				'selector' => '{{WRAPPER}} .acf-actions a',
			]
		);
			
		$widget->end_controls_section();
		
		//ACF icons
		
		$widget->start_controls_section(
			'style_acf_icons_button_section',
			[
				'label' => __( 'Action Icons', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$widget->add_control(
			'remove_row_icon_style',
			[
				'label' => __( 'Remove Row', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);	
		
		$widget->add_responsive_control(
			'remove_row_icon_horizontal_pos',
			[
				'label' => __( 'Horizontal Position', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'default' => 10,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'max' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-minus' => 'right: {{VALUE}}%',
					'body.rtl {{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-minus' => 'left: {{VALUE}}%',
				],
			]
		);				
		$widget->add_responsive_control(
			'remove_row_icon_vertical_pos',
			[
				'label' => __( 'Vertical Position', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'default' => 50,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'max' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'body {{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-minus' => 'top: {{VALUE}}%',
				],
			]
		);				
				
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'remove_row_icon_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-minus',
			]
		);
		
				
		$widget->add_responsive_control(
			'remove_row_icon_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-minus' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$widget->add_control(
			'remove_row_icon_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-minus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
					
		
		$widget->add_control(
			'remove_row_icon_text_style_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$widget->start_controls_tabs( 'tabs_remove_row_icon_style' );

		$widget->start_controls_tab(
			'tab_remove_row_icon_normal',
			[
				'label' => __( 'Normal', 'elementor-pro' ),
			]
		);

		$widget->add_control(
			'remove_row_icon_text_color',
			[
				'label' => __( 'Icon Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-minus' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'remove_row_icon_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-minus' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'tab_remove_row_icon_hover',
			[
				'label' => __( 'Hover', 'elementor-pro' ),
			]
		);

		$widget->add_control(
			'remove_row_icon_hover_text_color',
			[
				'label' => __( 'Icon Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-minus:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'remove_row_icon_hover_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-minus:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		
		$widget->end_controls_tab();

		$widget->end_controls_tabs();
		
		$widget->add_control(
			'add_row_icon_style',
			[
				'label' => __( 'Add Row', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);	
		
		$widget->add_responsive_control(
			'add_row_icon_horizontal_pos',
			[
				'label' => __( 'Horizontal Position', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'default' => 10,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'max' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-plus' => 'right: {{VALUE}}%',
					'body.rtl {{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-plus' => 'left: {{VALUE}}%',
				],
			]
		);				
		$widget->add_responsive_control(
			'add_row_icon_vertical_pos',
			[
				'label' => __( 'Vertical Position', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'default' => 5,				
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'max' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'body {{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-plus' => 'top: {{VALUE}}%',
				],
			]
		);				
				
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'add_row_icon_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-plus',
			]
		);
		
				
		$widget->add_responsive_control(
			'add_row_icon_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-plus' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$widget->add_control(
			'add_row_icon_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-plus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
					
		
		$widget->add_control(
			'add_row_icon_text_style_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$widget->start_controls_tabs( 'tabs_add_row_icon_style' );

		$widget->start_controls_tab(
			'tab_add_row_icon_normal',
			[
				'label' => __( 'Normal', 'elementor-pro' ),
			]
		);

		$widget->add_control(
			'add_row_icon_text_color',
			[
				'label' => __( 'Icon Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-plus' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'add_row_icon_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-plus' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'tab_add_row_icon_hover',
			[
				'label' => __( 'Hover', 'elementor-pro' ),
			]
		);

		$widget->add_control(
			'add_row_icon_hover_text_color',
			[
				'label' => __( 'Icon Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-plus:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'add_row_icon_hover_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-repeater .acf-row-handle .acf-icon.-plus:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		
		$widget->end_controls_tab();

		$widget->end_controls_tabs();
			

		$widget->end_controls_section();
		
		//Add Image Button Styles
		
		$widget->start_controls_section(
			'style_add_image_button_section',
			[
				'label' => __( 'Add Image Button', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
				
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'add_image_button_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-field-image a.acf-button',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'add_image_button_text_shadow',
				'selector' => '{{WRAPPER}} .acf-field-image a.acf-button',
			]
		);
		
				
		$widget->add_responsive_control(
			'add_image_button_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acf-field-image a.acf-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$widget->add_control(
			'add_image_button_text_style_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);


		$widget->add_control(
			'add_image_button_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acf-field-image a.acf-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'add_image_button_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-field-image a.acf-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		
		$widget->add_control(
			'add_image_button_tabs_end',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		

			
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'add_image_button_border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-field-image a.acf-button',
			]
		);
			
		$widget->add_control(
			'add_image_button_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acf-field-image a.acf-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'add_image_button_box_shadow',
				'selector' => '{{WRAPPER}} .acf-field-image a.acf-button',
			]
		);
			
		$widget->end_controls_section();
		
		//Modal Button
		
		$widget->start_controls_section(
			'style_modal_button_section',
			[
				'label' => __( 'Modal Button', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_in_modal' => 'true',
				],
			]
		);
				
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'modal_button_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acfef-edit-button',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'modal_button_text_shadow',
				'selector' => '{{WRAPPER}} .acfef-edit-button',
			]
		);
		
				
		$widget->add_responsive_control(
			'modal_button_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acfef-edit-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$widget->add_control(
			'modal_button_text_style_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$widget->add_control(
			'modal_button_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acfef-edit-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'modal_button_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfef-edit-button' => 'background-color: {{VALUE}};',
				],
			]
		);


	
		$widget->add_control(
			'modal_button_tabs_end',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		

			
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'modal_button_border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .acfef-edit-button',
			]
		);
			
		$widget->add_control(
			'modal_button_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acfef-edit-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'modal_button_box_shadow',
				'selector' => '{{WRAPPER}} .acfef-edit-button',
			]
		);
		
		$widget->end_controls_section();	
		
		
		$widget->start_controls_section(
			'style_steps_section',
			[
				'label' => __( 'Steps', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'multi' => 'true',
				],
			]
		);	
		
		$widget->add_control(
			'step_tabs_style',
			[
				'label' => __( 'Step Tabs', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);		
		
		$widget->add_responsive_control(
			'step_tabs_width',
			[
				'label' => __( 'Width', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'max' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'{{WRAPPER}} .form-tabs' => 'width: {{VALUE}}%',	
				],
			]
		);	
		$widget->add_responsive_control(
			'step_tabs_align',
			[
				'label' => __( 'Align', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .form-tabs' => 'margin-{{VALUE}}: 0',
				],
				'condition' => [
					'tabs_align' => 'horizontal',
				],
			]
		);	
		
		$widget->add_responsive_control(
			'step_tabs_spacing',
			[
				'label' => __( 'Spacing', 'elementor' ) . ' (px)',
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'max' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-tabs-view-horizontal .form-tabs' => 'margin-bottom: {{VALUE}}px',
					'body.rtl {{WRAPPER}}.elementor-tabs-view-vertical .form-tabs' => 'margin-left: {{VALUE}}px',
					'body:not(.rtl) {{WRAPPER}}.elementor-tabs-view-vertical .form-tabs' => 'margin-right: {{VALUE}}px',		
				]
			]
		);		
		$widget->add_responsive_control(
			'step_tabs_space_between',
			[
				'label' => __( 'Space Between', 'elementor' ) . ' (px)',
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'max' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}}:not(.elementor-tabs-view-vertical) .form-tab:not(:first-of-type)' => 'margin-left: {{VALUE}}px',
					'body.rtl {{WRAPPER}}:not(.elementor-tabs-view-vertical) .form-tab:not(:first-of-type)' => 'margin-right: {{VALUE}}px',
					'body {{WRAPPER}}.elementor-tabs-view-vertical .form-tab:not(:first-of-type)' => 'margin-top: {{VALUE}}px',				],
			]
		);		
		$widget->add_responsive_control(
			'step_name_text_align',
			[
				'label' => __( 'Text Align', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .form-tab' => 'text-align: {{VALUE}}',
				],
			]
		);		
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'step_tabs_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .form-tab',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'step_tabs_text_shadow',
				'selector' => '{{WRAPPER}} .form-tab',
			]
		);
		
				
		$widget->add_responsive_control(
			'step_tabs_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-tab p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'step_tabs_border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .form-tab',
			]
		);
			
		$widget->add_control(
			'step_tabs_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .form-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		
		
		$widget->start_controls_tabs( 'tabs_style_settings' );

		$widget->start_controls_tab(
			'tab_style_normal',
			[
				'label' => __( 'Normal', 'elementor-pro' ),
			]
		);		
		
		
		$widget->add_control(
			'step_tabs_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .form-tab:not(.active)' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'step_tabs_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-tab:not(.active)' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$widget->end_controls_tab();
		
		$widget->start_controls_tab(
			'tab_style_active',
			[
				'label' => __( 'Active', 'elementor-pro' ),
			]
		);	
		
		$widget->add_control(
			'step_tabs_text_color_active',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .form-tab.active' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'step_tabs_background_color_active',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-tab.active' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$widget->add_control(
			'step_tabs_border_color_active',
			[
				'label' => __( 'Border Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-tab.active' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'step_tabs_border_border!' => '',
				],
			]
		);		
		
		
		$widget->end_controls_tab();
		
		$widget->end_controls_tabs();
		
		
		$widget->add_control(
			'step_counter_style',
			[
				'label' => __( 'Step Counter', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);		
		
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'step_counter_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .step-count',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'step_counter_text_shadow',
				'selector' => '{{WRAPPER}} .step-count',
			]
		);
		
				
		$widget->add_responsive_control(
			'step_counter_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .step-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'step_counter_border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .step-count',
			]
		);
			
		$widget->add_control(
			'step_counter_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .step-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$widget->add_control(
			'step_counter_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .step-count' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'step_counter_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .step-count' => 'background-color: {{VALUE}};',
				],
			]
		);		
		
		$widget->end_controls_section();	

		
		$widget->start_controls_section(
			'style_modal_section',
			[
				'label' => __( 'Modal Window', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_in_modal' => 'true',
				],
			]
		);		
		
		$widget->add_responsive_control(
			'modal_window_size',
			[
				'label' => __( 'Modal Width', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::NUMBER,
				'min' => 20,
				'max' => 100,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'max' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'{{WRAPPER}} .edit-modal .modal-content' => 'width: {{VALUE}}%',
				],
			]
		);
		
		$widget->add_responsive_control(
			'modal_content_size',
			[
				'label' => __( 'Modal Content', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::NUMBER,
				'min' => 20,
				'max' => 100,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'max' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'{{WRAPPER}} .edit-modal .modal-content .modal-inner' => 'width: {{VALUE}}%',
				],
			]
		);
		
		$widget->add_responsive_control(
			'modal_inner_align',
			[
				'label' => __( 'Horizontal Align', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'flex-start' => __( 'Start', 'elementor' ),
					'center' => __( 'Center', 'elementor' ),
					'flex-end' => __( 'End', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .edit-modal .modal-content' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$widget->end_controls_section();	
		
		$this->delete_button_styles( $widget, true );
		
		$widget->start_controls_section(
			'style_messages_section',
			[
				'label' => __( 'Messages', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$widget->add_control(
			'style_messages',
			[
				'label' => __( 'Preview Messages', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
			]
		);
		
		$widget->start_controls_tabs(
			'style_messages_tabs'
		);

		$widget->start_controls_tab(
			'message_success_tab',
			[
				'label' => __( 'Success', 'plugin-name' ),
			]
		);
		
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'success_message_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-notice.-success *',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'success_message_text_shadow',
				'selector' => '{{WRAPPER}} .acf-notice.-success',
			]
		);
		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'success_message_box_shadow',
				'selector' => '{{WRAPPER}} .acf-notice.-success',
			]
		);		
				
		$widget->add_responsive_control(
			'success_message_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-success' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);		
	

		$widget->add_control(
			'success_message_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-success' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'success_message_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-success' => 'background-color: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'success_message_border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-notice.-success',
			]
		);
			
		$widget->add_control(
			'success_message_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-success' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		

		
		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'message_error_tab',
			[
				'label' => __( 'Error', 'plugin-name' ),
			]
		);
		
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'error_message_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-notice.-error *',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'error_message_text_shadow',
				'selector' => '{{WRAPPER}} .acf-notice.-error',
			]
		);
		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'error_message_box_shadow',
				'selector' => '{{WRAPPER}} .acf-notice.-error',
			]
		);
		
				
		$widget->add_responsive_control(
			'error_message_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-error' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);	

		$widget->add_control(
			'error_message_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-error' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'error_message_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-error' => 'background-color: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'error_message_border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-notice.-error',
			]
		);
			
		$widget->add_control(
			'error_message_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-error' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		

		
		
		$widget->end_controls_tab();
		
		$widget->start_controls_tab(
			'message_limit_tab',
			[
				'label' => __( 'Limit', 'plugin-name' ),
			]
		);
		
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'limit_message_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-notice.-limit *',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'limit_message_text_shadow',
				'selector' => '{{WRAPPER}} .acf-notice.-limit',
			]
		);
		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'limit_message_box_shadow',
				'selector' => '{{WRAPPER}} .acf-notice.-limit',
			]
		);
		
				
		$widget->add_responsive_control(
			'limit_message_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-limit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);		

		$widget->add_control(
			'limit_message_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-limit' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'limit_message_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-limit' => 'background-color: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'limit_message_border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .acf-notice.-limit',
			]
		);
			
		$widget->add_control(
			'limit_message_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acf-notice.-limit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		
		$widget->end_controls_tab();

		$widget->end_controls_tabs();
		
		$widget->end_controls_section();

	}
	
	public function delete_button_styles( $widget, $form_widget = false ){
		$condition = [];
		if( $form_widget ){
			$condition = [
				'show_delete_button' => 'true',
			];
		}
		
		$widget->start_controls_section(
			'style_delete_button_section',
			[
				'label' => __( 'Delete Button', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => $condition,
			]
		);
				
		$widget->add_responsive_control(
			'delete_button_align',
			[
				'label' => __( 'Horizontal Align', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'flex-start' => __( 'Start', 'elementor' ),
					'center' => __( 'Center', 'elementor' ),
					'flex-end' => __( 'End', 'elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .acfef-delete-button-container' => 'justify-content: {{VALUE}}',
				],
			]
		);			
		
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'delete_button_typography',
				'label' => __( 'Typography', 'elementor' ),
				'selector' => '{{WRAPPER}} .acfef-delete-button',
			]
		);
		
		$widget->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'delete_button_text_shadow',
				'selector' => '{{WRAPPER}} .acfef-delete-button',
			]
		);
		
				
		$widget->add_responsive_control(
			'delete_button_text_padding',
			[
				'label' => __( 'Padding', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acfef-delete-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		
		$widget->add_control(
			'delete_button_text_style_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);


		$widget->start_controls_tabs( 'tabs_delete_button_style' );

		$widget->start_controls_tab(
			'tab_delete_button_normal',
			[
				'label' => __( 'Normal', 'elementor-pro' ),
			]
		);
		
		$widget->add_control(
			'delete_button_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acfef-delete-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'delete_button_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfef-delete-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'delete_button_border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .acfef-delete-button',
			]
		);

		
		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'tab_delete_button_hover',
			[
				'label' => __( 'Hover', 'elementor-pro' ),
			]
		);

		$widget->add_control(
			'delete_button_hover_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .acfef-delete-button a:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$widget->add_control(
			'delete_button_hover_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfef-delete-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$widget->add_control(
			'delete_button_hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acfef-delete-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'delete_button_border_border!' => '',
				],
			]
		);

		
		$widget->end_controls_tab();

		$widget->end_controls_tabs();

	
		$widget->add_control(
			'delete_button_tabs_end',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
			
		$widget->add_control(
			'delete_button_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 'o',
					'bottom' => 'o',
					'left' => 'o',
					'right' => 'o',
					'isLinked' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acfef-delete-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'delete_button_box_shadow',
				'selector' => '{{WRAPPER}} .acfef-delete-button',
			]
		);
			
		$widget->end_controls_section();

	}

	public function __construct() {
		add_action( 'acfef/style_tab_settings', [ $this, 'style_tab_settings' ] );
		add_action( 'acfef/delete_button_styles', [ $this, 'delete_button_styles' ] );
	}

}

new StyleTab();
