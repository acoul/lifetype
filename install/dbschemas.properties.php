<?php

$Tables["articles"]["schema"] = "
  id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
  date T(14) NOTNULL,
  modification_date T(14) NOTNULL,
  user_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  blog_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  status I(5) NOTNULL DEFAULT 1,
  num_reads I(10) DEFAULT '0',
  properties TEXT NOTNULL DEFAULT '',
  slug C(255) NOTNULL DEFAULT '',
  num_comments I(10) NOTNULL DEFAULT '0', 
  num_nonspam_comments I(10) NOTNULL DEFAULT '0', 
  num_trackbacks I(10) NOTNULL DEFAULT '0',
  num_nonspam_trackbacks I(10) NOTNULL DEFAULT '0',
  global_category_id I(10) NOTNULL DEFAULT '0',
  in_summary_page I1(1) NOTNULL DEFAULT '1',
  INDEX num_reads (num_reads),
  INDEX user_id (user_id),
  INDEX slug (slug),
  INDEX blog_id_status_date (blog_id, status, date),
  INDEX global_category_status (global_category_id, status),
  INDEX date(date)
";
$Tables["articles"]["options"] = "TYPE=MyISAM";

$Tables["articles_categories"]["schema"] = "
  id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
  name C(255) NOTNULL DEFAULT '',
  url C(255) NOTNULL DEFAULT '',
  blog_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  last_modification T(14) NOTNULL,
  in_main_page I1(1) NOTNULL DEFAULT '1',
  parent_id I(10) NOTNULL DEFAULT '0',
  description TEXT NOTNULL DEFAULT '',
  properties TEXT NOTNULL DEFAULT '',
  mangled_name C(255) NOTNULL DEFAULT '',
  num_articles I(10) NOTNULL DEFAULT 0,
  num_published_articles I(10) NOTNULL DEFAULT 0
  INDEX parent_id (parent_id),
  INDEX blog_id (blog_id),
  INDEX mangled_name (mangled_name)
";
$Tables["articles_categories"]["options"] = "TYPE=MyISAM";


$Tables["articles_comments"]["schema"] = "
  id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
  article_id I(10) UNSIGNED NOTNULL DEFAULT 0,
  blog_id I(10) UNSIGNED NOTNULL DEFAULT 0,
  topic TEXT NOTNULL,
  text X,
  date T(14) NOTNULL,
  user_id I(10) DEFAULT '0',
  user_email C(255) DEFAULT '',
  user_url C(255) DEFAULT '',
  user_name C(255) NOTNULL DEFAULT Anonymous,
  parent_id I(10) UNSIGNED DEFAULT '0',
  client_ip varchar(15) DEFAULT 0.0.0.0,
  send_notification I1(1) DEFAULT '0',
  status I1(2) DEFAULT '1',
  spam_rate float DEFAULT '0',
  properties TEXT NOTNULL DEFAULT '',
  normalized_text TEXT NOTNULL DEFAULT '',
  normalized_topic TEXT NOTNULL DEFAULT '',
  type I(3) NOTNULL DEFAULT '1', 
  INDEX parent_id (parent_id),
  INDEX article_id_blog_id(article_id,blog_id),
  INDEX article_id_type(article_id,type),  
  INDEX blog_id_type(blog_id,type),
  FULLTEXT normalized_fields (normalized_text,normalized_topic),
  FULLTEXT normalized_text (normalized_text),
  FULLTEXT normalized_topic (normalized_topic)
";
$Tables["articles_comments"]["options"] = "TYPE=MyISAM";

$Tables["articles_notifications"]["schema"] = "
  id I(10) NOTNULL AUTOINCREMENT PRIMARY,
  blog_id I(10) NOTNULL DEFAULT '0',
  user_id I(10) NOTNULL DEFAULT '0',
  article_id I(10) NOTNULL DEFAULT '0',
  INDEX article_id (article_id),
  INDEX user_id (user_id),
  INDEX blog_id (blog_id)
";
$Tables["articles_notifications"]["options"] = "TYPE=MyISAM";

