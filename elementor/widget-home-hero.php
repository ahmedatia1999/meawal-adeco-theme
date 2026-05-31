<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

class ADECO_Home_Hero_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adeco_hero_section';
    }

    public function get_title()
    {
        return __('Hero Section', 'adeco');
    }

    public function get_icon()
    {
        return 'eicon-slider-full-screen';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section('hero_section_content', [
            'label' => __('Hero Content', 'adeco'),
        ]);

        $this->add_control('hero_background', [
            'label' => __('Background Image', 'adeco'),
            'type' => Controls_Manager::MEDIA,
            'default' => ['url' => Utils::get_placeholder_image_src()],
        ]);

        $this->add_control('hero_title', [
            'label' => __('Main Heading', 'adeco'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Minimize Environmental Impact & Maximize <span>Project Success</span>', 'adeco'),
        ]);

        $this->add_control('hero_description', [
            'label' => __('Description', 'adeco'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Providing consultations and services of high quality and value that improve the lives of future target customers.', 'adeco'),
        ]);

        $this->add_control('hero_btn1_text', [
            'label' => __('Button 1 Text', 'adeco'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Get Free Consultation', 'adeco'),
        ]);

        $this->add_control('hero_btn1_link', [
            'label' => __('Button 1 Link', 'adeco'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '#'],
        ]);

        $this->add_control('hero_btn2_text', [
            'label' => __('Button 2 Text', 'adeco'),
            'type' => Controls_Manager::TEXT,
            'default' => __('See How It Works', 'adeco'),
        ]);

        $this->add_control('hero_btn2_link', [
            'label' => __('Button 2 Link', 'adeco'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '#'],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $s = $this->get_settings_for_display();
?>
        <section class="section_home" style="background:url(<?php echo esc_url($s['hero_background']['url']); ?>)">
            <div class="container">
                <div class="home_txt wow fadeInUp">
                    <h1><?php echo $s['hero_title']; ?></h1>
                    <p><?php echo esc_html($s['hero_description']); ?></p>
                </div>
            </div>
        </section>
<?php
    }
}
?>