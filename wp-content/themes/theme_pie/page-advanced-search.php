<?php
  get_header();
?>

<main id="primary" class="site-main">

    <section class="title-banner">
        <?php the_post_thumbnail() ?>
        <div class="black-opacity"></div>
        <div class="headline-banner">
            <h1><?php the_title() ?></h1>
        </div>
    </section>

    <section class="advanced-search">
            <form method="GET" action="advanced-search" class="search-form">
                <section class="sections-container">
                    <section class="search search_where_container">
                        <h2>Where ?</h2>
                        <div class="search_where">
                            <p>
                                <input class="input" placeholder="Country" type="text" id="search_country" name="search_country" />
                            </p>
                            <p>
                                <input class="input" placeholder="City" type="text" id="search_city" name="search_city" />
                            </p>
                        </div>
                    </section>
                    <section class="search search_when_container">
                        <h2>When ?</h2>
                        <div class="search_when">
                            <p>
                                <input class="input" placeholder="From" type="date" id="search_start_date" name="search_start_date" />
                            </p>
                            <p>
                                <input class="input" placeholder="To" type="date" id="search_end_date" name="search_end_date" />
                            </p>
                        </div>
                    </section>
                </section>
                <section class="search search_what_container">
                    <h2>What ?</h2>
                    <div class="search_what">
                        <p>
                            <input class="input" placeholder="From jQuery" type="number" id="search_fees_start" name="search_fees_start" />
                        </p>

                        <p>
                            <input class="input" placeholder="To jQuery" min="1" type="number" id="search_fees_end" name="search_fees_end" />
                        </p>
                        <p>
                            <select class="input" id="search_language" name="search_language">
                                <option value="select">Select language</option>
                                <option value="english">English</option>
                                <option value="spanish">Spanish</option>
                                <option value="french">French</option>
                                <option value="portuguese">Portuguese</option>
                                <option value="german">German</option>
                                <option value="russian">Russian</option>
                                <option value="chinese">Chinese</option>
                                <option value="arabic">Arabic</option>
                                <option value="other">Other</option>
                            </select>
                        </p>
                        <p>
                            <select class="input" id="search_event_types" name="search_event_types">
                                <option value="select">Select type</option>
                                <?php foreach ( get_event_listing_types() as $types ) : ?>
                                <option value="<?php echo esc_attr( $types->term_id ); ?>">
                                    <?php echo esc_html( $types->name ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                    </div>
                </section>
                <p class="submit-search">
                    <input type="submit" value="Search" class="cta-advanced-search" id="submit-search-button"/>
                </p>
            </form>

        <div class="search-content">
            <div class="loader-container">
                <div class="Loader">
                    <div class="LoaderBalls">
                        <div class="LoaderBalls__item"></div>
                        <div class="LoaderBalls__item"></div>
                        <div class="LoaderBalls__item"></div>
                    </div>
                </div>
            </div>
            <div class="wpem-main wpem-event-listings event_listings wpem-row wpem-event-listing-box-view" id="json_resp">
            </div>
        </div>

    </section>
</main><!-- #main -->

<script>
    jQuery(document).ready(function(jQuery) {
        let formData = {
            'country': jQuery('input[name=search_country]').val(),
            'city': jQuery('input[name=search_city]').val(),
            'search_start_date': jQuery('input[name=search_start_date]').val(),
            'search_end_date': jQuery('input[name=search_end_date]').val(),
            'search_fees_start': jQuery('input[name=search_fees_start]').val(),
            'search_fees_end': jQuery('input[name=search_fees_end]').val(),
            'search_language': jQuery('select[name=search_language]').val(),
            'search_event_types': jQuery('select[name=search_event_types]').val()
        }

        jQuery.ajax({
                method: 'POST',
                url: adminAjax,
                data: {
                    action: 'search_ajax',
                    data: formData
                },
                beforeSend:function(){
                    jQuery('#json_resp').empty()
                    jQuery(".loader-container").fadeIn()
                },
                success: function(response){
                    jQuery.when(jQuery(".loader-container").fadeOut()).then(function(){
                            jQuery('#json_resp').empty().append(response)
                    })
                    console.log(response)
                }
            })
        jQuery('#submit-search-button').click(function(event) {
            event.preventDefault()
            let formData = {
                'country': jQuery('input[name=search_country]').val(),
                'city': jQuery('input[name=search_city]').val(),
                'search_start_date': jQuery('input[name=search_start_date]').val(),
                'search_end_date': jQuery('input[name=search_end_date]').val(),
                'search_fees_start': jQuery('input[name=search_fees_start]').val(),
                'search_fees_end': jQuery('input[name=search_fees_end]').val(),
                'search_language': jQuery('select[name=search_language]').val(),
                'search_event_types': jQuery('select[name=search_event_types]').val()
            }
            jQuery.ajax({
                method: 'POST',
                url: adminAjax,
                data: {
                    action: 'search_ajax',
                    data: formData
                },
                beforeSend:function(){
                    jQuery('#json_resp').empty()
                    jQuery(".loader-container").fadeIn()
                },
                success: function(response){
                    jQuery.when(jQuery(".loader-container").fadeOut()).then(function(){
                        jQuery('#json_resp').empty().append(response)
                    })
                    console.log(response)
                }
            })
        })
    })
</script>

<?php get_footer();