$Tables["blogs"]["schema"] = "
  id I(10) UNSIGNED NOTNULL AUTOINCREMENT INDEX PRIMARY,
  blog varchar(50) NOTNULL DEFAULT '',
  owner_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  blog_category_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  about X,
  settings TEXT NOTNULL,
  mangled_blog varchar(50) NOTNULL DEFAULT '',
  status I(4) NOTNULL DEFAULT '1',
  show_in_summary I(4) NOTNULL DEFAULT '1',
  create_date T(14) NOTNULL,
  last_update_date T(14) NOTNULL,
  num_posts I(10) NOTNULL DEFAULT '0',
  num_comments I(10) NOTNULL DEFAULT '0',
  num_trackbacks I(10) NOTNULL DEFAULT '0',
  custom_domain C(50), 
  INDEX owner_id (owner_id),
  INDEX mangled_blog (mangled_blog),
  INDEX blog_category_id(blog_category_id),
  INDEX custom_domain(custom_domain),
  INDEX create_date(create_date)
";
$Tables["blogs"]["options"] = "TYPE=MyISAM";

$Tables["mylinks"]["schema"] = "
  id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
  category_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  url C(255) NOTNULL DEFAULT '',
  name varchar(100) DEFAULT '',
  description TEXT NOTNULL,
  blog_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  rss_feed C(255) NOTNULL DEFAULT '',
  date T(14) NOTNULL,
  properties TEXT NOTNULL DEFAULT '',
  INDEX blog_id (blog_id),
  INDEX category_id (category_id)
";
$Tables["mylinks"]["options"] = "TYPE=MyISAM";

$Tables["mylinks_categories"]["schema"] = "
  id I(10) NOTNULL AUTOINCREMENT PRIMARY,
  name varchar(100) NOTNULL DEFAULT '',
  blog_id I(10) NOTNULL DEFAULT '0',
  last_modification T(14) NOTNULL,
  properties TEXT NOTNULL DEFAULT '',
  num_links I(10) NOTNULL DEFAULT '0',
  INDEX blog_id (blog_id)
";
$Tables["mylinks_categories"]["options"] = "TYPE=MyISAM";

$Tables["permissions"]["schema"] = "
  id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
  permission varchar(25) NOTNULL DEFAULT '',
  description varchar(100) NOTNULL DEFAULT '',
  admin_only I(1) NOTNULL DEFAULT '1',
  core_perm I(1) NOTNULL DEFAULT '1'
";
$Tables["permissions"]["options"] = "TYPE=MyISAM";

$Tables["referers"]["schema"] = "
  id I(10) NOTNULL AUTOINCREMENT PRIMARY,
  url TEXT NOTNULL,
  article_id I(10) NOTNULL DEFAULT '0',
  blog_id I(10) NOTNULL DEFAULT '0',
  hits I(10) DEFAULT '1',
  last_date T(14),
  INDEX article_id (article_id),
  INDEX blog_id_article_id (blog_id, article_id)
";
$Tables["referers"]["options"] = "TYPE=MyISAM";

$Tables["users"]["schema"] = "
  id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
  user varchar(15) NOTNULL DEFAULT '',
  password varchar(32) NOTNULL DEFAULT '',
  email C(255) NOTNULL DEFAULT '',
  full_name C(255) NOTNULL DEFAULT '',
  about X,
  properties TEXT NOTNULL DEFAULT '',
  status I(4) NOTNULL DEFAULT 1,
  resource_picture_id I(10) NOTNULL DEFAULT 0,
  site_admin I(10) NOTNULL DEFAULT '0',
  last_login T(14),
  UNIQUE user (user)
";
$Tables["users"]["options"] = "TYPE=MyISAM";

$Tables["users_permissions"]["schema"] = "
  id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
  user_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  blog_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  permission_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  INDEX blog_id (blog_id),
  INDEX user_id_permission_id (user_id,permission_id)
";
$Tables["users_permissions"]["options"] = "TYPE=MyISAM";

//
// temporary table only used during the upgrade process, will be dropped at the end of it
//
$Tables["tmp_users_permissions"]["schema"] = "
  id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
  user_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  blog_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  permission_id I(10) UNSIGNED NOTNULL DEFAULT '0',
  INDEX blog_id (blog_id),
  INDEX user_id_permission_id (user_id,permission_id)
";
$Tables["users_permissions"]["options"] = "TYPE=MyISAM";

