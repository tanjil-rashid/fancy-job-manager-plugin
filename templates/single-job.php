<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

get_header();

while (have_posts()) : the_post(); ?>
    <div class="container job-single-container">
        <div class="job-header">
            <h1 class="job-title"><?php the_title(); ?></h1>
            <p class="job-company-location">
                <strong>Company:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'company_name', true)); ?><br>
                <strong>Location:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'location', true)); ?>
            </p>
        </div>
        
        <div class="job-details">
            <p><strong>Salary:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'salary', true)); ?></p>
            <div class="job-description">
                <h3>Job Description</h3>
                <?php the_content(); ?>
            </div>
        </div>

        <a href="<?php echo esc_url(home_url('/jobs')); ?>" class="back-to-listings">← Back to Job Listings</a>
    </div>
<?php endwhile;

get_footer();
