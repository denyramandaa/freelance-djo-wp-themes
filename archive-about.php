<?php
/**
 * Archive Sketchbook
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
        <section class="portofolio w-full pt-16 flex justify-center items-center flex-wrap">
            <div class="contact__info">
                <div class="contact__info--content mb-8 mr-0 lg:mr-8">
                    <h2>Hello! I’m Maria Karina Putri.</h2>
                    <p class="whitespace-pre-wrap">I live and draw on the island of Oʻahu where I’m from. A life-long doodler, I entered the creative world professionally through graphic design. I now focus primarily on illustration with a specific interest in children’s media.  </p>
                    <p class="whitespace-pre-wrap">My comics have been published in <em>Cubby at Home</em> and <em>Illustoria. </em>In 2021,<em> </em>I received the SCBWI Narrative Art Award for my piece, “City Bear.”</p>
                    <p class="whitespace-pre-wrap">I love stories full of humor, hugs and ‘tude. Sprinkle a little magic into the mundane and I AM THERE. My characters are often oddballs, loners, and trouble-makers—you know, folks I can relate to. </p>
                    <p class="whitespace-pre-wrap">So! If I’m not at the drawing board, come find me with my family enjoying a good laugh and a sweet treat. </p><p class="whitespace-pre-wrap" data-rte-preserve-empty="true"></p>
                    <h3>let’s work together:</h3>
                    <p class="whitespace-pre-wrap"><strong>Literary Inquiries: </strong><br><strong>Kelly Sonnack</strong> at <em>Andrea Brown Literary Agency</em><br>Email: <a href="mailto:kelly@andreabrownlit.com?cc=hello%40adventurefun.club"><strong>kelly@andreabrownlit.com</strong></a></p>
                    <p class="whitespace-pre-wrap">All Other Inquiries: <a href="mailto:hello@adventurefun.club">hello@adventurefun.club</a></p>
                    <h3>Connect:</h3>
                    <p class="whitespace-pre-wrap">
                        <a href="#" target="_blank">SCBWI </a> |  IG <a href="#" target="_blank">@adventurefunclub</a>
                    </p>
                </div>
            </div>
            <div class="contact__photo pr-8 pb-8">
                <img src="https://pps.whatsapp.net/v/t61.24694-24/264983763_1490570388127027_7675281965643955386_n.jpg?ccb=11-4&oh=01_AdRx4cr8MUkPhBSss0OJrF3NDtELNEGnZBYrCvkajQh5vQ&oe=6370860B" alt="ArinDjo">
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
