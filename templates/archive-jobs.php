<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<div class="container job-listings-container">
    <header class="page-header">
        <h1 class="page-title">Job Listings</h1>
    </header>

    <?php if (have_posts()) : ?>
        <div class="job-listings">
            <?php while (have_posts()) : the_post(); ?>
            <?php include plugin_dir_path(__FILE__) . 'template-parts/job-listing.php'; ?>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php echo paginate_links(); ?>
        </div>

    <?php else : ?>
        <p>No job listings found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
