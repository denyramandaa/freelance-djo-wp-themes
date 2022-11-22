<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
        <section class="portofolio w-full pt-4 lg:pt-16 flex justify-center items-center flex-wrap">
            <div class="masonry w-full lg:px-6">
                <div class="masonry-item" v-for="(item, key) in listData" :key="key">
                    <div class="cursor-pointer overflow-hidden" @click="showPreview = true, activeImg = key"><img :src="item.src" :alt="item" class="masonry-content" alt="img"></div>
                </div>
            </div>
        </section>
        <transition name="fade">
            <div class="preview w-full flex justify-center items-center flex-wrap fixed top-0 left-0 h-full" v-if="showPreview">
                <div class="preview__inner relative w-full h-full flex flex-col justify-center items-center">
                    <div class="preview--overlay absolute left-0 top-0 w-full h-full" @click="showPreview = false"></div>
                    <img class="preview--img relative" :src="listData[activeImg].src" alt="img">
                    <!-- <p class="preview--text" v-if="listData[activeImg].text">{{ listData[activeImg].text }}</p> -->
                    <div v-if="activeImg > 0" class="preview__navigation preview__navigation--prev" @click="activeImg--">
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/arr-left.png" alt="prev">
                    </div>
                    <div v-if="activeImg < listData.length-1" class="preview__navigation preview__navigation--next" @click="activeImg++">
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/arr-right.png" alt="prev">
                    </div>
                </div>
            </div>
        </transition>
        <!-- end content -->

        
		<?php get_sidebar(); ?>
    </section>

	</main><!-- #main -->

<?php
get_footer();
