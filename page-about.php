<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package arindjo
 */

get_header();
?>

	<main id="primary" class="site-main">

	<section id="app" class="w-full">
        <header class="header fixed top-0 left-0 lg:hidden w-full bg-white">
            <div class="header__inner flex justify-between items-center px-4 py-2">
                <div class="header--logo">
                    <?php 
                    $loop = new WP_Query( array (
                        'post_type' => 'all_settings', 
                        'order_by' => 'post_id', 
                        'order' => 'DESC', 
                        'posts_per_page' => 1,
                        'post_status' => 'publish'
                    ));
                    while($loop->have_posts()) : $loop->the_post();
                    ?>
                    <h1><a href="<?= home_url() ?>"><img src="<?php the_field('web_logo'); ?>" alt="Arindjo Logo"></a></h1>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                <div class="header--burger cursor-pointer" @click="showBurger = !showBurger">
                    <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/burger.png" alt="burger" key="showBurger" v-if="!showBurger">
                    <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/close.png" alt="close" key="hideBurger" v-else>
                </div>
            </div>
        </header>
        <!-- start content -->
        <section class="preview editorial w-full" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="px-4 lg:px-0 flex justify-start items-start flex-wrap h-full pt-8 lg:pt-24">
				<div class="contact__info">
					<div class="contact__info--content mb-8 mr-0 lg:mr-8">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="contact__photo">
					<?php arindjo_post_thumbnail(); ?>
				</div>
			</div>
        </section>
        <!-- end content -->

        
		<?php get_sidebar(); ?>
    </section>

	</main><!-- #main -->

<?php
get_footer();
