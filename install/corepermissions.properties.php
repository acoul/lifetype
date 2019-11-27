<?php
/**
 * This file contains all the core permissions that will be loaded in LifeType
 * during the installation process.
 *
 * The format is one big array containing all the permissions available in the system. 
 * Each permission is an array with four fields:
 *
 *   permission name (string with the permission name, please do not use spaces)
 *   permission description (description of the permission)
 *   core permission (true or false)
 *   admin only permission  (true or false)
 *
 * Please do not modify unless you know what you're doing.
 */
$permissions = Array(
	Array( "login_perm", "login_perm_desc", true, true ),
	Array( "blog_access", "blog_access_desc", true, false ),	
	Array( "add_post", "add_post_desc", true, false ),
	Array( "update_post", "update_post_desc", true, false ),
	Array( "view_posts", "view_posts_desc", true, false ),
	Array( "add_category", "add_category_desc", true, false ),
	Array( "update_category", "update_category_desc", true, false ),
	Array( "view_categories", "view_categories_desc", true, false ),	
	Array( "add_link", "add_link_desc", true, false ),
	Array( "update_link", "update_link_desc", true, false ),
	Array( "view_links", "view_links_desc", true, false ),	
	Array( "add_link_category", "add_link_category_desc", true, false ),
	Array( "update_link_category", "update_link_category_desc", true, false ),
	Array( "view_link_categories", "view_link_categories_desc", true, false ),
	Array( "update_comment", "update_comment_desc", true, false ),
	Array( "view_comments", "view_comments_desc", true, false ),
	Array( "update_trackback", "update_trackback_desc", true, false ),
	Array( "view_trackbacks", "view_trackbacks_desc", true, false ),	
	Array( "add_custom_field", "add_custom_field_desc", true, false ),
	Array( "update_custom_field", "update_custom_field_desc", true, false ),
	Array( "view_custom_fields", "view_custom_fields_desc", true, false ),
	Array( "add_resource", "add_resource_desc", true, false ),
	Array( "update_resource", "update_resource_desc", true, false ),	
	Array( "add_album", "add_album_desc", true, false ),
	Array( "update_album", "update_album_desc", true, false ),
	Array( "view_resources", "view_resources_desc", true, false ),	
	Array( "update_blog", "update_blog_desc", true, false ),
	Array( "add_blog_user", "add_blog_user_desc", true, false ),
	Array( "update_blog_user", "update_blog_user_desc", true, false ),
	Array( "view_blog_users", "view_blog_users_desc", true, false ),	
	Array( "add_blog_template", "add_blog_template_desc", true, false ),
	Array( "update_blog_template", "update_blog_template_desc", true, false ),
	Array( "view_blog_templates", "view_blog_templates_desc", true, false ),
	Array( "view_blog_stats", "view_blog_stats_desc", true, false ),
	Array( "update_blog_stats", "update_blog_stats_desc", true, false ),
	Array( "view_all_user_articles", "view_all_user_articles_desc", true, false ),
	Array( "update_all_user_articles", "update_all_user_articles_desc", true, false ),
	Array( "manage_plugins", "manage_plugins_desc", true, false ),
	//
	// admin-only permissions
	//
	Array( "add_user", "add_user_desc", true, true ),
	Array( "view_users", "view_users_desc", true, true ),
	Array( "edit_blog_admin_mode", "edit_blog_admin_mode_desc", true, true ),		
	Array( "update_user", "update_user_desc", true, true ),
	Array( "add_permission", "add_permission_desc", true, true ),
	Array( "view_permissions", "view_permissions_desc", true, true ),
	Array( "update_permission", "update_permission_desc", true, true ),
	Array( "add_site_blog", "add_site_blog_desc", true, true ),
	Array( "view_site_blogs", "view_site_blogs_desc", true, true ),
	Array( "update_site_blog", "update_site_blog_desc", true, true ),
	Array( "add_blog_category", "add_blog_category_desc", true, true ),
	Array( "view_blog_categories", "view_blog_categories", true, true ),
	Array( "update_blog_category", "update_blog_category_desc", true, true ),
	Array( "add_locale", "add_locale_desc", true, true ),
	Array( "view_locales", "view_locales_desc", true, true ),
	Array( "update_locale", "update_locale_desc", true, true ),
	Array( "add_template", "add_template_desc", true, true ),
	Array( "view_templates", "view_templates_desc", true, true ),
	Array( "update_template", "update_template_desc", true, true ),
	Array( "add_global_category", "add_global_article_category_desc", true, true ),
	Array( "view_global_categories", "view_global_article_categories_desc", true, true ),
	Array( "update_global_category", "update_global_article_category_desc", true, true ),
	Array( "view_global_settings", "view_global_settings_desc", true, true ),
	Array( "update_global_settings", "update_global_settings_desc", true, true ),
	Array( "view_plugins", "view_plugins_desc", true, true ),
	Array( "update_plugin_settings", "update_plugin_settings_desc", true, true ),
	Array( "purge_data", "purge_data_desc", true, true ),
	Array( "manage_admin_plugins", "manage_admin_plugins_desc", true, true )
);
?>