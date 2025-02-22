<div class="job-item">
    <h2 class="job-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <p class="job-meta">
        <strong>Company:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'company_name', true)); ?><br>
        <strong>Location:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'location', true)); ?><br>
        <strong>Salary:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'salary', true)); ?>
    </p>
    <a class="job-read-more" href="<?php the_permalink(); ?>">View Job Details →</a>
</div>