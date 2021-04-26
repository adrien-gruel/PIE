<?php get_header() ?>
<section class="section section-single">
    <div class="top-bot-orange single-top"></div>
    <div class="container">
        <article>
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
        </article>
    </div>
</section>

<?php get_footer() ?>