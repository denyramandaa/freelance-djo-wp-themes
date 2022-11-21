<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package arindjo
 */
?>

<div class="sidebar px-12 box-content fixed top-0 left-0 h-full bg-white" :class="{ 'show' : showBurger }">
	<div class="sidebar__inner py-16 h-full">
		<div class="relative w-full h-full">
			<div class="sidebar--top">
				<a href="/" class="hidden lg:block mb-2">
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
				</a>
				<div class="sidebar__menu mt-8">
					<div class="mb-4">
						<a href="<?= home_url() ?>" class="no-underline font-bold">illustrations</a>
					</div>
					<div class="mb-4">
						<a href="<?php echo get_post_type_archive_link('editorial'); ?>" class="no-underline font-bold">editorial</a>
					</div>
					<div class="mb-4">
						<a href="<?php echo get_post_type_archive_link('sketchbook'); ?>" class="no-underline font-bold">sketchbook</a>
					</div>
					<div class="mb-4">
						<a href="<?= home_url() . '/about' ?>" class="no-underline font-bold">about</a>
					</div>
				</div>
			</div>
			<div class="text-sm sidebar--bottom absolute bottom-0 left-0">
				<div class="flex items-center mt-2">
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
						<?php foreach( get_field('social_media') as $key => $value ): ?>
							<a href="<?php echo $value['sosmed_url'] ?>" target="_blank">
								<img src="<?php echo $value['sosmed_icon'] ?>" alt="<?php echo $value['sosmed_icon'] ?>" class="icon-social-media">
							</a>
						<?php endforeach; ?>
						
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
				<p class="credit mt-6">© 2022. All rights reserved.</p>
			</div>
		</div>
	</div>
</div>
