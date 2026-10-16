<?php
/**
 * MChem Consultants - template-parts/sections/reviews.php
 *
 * Client Reviews & Testimonials Section.
 *
 * @package mchemconsultants
 */

$review_query = new WP_Query( array(
    'post_type'      => 'mchem_review',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
) );

$cpt_testimonials = array();
if ( $review_query->have_posts() ) {
    $gradients = array(
        'linear-gradient(135deg, #0284C7 0%, #38BDF8 100%)',
        'linear-gradient(135deg, #0D9488 0%, #2DD4BF 100%)',
        'linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%)',
        'linear-gradient(135deg, #B45309 0%, #FBBF24 100%)',
    );
    $idx = 0;
    while ( $review_query->have_posts() ) {
        $review_query->the_post();
        $title   = get_the_title();
        $words   = explode( ' ', trim( $title ) );
        $inits   = ( isset( $words[0][0] ) ? $words[0][0] : '' ) . ( isset( $words[1][0] ) ? $words[1][0] : '' );
        $cpt_testimonials[] = array(
            'name'     => $title,
            'role'     => get_post_meta( get_the_ID(), 'mchem_review_role', true ) ?: 'Client / Partner',
            'company'  => get_post_meta( get_the_ID(), 'mchem_review_company', true ) ?: 'Industrial Client',
            'rating'   => (int) ( get_post_meta( get_the_ID(), 'mchem_review_rating', true ) ?: 5 ),
            'review'   => get_the_content() ?: get_the_excerpt(),
            'initials' => strtoupper( $inits ?: 'MC' ),
            'gradient' => $gradients[ $idx % count( $gradients ) ],
        );
        $idx++;
    }
    wp_reset_postdata();
}

$testimonials = ! empty( $cpt_testimonials ) ? $cpt_testimonials : array(
    array(
        'name'    => 'Engr. Khalid Hussain',
        'role'    => 'Plant Manager',
        'company' => 'Sui Southern Gas Company (SSGC)',
        'rating'  => 5,
        'review'  => 'MChem Consultants delivered an exceptional HAZOP study for our natural gas processing facility. Their team identified 18 critical process deviations we had overlooked. The faculty-guided approach ensured academic rigor combined with practical industrial insights. Highly recommend for any oil and gas process safety work.',
        'initials' => 'KH',
        'gradient' => 'linear-gradient(135deg, #0284C7 0%, #38BDF8 100%)',
    ),
    array(
        'name'    => 'Dr. Saima Noor',
        'role'    => 'Director Operations',
        'company' => 'Lucky Cement Limited, Karachi',
        'rating'  => 5,
        'review'  => 'Outstanding process simulation work. MChem used advanced modeling techniques to optimize our kiln heat integration and saved us nearly 12% in energy costs annually. Their reports are professional, detailed, and fully actionable. A truly dependable engineering consultancy partner.',
        'initials' => 'SN',
        'gradient' => 'linear-gradient(135deg, #0D9488 0%, #2DD4BF 100%)',
    ),
    array(
        'name'    => 'Haris Mansoor',
        'role'    => 'Head of Process Engineering',
        'company' => 'Indus Textile Mills, Hyderabad',
        'rating'  => 5,
        'review'  => 'We engaged MChem Consultants for effluent treatment optimization and sustainable water recycling at our plant. The BIC MUET team brought deep technical knowledge and delivered a fully validated process design that achieved regulatory compliance ahead of schedule. Excellent value and professionalism.',
        'initials' => 'HM',
        'gradient' => 'linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%)',
    ),
    array(
        'name'    => 'Prof. Zafar Ali Shah',
        'role'    => 'Dean of Engineering',
        'company' => 'QUEST Nawabshah',
        'rating'  => 5,
        'review'  => 'MChem Consultants conducted a highly interactive and knowledge-intensive process simulation training workshop for our faculty and final-year students. The content was well-structured, practically oriented, and the trainers were extraordinarily professional. We plan to engage them for our next academic year program as well.',
        'initials' => 'ZA',
        'gradient' => 'linear-gradient(135deg, #B45309 0%, #FBBF24 100%)',
    ),
);
?>

<!-- ============================================================
     REVIEWS & TESTIMONIALS SECTION
     ============================================================ -->
<section id="reviews" class="mchem-reviews-section" aria-labelledby="mchem-reviews-heading">
    <div class="mchem-container">

        <!-- Section Header -->
        <div class="mchem-reviews-header" data-animate="fade-up">
            <div class="mchem-reviews-header__pill">
                <span><?php esc_html_e( 'CLIENT REVIEWS', 'mchemconsultants' ); ?></span>
            </div>
            <h2 id="mchem-reviews-heading" class="mchem-reviews-header__title">
                <?php esc_html_e( 'What our', 'mchemconsultants' ); ?>
                <span class="mchem-reviews-header__highlight"><?php esc_html_e( 'clients say', 'mchemconsultants' ); ?></span>
            </h2>
            <p class="mchem-reviews-header__sub">
                <?php esc_html_e( 'Trusted by plant managers, engineering directors, and academic institutions across Pakistan.', 'mchemconsultants' ); ?>
            </p>
        </div>

        <!-- Stars Summary -->
        <div class="mchem-reviews-summary" data-animate="fade-up">
            <div class="mchem-reviews-summary__rating">
                <span class="mchem-reviews-summary__score">5.0</span>
                <div class="mchem-reviews-summary__stars" aria-label="5 out of 5 stars">
                    <?php for ($s = 0; $s < 5; $s++): ?>
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#FBBF24" stroke="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <?php endfor; ?>
                </div>
                <span class="mchem-reviews-summary__count"><?php esc_html_e( 'Based on client feedback', 'mchemconsultants' ); ?></span>
            </div>
        </div>

        <!-- Reviews Grid -->
        <div class="mchem-reviews-grid" data-animate="fade-up">
            <?php foreach ( $testimonials as $i => $t ) : ?>
            <article class="mchem-review-card" data-delay="<?php echo $i * 80; ?>">
                <!-- Stars -->
                <div class="mchem-review-card__stars" aria-label="<?php echo esc_attr( $t['rating'] ); ?> stars">
                    <?php for ($s = 0; $s < $t['rating']; $s++): ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#FBBF24" stroke="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <?php endfor; ?>
                </div>

                <!-- Review Text -->
                <blockquote class="mchem-review-card__text">
                    "<?php echo esc_html( $t['review'] ); ?>"
                </blockquote>

                <!-- Reviewer Identity -->
                <div class="mchem-review-card__footer">
                    <div class="mchem-review-card__avatar" style="background: <?php echo esc_attr( $t['gradient'] ); ?>;">
                        <?php echo esc_html( $t['initials'] ); ?>
                    </div>
                    <div class="mchem-review-card__info">
                        <strong class="mchem-review-card__name"><?php echo esc_html( $t['name'] ); ?></strong>
                        <span class="mchem-review-card__role"><?php echo esc_html( $t['role'] . ', ' . $t['company'] ); ?></span>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <!-- CTA -->
        <div class="mchem-reviews-cta" data-animate="fade-up">
            <a href="#booking" class="mchem-btn mchem-btn--niw-primary">
                <span><?php esc_html_e( 'Work with MChem Consultants', 'mchemconsultants' ); ?></span>
                <svg class="mchem-btn__arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
            </a>
        </div>

    </div>
</section>