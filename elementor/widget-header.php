<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;

class ADECO_Header_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adeco_header';
    }

    public function get_title()
    {
        return __('Header', 'adeco');
    }

    public function get_icon()
    {
        return 'eicon-header';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        // Logo Control
        $this->start_controls_section(
            'section_logo',
            [
                'label' => __('Logo', 'adeco'),
            ]
        );

        $this->add_control(
            'logo_image',
            [
                'label' => __('Logo Image', 'adeco'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Menu Control
        $this->start_controls_section(
            'section_menu',
            [
                'label' => __('Menu', 'adeco'),
            ]
        );

        // Dropdown sub-repeater
        $dropdown_repeater = new Repeater();
        $dropdown_repeater->add_control(
            'dropdown_label',
            [
                'label' => __('Label', 'adeco'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Sub Item', 'adeco'),
            ]
        );
        $dropdown_repeater->add_control(
            'dropdown_link',
            [
                'label' => __('Link', 'adeco'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'adeco'),
                'default' => ['url' => '#'],
            ]
        );

        // Mega sub-repeater (image + title + desc + link)
        $mega_repeater = new Repeater();
        $mega_repeater->add_control(
            'mega_image',
            [
                'label' => __('Image', 'adeco'),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src()],
            ]
        );
        $mega_repeater->add_control(
            'mega_title',
            [
                'label' => __('Title', 'adeco'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Item Title', 'adeco'),
            ]
        );
        $mega_repeater->add_control(
            'mega_description',
            [
                'label' => __('Description', 'adeco'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Short description', 'adeco'),
            ]
        );
        $mega_repeater->add_control(
            'mega_link',
            [
                'label' => __('Link', 'adeco'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'adeco'),
                'default' => ['url' => '#'],
            ]
        );

        // Top-level menu repeater
        $menu_repeater = new Repeater();

        $menu_repeater->add_control(
            'menu_type',
            [
                'label' => __('Menu Type', 'adeco'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'normal' => __('Normal', 'adeco'),
                    'dropdown' => __('Dropdown', 'adeco'),
                    'mega' => __('Mega Menu', 'adeco'),
                ],
                'default' => 'normal',
            ]
        );

        $menu_repeater->add_control(
            'menu_label',
            [
                'label' => __('Label', 'adeco'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Home', 'adeco'),
            ]
        );

        $menu_repeater->add_control(
            'menu_link',
            [
                'label' => __('Link', 'adeco'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'adeco'),
                'default' => ['url' => '#'],
            ]
        );

        $menu_repeater->add_control(
            'dropdown_items',
            [
                'label' => __('Dropdown Items', 'adeco'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $dropdown_repeater->get_controls(),
                'title_field' => '{{{ dropdown_label }}}',
                'condition' => [
                    'menu_type' => 'dropdown',
                ],
            ]
        );

        $menu_repeater->add_control(
            'mega_items',
            [
                'label' => __('Mega Items', 'adeco'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $mega_repeater->get_controls(),
                'title_field' => '{{{ mega_title }}}',
                'condition' => [
                    'menu_type' => 'mega',
                ],
            ]
        );

        $this->add_control(
            'menu_items',
            [
                'label' => __('Menu Items', 'adeco'),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $menu_repeater->get_controls(),
                'default' => [
                    [
                        'menu_type' => 'normal',
                        'menu_label' => 'About',
                        'menu_link' => ['url' => '#'],
                    ],
                    [
                        'menu_type' => 'mega',
                        'menu_label' => 'Services',
                        'mega_items' => [
                            [
                                'mega_title' => 'Environmental consulting',
                                'mega_description' => 'Preparing environmental proposals for various projects.',
                                'mega_image' => ['url' => Utils::get_placeholder_image_src()],
                                'mega_link' => ['url' => '#'],
                            ],
                            [
                                'mega_title' => 'Maintenance',
                                'mega_description' => 'The company provides maintenance and technical support services.',
                                'mega_image' => ['url' => Utils::get_placeholder_image_src()],
                                'mega_link' => ['url' => '#'],
                            ],
                        ],
                    ],
                    [
                        'menu_type' => 'dropdown',
                        'menu_label' => 'More',
                        'dropdown_items' => [
                            ['dropdown_label' => 'Item 1', 'dropdown_link' => ['url' => '#']],
                            ['dropdown_label' => 'Item 2', 'dropdown_link' => ['url' => '#']],
                        ],
                    ],
                ],
                'title_field' => '{{{ menu_label }}}',
            ]
        );

        $this->end_controls_section();


        // Contact Button Control
        $this->start_controls_section(
            'section_contact_button',
            [
                'label' => __('Contact Us Button', 'adeco'),
            ]
        );

        $this->add_control(
            'contact_button_enabled',
            [
                'label' => __('Contact Button', 'adeco'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'adeco'),
                'label_off' => esc_html__('Hide', 'adeco'),
                'return_value' => 'yes',
                'default' => 'yes',
                'title_field' => '{{{ menu_label }}}',
            ]
        );

        $this->add_control(
            'contact_button_text',
            [
                'label' => __('Text', 'adeco'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Contact Us', 'adeco'),
                'placeholder' => esc_html__('button label', 'adeco')
            ]
        );

        $this->add_control(
            'contact_button_link',
            [
                'label' => __('Link', 'adeco'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function adeco_is_active_url($menu_url, $current_url)
    {
        if (empty($menu_url) || empty($current_url)) {
            return false;
        }

        // Normalize
        $menu_url = strtolower($menu_url);
        $current_url = strtolower($current_url);

        // Remove query and fragment
        $parsed_menu = wp_parse_url($menu_url);
        $parsed_current = wp_parse_url($current_url);

        $menu_path = isset($parsed_menu['path']) ? untrailingslashit($parsed_menu['path']) : '';
        $current_path = isset($parsed_current['path']) ? untrailingslashit($parsed_current['path']) : '';

        // If menu url is relative (no host), compare paths
        if (isset($parsed_menu['host']) === false && isset($parsed_menu['scheme']) === false) {
            // allow "/" vs "" issues
            return ltrim($menu_path, '/') === ltrim($current_path, '/');
        }

        // Otherwise compare full (scheme+host+path)
        $menu_host = isset($parsed_menu['host']) ? $parsed_menu['host'] : '';
        $current_host = isset($parsed_current['host']) ? $parsed_current['host'] : '';

        $menu_scheme = isset($parsed_menu['scheme']) ? $parsed_menu['scheme'] : '';
        $current_scheme = isset($parsed_current['scheme']) ? $parsed_current['scheme'] : '';

        $menu_full = ($menu_scheme ? $menu_scheme . '://' : '') . $menu_host . $menu_path;
        $current_full = ($current_scheme ? $current_scheme . '://' : '') . $current_host . $current_path;

        return $menu_full === $current_full || strpos($current_full, $menu_full) === 0;
    }

    protected function render()
    {
        global $wp;
        $settings = $this->get_settings_for_display();

        $other_lang = 'en';
        $other_lang_label = 'English';
        
        if(get_locale() === 'en_US') {
            $other_lang = 'ar';
            $other_lang_label = 'ع';
        }

        $current_url = home_url(add_query_arg(array(), $wp->request));
        $other_lang_url = add_query_arg('lang', $other_lang, $current_url);

        $lang_text  = $other_lang_label;
        $lang_href  = $other_lang_url;

        // safe defaults
        $menu_items = !empty($settings['menu_items']) && is_array($settings['menu_items']) ? $settings['menu_items'] : [];

        // Start outputting the full header (option 2 requested)
?>
        <div>
            <div class="mobile-menu">
                <div class="logo-mobile">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo esc_url($settings['logo_image']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    </a>
                    <div class="close-menu">
                        <button type="button" class="is-closed">
                            <span class="hamb-top"></span>
                            <span class="hamb-middle"></span>
                            <span class="hamb-bottom"></span>
                        </button>
                    </div>
                </div>
                <div class="mmenu">
                    <ul class="main_menu">
                        <?php if (!empty($menu_items)): ?>
                            <?php foreach ($menu_items as $item): ?>
                                <?php
                                $type = !empty($item['menu_type']) ? $item['menu_type'] : 'normal';
                                $label = !empty($item['menu_label']) ? $item['menu_label'] : '';
                                $link = !empty($item['menu_link']['url']) ? $item['menu_link']['url'] : '#';
                                $is_active = $this->adeco_is_active_url($link, $current_url);

                                // For dropdown/mega in mobile we will render same structure as provided HTML (full mega grid)
                                if ($type === 'normal'): ?>
                                    <li class="<?php echo $is_active ? 'active' : ''; ?>">
                                        <a class="page-scroll" href="<?php echo esc_url($link); ?>"><?php echo esc_html($label); ?></a>
                                    </li>
                                <?php elseif ($type === 'dropdown'): ?>
                                    <li class="dropdown">
                                        <a class="page-scroll dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false"><?php echo esc_html($label); ?></a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php if (!empty($item['dropdown_items']) && is_array($item['dropdown_items'])): ?>
                                                <?php foreach ($item['dropdown_items'] as $drop):
                                                    $dlabel = !empty($drop['dropdown_label']) ? $drop['dropdown_label'] : '';
                                                    $dlink = !empty($drop['dropdown_link']['url']) ? $drop['dropdown_link']['url'] : '#';
                                                    $d_active = $this->adeco_is_active_url($dlink, $current_url);
                                                ?>
                                                    <li class="<?php echo $d_active ? 'active' : ''; ?>"><a class="dropdown-item page-scroll" href="<?php echo esc_url($dlink); ?>"><?php echo esc_html($dlabel); ?></a></li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php elseif ($type === 'mega'): ?>
                                    <li class="dropdown mega-menu">
                                        <a class="page-scroll dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false"><?php echo esc_html($label); ?></a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <div class="container-fluid mega-menu-services-inner px-3 px-lg-4">
                                                <div class="row justify-content-center g-lg-4">
                                                    <?php if (!empty($item['mega_items']) && is_array($item['mega_items'])): ?>
                                                        <?php foreach ($item['mega_items'] as $mega):
                                                            $m_title = !empty($mega['mega_title']) ? $mega['mega_title'] : '';
                                                            $m_desc = !empty($mega['mega_description']) ? $mega['mega_description'] : '';
                                                            $m_link = !empty($mega['mega_link']['url']) ? $mega['mega_link']['url'] : '#';
                                                            $m_img = !empty($mega['mega_image']['url']) ? $mega['mega_image']['url'] : Utils::get_placeholder_image_src();
                                                        ?>
                                                            <div class="col-12 col-md-6 col-lg-3 d-flex">
                                                                <a href="<?php echo esc_url($m_link); ?>" class="item-menu-serv w-100">
                                                                    <figure><img src="<?php echo esc_url($m_img); ?>" alt="<?php echo esc_attr($m_title); ?>"></figure>
                                                                    <div class="txt-menu-serv">
                                                                        <span><?php echo esc_html($m_title); ?></span>
                                                                        <p><?php echo esc_html($m_desc); ?></p>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- language switcher button at the end of the mobile menu -->
                        <li>
                            <a href="<?php echo esc_url($lang_href); ?>" class="page-scroll btn-site"><span><?php echo esc_html($lang_text); ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="main-wrapper">
                <header id="header">
                    <div class="container">
                        <div class="logo-site">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url($settings['logo_image']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                            </a>
                        </div>

                        <ul class="main_menu">
                            <?php if (!empty($menu_items)): ?>
                                <?php foreach ($menu_items as $item): ?>
                                    <?php
                                    $type = !empty($item['menu_type']) ? $item['menu_type'] : 'normal';
                                    $label = !empty($item['menu_label']) ? $item['menu_label'] : '';
                                    $link = !empty($item['menu_link']['url']) ? $item['menu_link']['url'] : '#';
                                    $is_active = $this->adeco_is_active_url($link, $current_url);

                                    if ($type === 'normal'):
                                    ?>
                                        <li class="<?php echo $is_active ? 'active' : ''; ?>">
                                            <a class="page-scroll" href="<?php echo esc_url($link); ?>"><?php echo esc_html($label); ?></a>
                                        </li>

                                    <?php elseif ($type === 'dropdown'): ?>
                                        <li class="dropdown <?php echo $is_active ? 'active' : ''; ?>">
                                            <a class="page-scroll dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false"><?php echo esc_html($label); ?></a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <?php if (!empty($item['dropdown_items']) && is_array($item['dropdown_items'])): ?>
                                                    <?php foreach ($item['dropdown_items'] as $drop):
                                                        $dlabel = !empty($drop['dropdown_label']) ? $drop['dropdown_label'] : '';
                                                        $dlink = !empty($drop['dropdown_link']['url']) ? $drop['dropdown_link']['url'] : '#';
                                                        $d_active = $this->adeco_is_active_url($dlink, $current_url);
                                                    ?>
                                                        <li class="<?php echo $d_active ? 'active' : ''; ?>"><a class="dropdown-item page-scroll" href="<?php echo esc_url($dlink); ?>"><?php echo esc_html($dlabel); ?></a></li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </li>

                                    <?php elseif ($type === 'mega'): ?>
                                        <li class="dropdown mega-menu <?php echo $is_active ? 'active' : ''; ?>">
                                            <a class="page-scroll dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false"><?php echo esc_html($label); ?></a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <div class="container-fluid mega-menu-services-inner px-3 px-lg-4">
                                                    <div class="row justify-content-center g-lg-4">
                                                        <?php if (!empty($item['mega_items']) && is_array($item['mega_items'])): ?>
                                                            <?php foreach ($item['mega_items'] as $mega):
                                                                $m_title = !empty($mega['mega_title']) ? $mega['mega_title'] : '';
                                                                $m_desc = !empty($mega['mega_description']) ? $mega['mega_description'] : '';
                                                                $m_link = !empty($mega['mega_link']['url']) ? $mega['mega_link']['url'] : '#';
                                                                $m_img = !empty($mega['mega_image']['url']) ? $mega['mega_image']['url'] : Utils::get_placeholder_image_src();
                                                                $m_active = $this->adeco_is_active_url($m_link, $current_url);
                                                            ?>
                                                                <div class="col-12 col-md-6 col-lg-3 d-flex">
                                                                    <a href="<?php echo esc_url($m_link); ?>" class="item-menu-serv w-100 <?php echo $m_active ? 'active' : ''; ?>">
                                                                        <figure><img src="<?php echo esc_url($m_img); ?>" alt="<?php echo esc_attr($m_title); ?>"></figure>
                                                                        <div class="txt-menu-serv">
                                                                            <span><?php echo esc_html($m_title); ?></span>
                                                                            <p><?php echo esc_html($m_desc); ?></p>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>

                        <?php if ($settings['contact_button_enabled'] == "yes"): ?>
                            <div class="menu_end">
                                <ul>
                                    <li><a href="<?php echo esc_url($lang_href); ?>" class="page-scroll"><span><?php echo esc_html($lang_text); ?></span></a></li>
                                    <?php
                                    $cta_label = esc_html($settings['contact_button_text']);
                                    $cta_link = esc_url($settings['contact_button_link']["url"]);
                                    $cta_output = '<li class="btn-contact"><a href="' . esc_url($cta_link) . '" class="page-scroll btn-site"><span>' . esc_html($cta_label) . '</span></a></li>';
                                    echo $cta_output;
                                    ?>
                                    <li class="hamburger"><i class="icon icon-hamburger"></i></li>
                                </ul>
                            </div>
                        <?php endif; ?>


                    </div>
                </header>
            </div>
        </div>
<?php
    }
}
