<li class="job-item">
    <h3><?php the_title(); ?></h3>
    <p>Company: <?php echo esc_html(get_post_meta(get_the_ID(), 'company_name', true)); ?></p>
    <p>Location: <?php echo esc_html(get_post_meta(get_the_ID(), 'location', true)); ?></p>
    <p>Salary: <?php echo esc_html(get_post_meta(get_the_ID(), 'salary', true)); ?></p>
    <p><?php the_excerpt(); ?></p>
</li>
