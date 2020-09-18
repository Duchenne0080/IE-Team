<?php if ( get_next_post() || get_previous_post() ) : ?>

    <div class="uk-section uk-section-xsmall">

        <?php if ( get_previous_post() ) : ?>
            <div class="uk-padding-small uk-border-rounded tm-border-secondary uk-margin">
                <div class="uk-h3 uk-margin-remove">
                    <?php echo get_previous_post_link( '%link', '< %title' ); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( get_next_post() ) : ?>
            <div class="uk-padding-small tm-border-secondary uk-border-rounded">
                <div class="uk-h3 uk-margin-remove">
                    <?php echo get_next_post_link( '%link', '> %title' ); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

<?php endif; ?>
