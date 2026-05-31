<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class ADECO_Footer_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'adeco_footer';
    }

    public function get_title()
    {
        return __('ADECO – Footer', 'adeco');
    }

    public function get_icon()
    {
        return 'eicon-footer';
    }

    public function get_categories()
    {
        return ['adeco_widgets'];
    }

    protected function register_controls()
    {

        /* ------------------------------
            FOOTER BACKGROUND
        ------------------------------ */
        $this->start_controls_section(
            'footer_bg_section',
            [
                'label' => __('Background', 'adeco'),
            ]
        );

        $this->add_control(
            'footer_bg',
            [
                'label' => __('Background Image', 'adeco'),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();

        /* ------------------------------
            CONSULTATION AREA
        ------------------------------ */

        $this->start_controls_section(
            'consultation_section',
            [
                'label' => __('Consultation Box', 'adeco')
            ]
        );
        
        $this->add_control(
            'full_footer',
            [
                'label'        => __('Display Full Footer', 'adeco'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Full', 'adeco'),
                'label_off'    => __('Mini', 'adeco'),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->add_control(
            'consult_title',
            [
                'label' => __('Title', 'adeco'),
                'type'  => Controls_Manager::TEXTAREA,
                'default' => 'Your Vision Our Environmental <span>Expertise</span>'
            ]
        );

        $this->add_control(
            'consult_text',
            [
                'label' => __('Description', 'adeco'),
                'type'  => Controls_Manager::TEXTAREA,
                'default' => 'Our success in achieving this goal results in maintaining our leadership in environmental consulting, solar energy, laboratories, information technology, and value creation'
            ]
        );

        $this->add_control(
            'consult_btn_text',
            [
                'label' => __('Button Text', 'adeco'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Get Free Consultation'
            ]
        );

        $this->add_control(
            'consult_btn_link',
            [
                'label' => __('Button Link', 'adeco'),
                'type'  => Controls_Manager::URL,
                'default' => ['url' => '#']
            ]
        );

        $this->end_controls_section();


        /* ------------------------------
            LOGO + SUBSCRIBE AREA
        ------------------------------ */

        $this->start_controls_section(
            'footer_top_section',
            [
                'label' => __('Footer Top', 'adeco')
            ]
        );

        $this->add_control(
            'footer_logo',
            [
                'label' => __('Footer Logo', 'adeco'),
                'type'  => Controls_Manager::MEDIA
            ]
        );

        $this->add_control(
            'subscribe_text',
            [
                'label' => __('Subscribe Text', 'adeco'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Subscribe to our newsletter !'
            ]
        );

        $this->add_control(
            'subscribe_placeholder',
            [
                'label' => __('Input Placeholder', 'adeco'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Enter your email'
            ]
        );

        $this->add_control(
            'subscribe_btn',
            [
                'label' => __('Button Text', 'adeco'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Subscribe'
            ]
        );

        $this->end_controls_section();


        /* ------------------------------
            MENUS (REPEATER)
        ------------------------------ */
        $this->start_controls_section(
            'footer_menus_section',
            [
                'label' => __('Footer Menus', 'adeco')
            ]
        );

        $menu_repeater = new Repeater();

        $menu_repeater->add_control(
            'menu_title',
            [
                'label' => __('Menu Title', 'adeco'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Menu'
            ]
        );

        $menu_repeater->add_control(
            'menu_classes',
            [
                'label' => __('Menu Custom Classes', 'adeco'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'li-ft'
            ]
        );

        $menu_repeater->add_control(
            'menu_items',
            [
                'label'   => __('Menu Items (HTML allowed)', 'adeco'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' =>
                "<li><a href='#'>Link 1</a></li>
<li><a href='#'>Link 2</a></li>",
                'description' => 'Add <li> elements exactly as you want them to appear'
            ]
        );

        $this->add_control(
            'footer_menus',
            [
                'label'       => __('Menu Groups', 'adeco'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $menu_repeater->get_controls(),
                'title_field' => '{{{ menu_title }}}',
            ]
        );

        $this->add_control(
            'follow_us_heading_text',
            [
                'label' => __('Follow Us Menu Title Match', 'adeco'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'Follow Us On',
                'description' => __('Image will appear before this menu title.', 'adeco'),
            ]
        );

        $this->add_control(
            'follow_us_before_title_logo',
            [
                'label' => __('Follow Us Logo (Before Title)', 'adeco'),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'follow_us_logo_spacing',
            [
                'label' => __('Logo Bottom Spacing', 'adeco'),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
            ]
        );

        $this->end_controls_section();


        /* ------------------------------
            BOTTOM FOOTER
        ------------------------------ */

        $this->start_controls_section(
            'footer_bottom_section',
            [
                'label' => __('Footer Bottom', 'adeco')
            ]
        );

        $this->add_control(
            'bottom_text',
            [
                'label' => __('Copyright', 'adeco'),
                'type'  => Controls_Manager::TEXT,
                'default' => '©2025 Adeco IT. All Rights Reserved'
            ]
        );

        $this->add_control(
            'bottom_links',
            [
                'label' => __('Bottom Links (HTML)', 'adeco'),
                'type'  => Controls_Manager::TEXTAREA,
                'default' =>
                "<li><a href='#'>Privacy Policy</a></li>
<li><a href='#'>Terms Of Use</a></li>"
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $s = $this->get_settings_for_display();
?>

        <footer id="footer" <?php if (!empty($s['footer_bg']['url'])): ?>style="background:url('<?php echo esc_url($s['footer_bg']['url']); ?>')"<?php endif; ?>>

            <div class="container">

                <?php if ($s["full_footer"] == "yes"): ?>
                    <h1>zxzxzxzxzxzzxzxzx</h1>
                    <!-- Consultation Section -->
                    <div class="txt-consultation txt-consultation-foter wow fadeInUp">
                        <h2><?php echo $s['consult_title']; ?></h2>
                        <p><?php echo esc_html($s['consult_text']); ?></p>
                        <a href="<?php echo esc_url($s['consult_btn_link']['url']); ?>" class="btn-site">
                            <span><?php echo esc_html($s['consult_btn_text']); ?></span>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="top-footer">
                    <div class="row">

                        <!-- Logo -->
                        <div class="col-lg-5">
                            <div class="cont-ft wow fadeInUp">
                                <figure class="logo-ft">
                                    <img src="<?php echo esc_url($s['footer_logo']['url']); ?>" alt="Footer Logo">
                                </figure>
                            </div>
                        </div>

                        <!-- Subscribe & Menus -->
                        <div class="col-lg-7">

                            <!-- <div class="subscribe-wrapper">
                                <p><?php echo esc_html($s['subscribe_text']); ?></p>

                                <form class="form-subscribe wow fadeInUp">
                                    <input type="text" class="form-control" placeholder="<?php echo esc_attr($s['subscribe_placeholder']); ?>">
                                    <button class="btn-site"><span><?php echo esc_html($s['subscribe_btn']); ?></span></button>
                                </form>
                            </div> -->

                            <div class="menu-ft-wrapper">

                                <?php foreach ($s['footer_menus'] as $menu) : ?>
                                    <?php
                                    $follow_title_match = !empty($s['follow_us_heading_text']) ? trim($s['follow_us_heading_text']) : 'Follow Us On';
                                    $is_follow_us_menu = !empty($menu['menu_title']) && trim($menu['menu_title']) === $follow_title_match;
                                    $follow_logo_spacing = isset($s['follow_us_logo_spacing']['size']) ? (int) $s['follow_us_logo_spacing']['size'] : 12;
                                    ?>
                                    <div class="menu-ft wow fadeInUp">
                                        <?php if ($is_follow_us_menu && !empty($s['follow_us_before_title_logo']['url'])) : ?>
                                            <figure class="follow-us-before-title-logo" style="margin:0 0 <?php echo esc_attr($follow_logo_spacing); ?>px 0;">
                                                <img src="<?php echo esc_url($s['follow_us_before_title_logo']['url']); ?>" alt="<?php esc_attr_e('Follow us logo', 'adeco'); ?>">
                                            </figure>
                                        <?php endif; ?>
                                        <h5><?php echo esc_html($menu['menu_title']); ?></h5>
                                        <ul class="<?php echo esc_attr($menu['menu_classes']); ?>">
                                            <?php echo $menu['menu_items']; ?>
                                        </ul>
                                    </div>
                                <?php endforeach; ?>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="bottom-ft wow fadeInUp">
                    <p><?php echo $s['bottom_text']; ?></p>

                    <ul>
                        <?php echo $s['bottom_links']; ?>
                    </ul>
                </div>

            </div>

        </footer>

<?php
    }
}
