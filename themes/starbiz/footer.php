<?php
/**
 * The footer for our theme
 *
 * @package starbiz
 */
?>
    </div><!-- #content -->

    <?php
    if ( class_exists( 'Redux' ) ){
    $active_footer_id = Redux::get_Option('starbiz_options', 'active_footer', false);
    if ($active_footer_id && class_exists('Elementor\Plugin')) {
        echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display($active_footer_id);
    } else {
            ?>
            <footer id="colophon" class="site-footer mt-auto py-4 bg-light text-black">
                <div class="container d-flex justify-content-between align-items-center">
                    <div class="site-info">
                        &copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
                    </div>

                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'nav',
                        'walker'       => new WP_Bootstrap_Navwalker(),
                    ]);
                    ?>
                </div>
            </footer>
            <?php
        }
    }else {
            ?>
            <footer id="colophon" class="site-footer mt-auto py-4 bg-light text-black">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="site-info">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                </div>

                <?php
                if ( has_nav_menu('footer') ) {
                    // Display assigned footer menu
                    wp_nav_menu([
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'nav',
                        'walker'         => new WP_Bootstrap_Navwalker(),
                    ]);
                } else {
                    // Fallback: default hardcoded menu
                    echo '<ul class="nav">';
                    echo '<li class="nav-item"><a class="nav-link" href="' . esc_url(home_url('/')) . '">Home</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="' . esc_url(home_url('/about')) . '">About</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="' . esc_url(home_url('/contact')) . '">Contact</a></li>';
                    echo '</ul>';
                }
                ?>
            </div>
        </footer>

            <?php
        }
    ?>
</div><!-- /.site-wrapper -->
    </div>
<?php wp_footer(); ?>

<?php
$show_btn = function_exists('starbiz_get_option') ? starbiz_get_option('back_to_top', true) : true;
if ( $show_btn ) : ?>
    <a href="#" class="back-to-top">↑</a>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const btn = document.querySelector(".back-to-top");
        if (!btn) return;

        btn.style.position = "fixed";
        btn.style.bottom = "20px";
        btn.style.right = "20px";
        btn.style.display = "none";
        btn.style.padding = "0px 12px";
        btn.style.height= "36px";
        btn.style.width= "36px";
        btn.style.fontSize= "25px";
        btn.style.background = "#ffffff";
        btn.style.color = "#000";
        btn.style.borderRadius = "40px";
        btn.style.textDecoration = "none";
        btn.style.zIndex = "9999";

        window.addEventListener("scroll", function () {
            btn.style.display = (window.scrollY > 200) ? "block" : "none";
        });

        btn.addEventListener("click", function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    });
    </script>
<?php endif; ?>


</body>
</html>