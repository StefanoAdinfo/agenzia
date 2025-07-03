<?php

// Other MetaBox


add_action('admin_menu', 'misha_add_metabox');
// or add_action( 'add_meta_boxes', 'misha_add_metabox' );
// or add_action( 'add_meta_boxes_{post_type}', 'misha_add_metabox' );




// creiamo il metamox
function misha_add_metabox()
{
    add_meta_box(
        'misha_metabox', // metabox ID
        'Meta Box', // title
        'misha_metabox_callback', // callback function
        'page', // add meta box to custom post type (or post types in array)
        'normal', // position (normal, side, advanced)
        'default', // priority (default, low, high, core)
        // array(
        // '__back_compat_meta_box' => true,
        // )

    );
}




// it is a callback function which actually displays the content of the meta box
//Renderizzazione lato admin wp
function misha_metabox_callback($post)
{

    $seo_title = get_post_meta($post->ID, 'seo_title', true);
    $seo_robots = get_post_meta($post->ID, 'seo_robots', true);

    // nonce, actually I think it is not necessary here
    wp_nonce_field('somerandomstr', '_mishanonce');

    echo '<table class="form-table">
    <tbody>
        <tr>
            <th><label for="seo_title">SEO title</label></th>
            <td><input type="text" id="seo_title" name="seo_title" value="' . esc_attr($seo_title) . '" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="seo_tobots">SEO robots</label></th>
            <td>
                <select id="seo_robots" name="seo_robots">
                    <option value="">Select...</option>
                    <option value="index,follow"' . selected(' index,follow', $seo_robots, false) . '>Show for search engines</option>
						<option value="noindex,nofollow"' . selected('noindex,nofollow', $seo_robots, false) . '>Hide for search engines</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>';
}





add_action('save_post', 'misha_save_meta', 10, 2);
// or add_action( 'save_post_{post_type}' , 'misha_save_meta' , 10, 2 );


// salva i dati del meta box
function misha_save_meta($post_id, $post)
{

    // nonce check
    if (! isset($_POST['_mishanonce']) || ! wp_verify_nonce($_POST['_mishanonce'], 'somerandomstr')) {
        return $post_id;
    }

    // check current user permissions
    $post_type = get_post_type_object($post->post_type);

    if (! current_user_can($post_type->cap->edit_post, $post_id)) {
        return $post_id;
    }

    // Do not save the data if autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // define your own post type here
    if ('page' !== $post->post_type) {
        return $post_id;
    }

    if (isset($_POST['seo_title'])) {
        update_post_meta($post_id, 'seo_title', sanitize_text_field($_POST['seo_title']));
    } else {
        delete_post_meta($post_id, 'seo_title');
    }
    if (isset($_POST['seo_robots'])) {
        update_post_meta($post_id, 'seo_robots', sanitize_text_field($_POST['seo_robots']));
    } else {
        delete_post_meta($post_id, 'seo_robots');
    }

    return $post_id;
}
