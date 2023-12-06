<?php
/**
 * HTML Tips content
 * melody_html_tips_content
 */
function melody_html_tips_content()
{
    ob_start();
    ?>
    <h4><?php esc_html_e( 'Here are some HTML examples to use.', 'melody'); ?></h4>
    <p><?php esc_html_e( 'Copy paste your tag and put your content where the three dots are. Parent class name is melody-html-widget', 'melody'); ?></p>
    
    <table class="widefat melody-tips-table">
        <thead>
            <tr class="throw"><th><?php esc_html_e( 'What to Copy', 'melody'); ?></th><th><?php esc_html_e( 'What It Is', 'melody'); ?></th></tr>
        </thead>
        <tbody>
        <tr><td>&lt;h3>...&lt;/h3></td><td><?php esc_html_e( 'Secondary heading tag', 'melody'); ?></td></tr>
        <tr><td>&lt;h4>...&lt;/h4></td><td><?php esc_html_e( 'Even smaller heading tag', 'melody'); ?></td></tr>
        <tr><td>&lt;strong>...&lt;/strong></td><td><?php esc_html_e( 'Strong or Bold tag', 'melody'); ?></td></tr>
        <tr><td>&lt;em>...&lt;/em></td><td><?php esc_html_e( 'Italic or Emphasis tag', 'melody'); ?></td></tr>
        <tr><td>&lt;div class="aligncenter">...&lt;/div></td><td><?php esc_html_e( 'Align items to the center.', 'melody'); ?></td></tr>
        <tr><td>&lt;a href=".." title="..">...&lt;/a></td><td><?php esc_html_e( 'Anchor link. Fill in href & title!', 'melody'); ?></td></tr>
        <tr><td>&lt;img src=".." alt=".." height=" " /></td><td><?php esc_html_e( 'Image. Fill in src (link to image) & alt!', 'melody'); ?></td></tr>
        <tr><td>
            &lt;div class="melody-figtext">
            &lt;img src=".." class="melody-figtext-img" alt=".." height="100" />
            &lt;div class="melody-figtext-txt">...&lt;/div>
            &lt;/div> </td><td><?php esc_html_e( 'Image next to text.', 'melody'); ?></td></tr>

        </tbody>
    </table>
    <ul style="list-style: inside disc">
    <li><?php esc_html_e('To get an image url (src field) open Media and copy "Copy Link" from image details.', 'melody' ); ?></li>
    <li><?php esc_html_e('What is HTML: HTML5 (Hypertext Markup Language 5) is a standardized markup language used for structuring and presenting content on the World Wide Web. ', 'melody'); ?></li>
    
    </ul>
    <?php 
        echo ob_get_clean(); // phpcs ignore:EscapeOutput
} 