$Tables["config"]["schema"] = "
   config_key C(255) NOTNULL DEFAULT '' PRIMARY,
   config_value TEXT NOTNULL,
   value_type I(3) DEFAULT '0'
";
$Tables["config"]["options"] = "TYPE=MyISAM";

$Tables["filtered_content"]["schema"] = "
   id I(10) NOTNULL AUTOINCREMENT PRIMARY,
   reg_exp X,
   blog_id I(10) NOTNULL DEFAULT '0',
   reason X,
   date T(14) NOTNULL,
   INDEX blog_id (blog_id)
";
$Tables["filtered_content"]["options"] = "TYPE=MyISAM";

$Tables["host_blocking_rules"]["schema"] = "
   id I(10) NOTNULL AUTOINCREMENT PRIMARY,
   reason X,
   date T(14) NOTNULL,
   blog_id I(10) NOTNULL DEFAULT '0',
   block_type I(1) DEFAULT '1',
   list_type I(1) DEFAULT '1',
   mask I(2) DEFAULT '0',
   host varchar(15) DEFAULT '0.0.0.0',
   INDEX block_type (block_type),
   INDEX blog_id_block_type(blog_id, block_type)
";
$Tables["host_blocking_rules"]["options"] = "TYPE=MyISAM";

$Tables["gallery_resources"]["schema"] = "
   id I(10) NOTNULL AUTOINCREMENT PRIMARY,
   owner_id I(10) NOTNULL DEFAULT '0',
   album_id I(10) NOTNULL DEFAULT '0',
   description X,
   date T(14) NOTNULL,
   flags I(10) DEFAULT '0',
   resource_type I(3) DEFAULT NULL,
   file_path C(255) DEFAULT '',
   file_name C(255) DEFAULT '',
   file_size I(20) NOTNULL DEFAULT 0,
   metadata X,
   thumbnail_format varchar(4) NOTNULL DEFAULT 'same',
   normalized_description TEXT NOTNULL DEFAULT '',
   properties TEXT NOTNULL DEFAULT '',
   INDEX owner_id (owner_id),
   INDEX file_name (file_name),
   INDEX album_id_owner_id (album_id, owner_id),
   INDEX resource_type (resource_type),
   FULLTEXT normalized_description (normalized_description)
";
$Tables["gallery_resources"]["options"] = "TYPE=MyISAM";

$Tables["gallery_albums"]["schema"] = "
   id I(10) NOTNULL AUTOINCREMENT PRIMARY,
   owner_id I(10) NOTNULL DEFAULT '0',
   description TEXT NOTNULL,
   name C(255) NOTNULL DEFAULT '',
   flags I(10) NOTNULL DEFAULT '0',
   parent_id I(10) NOTNULL DEFAULT '0',
   date T(14) NOTNULL,
   properties TEXT NOTNULL DEFAULT '',
   show_album I1(1) DEFAULT 1,
   normalized_description TEXT NOTNULL DEFAULT '',
   normalized_name C(255) NOTNULL DEFAULT '',
   mangled_name C(255) NOTNULL DEFAULT '',
   num_resources I(10) NOTNULL DEFAULT '0',
   num_children I(10) NOTNULL DEFAULT '0',
   INDEX parent_id (parent_id),
   INDEX mangled_name (mangled_name),
   INDEX owner_id_mangled_name (owner_id, mangled_name),
   FULLTEXT normalized_name (normalized_name),
   FULLTEXT normalized_description (normalized_description),
   FULLTEXT normalized_fields (normalized_name, normalized_description)
";
$Tables["gallery_albums"]["options"] = "TYPE=MyISAM";

$Tables["bayesian_filter_info"]["schema"] = "
   id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
   blog_id I(10) UNSIGNED DEFAULT NULL,
   total_spam I(10) UNSIGNED DEFAULT NULL,
   total_nonspam I(10) UNSIGNED DEFAULT NULL,
   INDEX blog_id (blog_id)
";
$Tables["bayesian_filter_info"]["options"] = "TYPE=MyISAM";

$Tables["bayesian_tokens"]["schema"] = "
   id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
   blog_id I(10) UNSIGNED DEFAULT NULL,
   token char(100) DEFAULT NULL,
   spam_occurrences I(10) UNSIGNED DEFAULT NULL,
   nonspam_occurrences I(10) UNSIGNED DEFAULT NULL,
   prob F DEFAULT NULL,
   INDEX blog_id (blog_id),
   INDEX token (token)
