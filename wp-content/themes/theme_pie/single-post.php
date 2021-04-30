<?php get_header() ?>

<main id="primary" class="site-main main-waves">
    
<section class="section section-single">
        
        <div class="top-bot-orange single-top"></div>
        <div class="container">
            <article class="event-single">
                <section class="content-article">
                    <h1><?php the_title() ?></h1>
                    <div class="image-mise-en-avant"><?php the_post_thumbnail() ?></div>
                    
                        <p><?php the_content() ?></p>
                        <?php the_post_navigation(
                                array(
                                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'theme_pie' ) . '</span> <span class="nav-title">%title</span>',
                                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'theme_pie' ) . '</span> <span class="nav-title">%title</span>',
                                )
                            );
                        ?>
                </section>
            </article>
        </div>

        <section class="section-ads">
            <section>
                <?php the_ad_group(90); ?>
            </section>
        </section><!-- Section ads bottom article -->
        

    </section><!-- Section post (article) -->
</main> 



<?php get_footer() ?>