";
$Tables["bayesian_tokens"]["options"] = "TYPE=MyISAM";

$Tables["article_categories_link"]["schema"] = "
   article_id I(10) NOTNULL PRIMARY,
   category_id I(10) NOTNULL PRIMARY
";
$Tables["article_categories_link"]["options"] = "TYPE=MyISAM";

$Tables["custom_fields_definition"]["schema"] = "
   id I(10) NOTNULL AUTOINCREMENT PRIMARY,
   field_name C(255) NOTNULL DEFAULT '' PRIMARY,
   field_description TEXT NOTNULL,
   field_type I(2) NOTNULL DEFAULT '1',
   field_values TEXT NOTNULL DEFAULT '',
   blog_id I(10) NOTNULL DEFAULT '0',
   date T(14),
   searchable I1(1) DEFAULT 1,
   hidden I1(1) DEFAULT 1,
   INDEX blog_id (blog_id)
";
$Tables["custom_fields_definition"]["options"] = "TYPE=MyISAM";

$Tables["custom_fields_values"]["schema"] = "
   id I(10) NOTNULL AUTOINCREMENT PRIMARY,
   field_id I(10) NOTNULL DEFAULT '0',
   field_value TEXT NOTNULL,
   normalized_value TEXT NOTNULL,
   blog_id I(10) DEFAULT NULL,
   article_id I(10) DEFAULT NULL,
   FULLTEXT normalized_value (normalized_value),
   INDEX article_id (article_id),
   INDEX field_id (field_id),
   INDEX blog_id_article_id (blog_id, article_id)
";
$Tables["custom_fields_values"]["options"] = "TYPE=MyISAM";

$Tables["articles_text"]["schema"] = "
   id I(10) NOTNULL AUTOINCREMENT PRIMARY,
   article_id I(10) NOTNULL DEFAULT 0,
   text TEXT NOTNULL DEFAULT '',
   topic TEXT NOTNULL DEFAULT '',
   normalized_text TEXT NOTNULL DEFAULT '',
   normalized_topic TEXT NOTNULL DEFAULT '',
   mangled_topic TEXT NOTNULL,
   INDEX article_id (article_id),
   FULLTEXT normalized_text (normalized_text),
   FULLTEXT normalized_topic (normalized_topic),
   FULLTEXT normalized_fields (normalized_text, normalized_topic)
";
$Tables["articles_text"]["options"] = "TYPE=MyISAM";
   
$Tables["phpbb2_users"]["schema"] = "
   id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
   phpbb_id I(10) UNSIGNED NOTNULL,
   full_name C(255) NOTNULL DEFAULT '',
   about X,
   properties TEXT NOTNULL DEFAULT '',
   resource_picture_id I(10) NOTNULL DEFAULT 0,
   status I(10) NOTNULL DEFAULT 0,
   UNIQUE phpbb_id(phpbb_id)
";
$Tables["phpbb2_users"]["options"] = "TYPE=MyISAM";
   
$Tables["blog_categories"]["schema"] = "
   id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
   name C(255) NOTNULL DEFAULT '',
   description C(255) NOTNULL DEFAULT '',
   mangled_name C(255) NOTNULL DEFAULT '',
   properties TEXT NOTNULL DEFAULT '',
   num_blogs I(10) NOTNULL DEFAULT '0',
   num_active_blogs I(10) NOTNULL DEFAULT '0',
   INDEX mangled_name(mangled_name)
";
$Tables["blog_categories"]["options"] = "TYPE=MyISAM";
   
$Tables["global_articles_categories"]["schema"] = "
   id I(10) UNSIGNED NOTNULL AUTOINCREMENT PRIMARY,
   name C(255) NOTNULL DEFAULT '',
   description C(255) NOTNULL DEFAULT '',
   mangled_name C(255) NOTNULL DEFAULT '',
   properties TEXT NOTNULL DEFAULT '',
   num_articles I(10) NOTNULL DEFAULT '0',
   num_active_articles I(10) NOTNULL DEFAULT '0',
   INDEX mangled_name(mangled_name)
";
$Tables["global_articles_categories"]["options"] = "TYPE=MyISAM";

?>
