<?php

/////////////////                                          //////////////////
///////////////// STRINGS FOR THE ADMINISTRATION INTERFACE //////////////////
/////////////////                                          //////////////////

// login page
$messages['login'] = 'ログイン';
$messages['welcome_message'] = 'LifeTypeへようこそ。';
$messages['error_incorrect_username_or_password'] = 'ユーザ名かパスワードが間違っています。';
$messages['error_dont_belong_to_any_blog'] = 'あなたが投稿可能なブログが１つもありませんでした。';
$messages['logout_message'] = 'ログアウトしました。';
$messages['logout_message_2'] = '%2$s へ行くには <a href="%1$s">ここ</a> をクリックしてください。';
$messages['error_access_forbidden'] = '認証に失敗しました。再度ログインしてください。';
$messages['username'] = 'ユーザ名';
$messages['password'] = 'パスワード';

// dashboard
$messages['dashboard'] = 'Dashboard';
$messages['recent_articles'] = '最新の投稿';
$messages['recent_comments'] = '最新のコメント';
$messages['recent_trackbacks'] = '最新のトラックバック';
$messages['blog_statistics'] = '統計';
$messages['total_posts'] = '合計投稿数';
$messages['total_comments'] = '合計コメント数';
$messages['total_trackbacks'] = '合計トラックバック数';
$messages['total_viewed'] = '合計閲覧数';
$messages['in'] = '投稿';

// menu options
$messages['newPost'] = '新規投稿';
$messages['Manage'] = '管理';
$messages['managePosts'] = '投稿の管理';
$messages['editPosts'] = '投稿';
$messages['editArticleCategories'] = 'カテゴリ編集';
$messages['newArticleCategory'] = '新規カテゴリ';
$messages['manageLinks'] = 'リンクの管理';
$messages['editLinks'] = 'リンク';
$messages['newLink'] = 'リンクの追加';
$messages['editLink'] = 'リンクの編集';
$messages['editLinkCategories'] = 'リンクカテゴリ';
$messages['newLinkCategory'] = 'リンクカテゴリの追加';
$messages['editLinkCategory'] = 'リンクカテゴリの編集';
$messages['manageCustomFields'] = 'カスタムフィールドの管理';
$messages['blogCustomFields'] = 'カスタムフィールド';
$messages['newCustomField'] = 'カスタムフィールドの追加';
$messages['resourceCenter'] = 'リソースセンター';
$messages['resources'] = 'リソース';
$messages['newResourceAlbum'] = '新規アルバム';
$messages['newResource'] = '新規リソース';
$messages['controlCenter'] = 'コントロールセンター';
$messages['manageSettings'] = '設定';
$messages['blogSettings'] = 'ブログ設定';
$messages['userSettings'] = 'ユーザ設定';
$messages['pluginCenter'] = 'プラグインセンター';
$messages['Stats'] = '統計';
$messages['manageBlogUsers'] = 'ブログユーザの管理';
$messages['newBlogUser'] = '新規ブログユーザ';
$messages['showBlogUsers'] = 'ブログユーザ';
$messages['manageBlogTemplates'] = 'ブログテンプレート';
$messages['newBlogTemplate'] = '新規ブログテンプレート';
$messages['blogTemplates'] = 'ブログテンプレート一覧';
$messages['adminSettings'] = '管理者';
$messages['Users'] = 'ユーザ';
$messages['createUser'] = 'ユーザ作成';
$messages['editSiteUsers'] = 'サイトユーザ';
$messages['Blogs'] = 'ブログの管理';
$messages['createBlog'] = 'ブログの作成';
$messages['editSiteBlogs'] = 'ブログ編集';
$messages['Locales'] = 'ロケールの管理';
$messages['newLocale'] = '新規ロケール';
$messages['siteLocales'] = 'サイトロケール';
$messages['Templates'] = 'テンプレートの管理';
$messages['newTemplate'] = '新規テンプレート';
$messages['siteTemplates'] = 'サイトテンプレート';
$messages['GlobalSettings'] = 'グローバル設定';
$messages['editSiteSettings'] = '一般';
$messages['summarySettings'] = 'サマリページ';
$messages['templateSettings'] = 'テンプレート';
$messages['urlSettings'] = 'URL';
$messages['emailSettings'] = 'Email';
$messages['uploadSettings'] = 'アップロード';
$messages['helpersSettings'] = 'External Helpers';
$messages['interfacesSettings'] = 'インターフェース';
$messages['securitySettings'] = 'セキュリティ';
$messages['bayesianSettings'] = 'Bayesian Filter';
$messages['resourcesSettings'] = 'リソース';
$messages['searchSettings'] = '検索';
$messages['cleanUpSection'] = 'クリア';
$messages['cleanUp'] = 'クリア';
$messages['editResourceAlbum'] = 'アルバム編集';
$messages['resourceInfo'] = 'リソース編集';
$messages['editBlog'] = 'ブログ編集';
$messages['Logout'] = 'ログアウト';

// new post
$messages['topic'] = 'タイトル';
$messages['topic_help'] = '記事タイトル';
$messages['text'] = '本文(概要)';
$messages['text_help'] = '記事の本文。この部分は常にフロントページに表示されます。';
$messages['extended_text'] = '本文(続き)';
$messages['extended_text_help'] = 'この部分は設定によりポストページやメインページに表示されます。「ブログ設定」を参照してください。';
$messages['trackback_urls'] = 'トラックバックURL';
$messages['trackback_urls_help'] = 'トラックバックしたいサイトが「Trackback Auto-Discover」に対応していない場合は、ここにトラックバックURLを記入してください。複数のURLを設定する場合は改行で区切ってください。';
$messages['post_slug'] = 'Slug(URLリンク名)';
$messages['post_slug_help'] = 'パーマリンクのURLを指定したい場合は入力してください。The slug will be used to generate nice permanent links.';
$messages['date'] = '公開日付';
$messages['post_date_help'] = '記事を公開する日付。';
$messages['status'] = 'ステータス';
$messages['post_status_help'] = '1つ選択してください。';
$messages['post_status_published'] = '公開';
$messages['post_status_draft'] = '下書き';
$messages['post_status_deleted'] = '削除';
$messages['post_categories_help'] = 'カテゴリを1つ以上選択してください。';
$messages['post_comments_enabled_help'] = 'コメントを有効にする';
$messages['send_notification_help'] = 'コメント受信通知。';
$messages['send_trackback_pings_help'] = 'トラックバックを送信する';
$messages['send_xmlrpc_pings_help'] = 'XMLRPC ping を送信する';
$messages['save_draft_and_continue'] = '下書き保存';
$messages['preview'] = 'プレビュー';
$messages['add_post'] = '投稿！';
$messages['error_saving_draft'] = '下書きの保存に失敗しました。';
$messages['draft_saved_ok'] = '「 %s 」を下書きに保存しました。';
$messages['error_sending_request'] = 'リクエストの送信に失敗しました。';
$messages['error_no_category_selected'] = '少なくとも1つカテゴリを選択してください。';
$messages['error_missing_post_topic'] = 'タイトルを入力してください。';
$messages['error_missing_post_text'] = '本文を入力してください。';
$messages['error_adding_post'] = '投稿に失敗しました。';
$messages['post_added_not_published'] = '投稿が完了しました。(まだ公開されていません。)';
$messages['post_added_ok'] = '投稿が完了しました。';
$messages['send_notifications_ok'] = '新しいコメントやトラックバックを受け付けたときに通知されます。';
$messages['bookmarklet'] = "ブックマークレット";
$messages['bookmarklet_help'] = "このリンクをブラウザのツールバーにドラッグするか、右クリックでお気に入りやブックマークに保存してください。";
$messages['blogit_to_lifetype'] = "この記事をLifeTypeで投稿する!";
$messages['original_post'] = "(元の投稿)";

// send trackbacks
$messages['error_sending_trackbacks'] = '以下のトラックバック送信に失敗しました。';
$messages['send_trackbacks_help'] = 'トラックバックpingを送信したいURLを選択してください。送信先がトラックバックをサポートしていることを確認してください。';
$messages['send_trackbacks'] = 'トラックバックを送信';
$messages['ping_selected'] = 'Pingが選択されました。';
$messages['trackbacks_sent_ok'] = '選択されたURLにトラックバックが送信されました。';

// posts page
$messages['show_by'] = '絞込み';
$messages['author'] = '投稿者';
$messages['post_status_all'] = '全て';
$messages['author_all'] = '全て';
$messages['search_terms'] = '検索ワード';
$messages['show'] = '表示';
$messages['delete'] = '削除';
$messages['actions'] = '操作';
$messages['all'] = '全て';
$messages['category_all'] = '全て';
$messages['error_incorrect_article_id'] = '記事IDが間違っています。';
$messages['error_deleting_article'] = '「 %s 」の削除に失敗しました。';
$messages['article_deleted_ok'] = '「 %s 」は削除されました。';
$messages['articles_deleted_ok'] = '%s 個の投稿は削除されました。';
$messages['error_deleting_article2'] = '投稿ID %s の削除に失敗しました。';

// edit post page
$messages['update'] = '更新';
$messages['editPost'] = '投稿の編集';
$messages['post_updated_ok'] = '「 %s 」は更新されました。';
$messages['error_updating_post'] = '投稿の更新に失敗しました。';
$messages['notification_added'] = '新しいコメントやトラックバックの通知を受けるように設定しました。';
$messages['notification_removed'] = 'コメントやトラックバックの通知は解除されました。';

// post comments
$messages['url'] = 'URL';
$messages['comment_status_all'] = '全て';
$messages['comment_status_spam'] = 'スパム';
$messages['comment_status_nonspam'] = 'スパムじゃない';
$messages['error_fetching_comments'] = 'コメントの取得に失敗しました。';
$messages['error_deleting_comments'] = 'コメントの削除に失敗したか、コメントが選択されていないため削除されませんでした。';
$messages['comment_deleted_ok'] = 'コメント "%s" が削除されました。';
$messages['comments_deleted_ok'] = '%s 個のコメントが削除されました。';
$messages['error_deleting_comment'] = 'コメント "%s" の削除に失敗しました。';
$messages['error_deleting_comment2'] = 'コメントID "%s" の削除に失敗しました。';
$messages['editComments'] = 'コメント編集';
$messages['mark_as_spam'] = 'スパムとしてマーク';
$messages['mark_as_no_spam'] = 'スパムマーク解除';
$messages['error_incorrect_comment_id'] = 'コメントIDが間違っています。';
$messages['error_marking_comment_as_spam'] = 'コメントをスパムとしてマークする処理に失敗しました。';
$messages['comment_marked_as_spam_ok'] = 'コメントをスパムとしてマークしました。';
$messages['error_marking_comment_as_nonspam'] = 'コメントのスパムマーク解除にしっぱいしました。';
$messages['comment_marked_as_nonspam_ok'] = 'コメントのスパムマークを解除しました。';


// post trackbacks
$messages['blog'] = 'ブログ';
$messages['excerpt'] = '抜粋';
$messages['error_fetching_trackbacks'] = 'トラックバック一覧の取得に失敗しました。';
$messages['error_deleting_trackbacks'] = 'トラックバックの削除に失敗したか、トラックバックが選択されていないため削除されませんでした。';
$messages['error_deleting_trackback'] = 'トラックバック「 %s 」の削除に失敗しました。';
$messages['error_deleting_trackback2'] = 'トラックバックID「 %s 」の削除に失敗しました。';
$messages['trackback_deleted_ok'] = 'トラックバック「 %s 」を削除しました。';
$messages['trackbacks_deleted_ok'] = '%s 個のトラックバックを削除しました。';
$messages['editTrackbacks'] = 'トラックバック';

// post statistics
$messages['referrer'] = '参照元';
$messages['hits'] = 'アクセス数';
$messages['error_no_items_selected'] = '削除するアイテムが選択されていません。';
$messages['error_deleting_referrer'] = '参照元「 %s 」の削除に失敗しました。';
$messages['error_deleting_referrer2'] = '参照元ID「 %s 」の削除に失敗しました。';
$messages['referrer_deleted_ok'] = '参照元「 %s 」を削除しました。';
$messages['referrers_deleted_ok'] = '%s 個の参照元を削除しました。';

// categories
$messages['posts'] = '投稿';
$messages['show_in_main_page'] = 'フロントページに表示する';
$messages['error_category_has_articles'] = 'カテゴリ「 %s 」は使用されています。先に投稿を編集してカテゴリから外してください。';
$messages['category_deleted_ok'] = 'カテゴリ「 %s 」を削除しました。';
$messages['categories_deleted_ok'] = '%s 個のカテゴリを削除しました。';
$messages['error_deleting_category'] = 'カテゴリ「 %s 」の削除に失敗しました。';
$messages['error_deleting_category2'] = 'カテゴリID「 %s 」の削除に失敗しました。';
$messages['yes'] = 'はい';
$messages['no'] = 'いいえ';

// new category
$messages['name'] = '名称';
$messages['category_name_help'] = 'カテゴリの名称。';
$messages['description'] = '説明';
$messages['category_description_help'] = 'カテゴリの説明。';
$messages['show_in_main_page_help'] = 'このカテゴリ内の投稿をフロントページに表示するかどうか。';
$messages['error_empty_name'] = '名称を入力してください。';
$messages['error_empty_description'] = '説明を入力してください。';
$messages['error_adding_article_category'] = '新規カテゴリの追加に失敗しました。入力内容を確認して再度実行してください。';
$messages['category_added_ok'] = 'カテゴリ「 %s 」はブログに追加されました。';
$messages['add'] = '追加';
$messages['reset'] = 'リセット';

// update category
$messages['error_updating_article_category'] = '記事カテゴリの更新に失敗しました。';
$messages['article_category_updated_ok'] = 'カテゴリ「 %s 」を更新しました。';

// links
$messages['feed'] = 'Feed';
$messages['error_no_links_selected'] = 'リンクIDが間違っているか、リンクが選択されていません。';
$messages['error_incorrect_link_id'] = 'リンクIDが間違っています。';
$messages['error_removing_link'] = 'リンク「 %s 」の削除に失敗しました。';
$messages['error_removing_link2'] = 'リンクID「 %s 」の削除に失敗しました。';
$messages['link_deleted_ok'] = 'リンク「 %s 」を削除しました。';
$messages['links_deleted_ok'] = '%s 個のリンクを削除しました。';

// new link
$messages['link_name_help'] = 'このリンクにつける名称。';
$messages['link_url_help'] = 'リンクURL。例: http://www.domainname.com/ (※: http:// から入力してください。)';
$messages['link_description_help'] = 'このリンクの説明。';
$messages['link_feed_help'] = 'このリンクに関するRSSやAtomフィードのリンクも同時に提供されます。';
$messages['link_category_help'] = 'リンクカテゴリを1つ以上選択してください。';
$messages['error_adding_link'] = 'リンクの追加に失敗しました。入力内容を確認して再度実行してください。';
$messages['error_invalid_url'] = 'URLが正しくありません。';
$messages['link_added_ok'] = 'リンク「 %s 」を追加しました。';
$messages['bookmarkit_to_lifetype'] = "LifeTypeにブックマークする。";

// update link
$messages['error_updating_link'] = 'リンクの更新に失敗しました。入力内容を確認して再度実行してください。';
$messages['error_fetching_link'] = 'リンクの取得に失敗しました。';
$messages['link_updated_ok'] = 'リンク「 %s 」を更新しました。';

// link categories
$messages['error_invalid_link_category_id'] = 'リンクカテゴリIDが間違っているか、選択されていません。';
$messages['error_links_in_link_category'] = 'リンクカテゴリ「 %s 」は既に使用されています。最初にリンク設定からカテゴリを削除してください。';
$messages['error_removing_link_category'] = 'リンクカテゴリ「 %s 」の削除に失敗しました。';
$messages['link_category_deleted_ok'] = 'リンクカテゴリ「 %s 」を削除しました。';
$messages['link_categories_deleted_ok'] = '%s 個のリンクカテゴリを削除しました。';
$messages['error_removing_link_category2'] = 'リンクカテゴリID「 %s 」の削除に失敗しました。';

// new link category
$messages['link_category_name_help'] = 'リンクカテゴリの名称。';
$messages['error_adding_link_category'] = 'リンクカテゴリの追加に失敗しました。';
$messages['link_category_added_ok'] = 'リンクカテゴリ「 %s 」を追加しました。';

// edit link category
$messages['error_updating_link_category'] = 'リンクカテゴリの更新に失敗しました。入力内容を確認して再度実行してください。';
$messages['link_category_updated_ok'] = 'リンクカテゴリ「 %s 」を更新しました。';
$messages['error_fetching_link_category'] = 'リンクカテゴリの取得に失敗しました。';

// custom fields
$messages['type'] = 'Type';
$messages['hidden'] = 'Hidden';
$messages['fields_deleted_ok'] = '%s 個のカスタムフィールドを削除しました。';
$messages['field_deleted_ok'] = 'カスタムフィールド「 %s 」を削除しました。';
$messages['error_deleting_field'] = 'カスタムフィールド「 %s 」の削除に失敗しました。';
$messages['error_deleting_field2'] = 'カスタムフィールドID「 %s 」の削除に失敗しました。';
$messages['error_incorrect_field_id'] = 'カスタムフィールドIDが間違っています。';

// new custom field
$messages['field_name_help'] = 'カスタムフィールドの名称。';
$messages['field_description_help'] = 'カスタムフィールドの説明。';
$messages['field_type_help'] = 'フィールドタイプを選択してください。';
$messages['field_hidden_help'] = 'フィールドがHiddenの場合は、投稿の追加/編集時に表示されません。この機能は主にプラグインで使うためのものです。';
$messages['error_adding_custom_field'] = 'カスタムフィールドの追加に失敗しました。入力内容を確認して再度実行してください。';
$messages['custom_field_added_ok'] = 'カスタムフィールド「 %s 」を追加しました。';
$messages['text_field'] = '1行テキスト';
$messages['text_area'] = '複数行テキスト';
$messages['checkbox'] = 'チェックボックス';
$messages['date_field'] = '日付';

// edit custom field
$messages['error_fetching_custom_field'] = 'カスタムフィールドの取得に失敗しました。';
$messages['error_updating_custom_field'] = 'カスタムフィールドの更新に失敗しました。入力内容を確認して再度実行してください。';
$messages['custom_field_updated_ok'] = 'カスタムフィールド「 %s 」を更新しました。';

// resources
$messages['root_album'] = 'アルバムHome';
$messages['num_resources'] = 'ファイル数';
$messages['total_size'] = '総サイズ';
$messages['album'] = 'アルバム';
$messages['error_incorrect_album_id'] = 'アルバムIDが間違っています。';
$messages['error_base_storage_folder_missing_or_unreadable'] = 'ファイルを配置するためのフォルダを作成できません。いくつかの原因が考えられますが、PHPのセーフモードが有効になっていないか確認してください。手動でフォルダを作成することも可能です: <br/><br/>%s<br/><br/>もしこれらのフォルダが既に存在する場合は、Webサーバーの実行アカウントで書き込み/読み込みの権限があることを確認してください。';
$messages['items_deleted_ok'] = '%s 個のアイテムが削除されました。';
$messages['error_album_has_children'] = 'アルバム「 %s 」は空になっていません。先にアルバムを空にしてください。';
$messages['item_deleted_ok'] = 'アイテム「 %s 」を削除しました。';
$messages['error_deleting_album'] = 'アルバム「 %s 」の削除に失敗しました。';
$messages['error_deleting_album2'] = 'アルバムID「 %s 」の削除に失敗しました。';
$messages['error_deleting_resource'] = 'リソース「 %s 」の削除に失敗しました。';
$messages['error_deleting_resource2'] = 'リソースID「 %s 」の削除に失敗しました。';
$messages['error_no_resources_selected'] = '削除するアイテムが選択されていません。';
$messages['resource_deleted_ok'] = 'リソース「 %s 」を削除しました。';
$messages['album_deleted_ok'] = 'アルバム「 %s 」を削除しました。';
$messages['add_resource'] = 'リソース追加';
$messages['add_resource_preview'] = 'プレビュー追加';
$messages['add_resource_medium'] = 'プレビュー追加(中サイズ)';
$messages['add_album'] = 'アルバム追加';

// new album
$messages['album_name_help'] = 'アルバムの名称。';
$messages['parent'] = '親';
$messages['no_parent'] = '親なし';
$messages['parent_album_help'] = 'アルバムを既存のアルバム内に作成する場合に選択してください。';
$messages['album_description_help'] = 'アルバムの説明。';
$messages['error_adding_album'] = 'アルバムの作成に失敗しました。入力内容を確認して再度実行してください。';
$messages['album_added_ok'] = 'アルバム「 %s 」を作成しました。';

// edit album
$messages['error_incorrect_album_id'] = 'アルバムIDが間違っています。';
$messages['error_fetching_album'] = 'アルバムの取得に失敗しました。';
$messages['error_updating_album'] = 'アルバムの更新に失敗しました。入力内容を確認して再度実行してください。';
$messages['album_updated_ok'] = 'アルバム「 %s 」を更新しました。';
$messages['show_album_help'] = 'OFFにするとアルバムはリストに表示されません。';

// new resource
$messages['file'] = 'ファイル';
$messages['resource_file_help'] = '現在のブログに追加するファイル。一度に複数のファイルをアップロードしたいときは「他のファイル...」リンクをクリックしてください。';
$messages['add_field'] = '他のファイル...';
$messages['resource_description_help'] = 'ファイルの説明';
$messages['resource_album_help'] = 'ファイルを追加したいアルバムを選択してください。';
$messages['error_no_resource_uploaded'] = 'アップロードするファイルが選択されていません。';
$messages['resource_added_ok'] = 'ファイル「 %s 」を追加しました。';
$messages['error_resource_forbidden_extension'] = '対象外のファイル形式のため追加できませんでした。';
$messages['error_resource_too_big'] = 'ファイルサイズが大きすぎるため追加できませんでした。';
$messages['error_uploads_disabled'] = 'アップロードが禁止されているためファイルが追加できませんでした。';
$messages['error_quota_exceeded'] = 'リソース上限に達したためファイルが追加できませんでした。';
$messages['error_adding_resource'] = 'ファイルの追加に失敗しました。';

// edit resource
$messages['editResource'] = 'リソース情報を編集';
$messages['resource_information_help'] = 'リソースファイルの情報です。';
$messages['information'] = '情報';
$messages['thumbnail_format'] = 'サムネイルフォーマット';
$messages['regenerate_preview'] = 'プレビュー画像を再作成する';
$messages['error_fetching_resource'] = 'リソースの取得に失敗しました。';
$messages['error_updating_resource'] = 'リソースの更新に失敗しました。';
$messages['resource_updated_ok'] = 'リソース「 %s 」を更新しました。';

// blog settings
$messages['blog_link'] = 'Blog URL';
$messages['blog_link_help'] = 'このブログのパーマリンク。';
$messages['blog_name_help'] = 'このブログのタイトル。';
$messages['blog_description_help'] = 'このブログの説明。';
$messages['language'] = '言語';
$messages['blog_language_help'] = 'このブログで使用する言語。(Webサイトと管理画面両方に適用されます。)';
$messages['max_main_page_items'] = 'メインページに載せる投稿数';
$messages['max_main_page_items_help'] = 'メインページに載せる投稿数を指定してください。';
$messages['max_recent_items'] = '「最近の投稿」数';
$messages['max_recent_items_help'] = '「最近の投稿」に載せる投稿数を指定してください。';
$messages['template'] = 'テンプレート';
$messages['choose'] = '選択';
$messages['blog_template_help'] = 'このブログで使用するテンプレート。グローバルテンプレートとこのブログ用にインストールされたテンプレートから選択できます。';
$messages['use_read_more'] = '"もっと読む..."リンクを使用する';
$messages['use_read_more_help'] = 'この設定を有効にすると「本文(概要)」に入力された部分だけがメインページに表示され、「本文(続き)」を表示するためのリンクが追加されます。';
$messages['enable_wysiwyg'] = 'ビジュアルエディタ(WYSIWYG)を有効にする';
$messages['enable_wysiwyg_help'] = '見たままにHTMLを編集できるエディタを有効にします。このエディタは Internet Explorer 5.5 以上、Mozilla 1.3 以上で動作します。';
$messages['enable_comments'] = 'コメントを有効にする';
$messages['enable_comments_help'] = '全ての投稿のコメントを有効にします。';
$messages['show_future_posts'] = '未来の投稿をカレンダーに表示する';
$messages['show_future_posts_help'] = '未来の日付の投稿をカレンダーに表示してユーザが見れるようにします。';
$messages['comments_order'] = 'コメントの並び順';
$messages['comments_order_help'] = 'フロントページに表示されるコメントの並び順。';
$messages['articles_order'] = '投稿の並び順';
$messages['articles_order_help'] = '記事の並び順。';
$messages['oldest_first'] = '古い順';
$messages['newest_first'] = '新しい順';
$messages['categories_order'] = 'カテゴリの並び順';
$messages['categories_order_help'] = 'フロントページに表示されるカテゴリの並び順。';
$messages['most_recent_updated_first'] = '更新日時順';
$messages['alphabetical_order'] = 'アルファベット順';
$messages['reverse_alphabetical_order'] = 'アルファベットの降順';
$messages['most_articles_first'] = '投稿の多い順';
$messages['link_categories_order'] = 'リンクカテゴリの並び順';
$messages['link_categories_order_help'] = 'フロントページに表示されるリンクカテゴリの並び順。';
$messages['most_links_first'] = 'リンクの多い順';
$messages['most_links_last'] = 'リンクの少ない順';
$messages['time_offset'] = '時間差';
$messages['time_offset_help'] = 'ブログの日時に追加される時間差(単位：時)';
$messages['close'] = '閉じる';
$messages['select'] = '選択';
$messages['error_updating_settings'] = 'ブログ設定の更新に失敗しました。入力内容を確認して再度実行してください。';
$messages['error_invalid_number'] = '数値が間違っています。';
$messages['error_incorrect_time_offset'] = '時間差が正しくありません。';
$messages['blog_settings_updated_ok'] = 'ブログ設定を更新しました。';
$messages['hours'] = '時間';

// user settings
$messages['username_help'] = '公開されるユーザ名。この項目は変更できません。';
$messages['full_name'] = 'フルネーム';
$messages['full_name_help'] = 'フルネーム';
$messages['password_help'] = '新しいパスワードを入力するか、変更しない場合はブランクのままにしてください。';
$messages['confirm_password'] = 'パスワード(確認)';
$messages['email'] = 'メールアドレス';
$messages['email_help'] = '通知が送信されるメールアドレス。';
$messages['bio'] = '自己紹介(bio)';
$messages['bio_help'] = 'あなた自身の公開していい範囲での自己紹介。';
$messages['picture'] = '写真';
$messages['user_picture_help'] = 'あなたのアイコン写真としてアップロードされた写真からどれかを選択してください。';
$messages['error_invalid_password'] = 'パスワードが間違っています。短すぎないようにしてください。';
$messages['error_passwords_dont_match'] = 'パスワードが一致しません。';
$messages['error_updating_user_settings'] = 'ユーザ設定の更新に失敗しました。入力内容を確認して再度実行してください。';
$messages['user_settings_updated_ok'] = 'ユーザ設定を更新しました。';
$messages['resource'] = 'リソース';

// plugin centre
$messages['identifier'] = '識別子';
$messages['error_plugins_disabled'] = 'プラグインは無効になっています。';

// blog users
$messages['revoke_permissions'] = '権限を取り消す';
$messages['error_no_users_selected'] = 'ユーザが選択されていません。';
$messages['user_removed_from_blog_ok'] = 'ユーザ「 %s 」はこのブログへのアクセス権を失いました。';
$messages['users_removed_from_blog_ok'] = '%s 人のユーザがこのブログへのアクセス権を失いました。';
$messages['error_removing_user_from_blog'] = 'ユーザ「 %s 」からの権限の削除に失敗しました。';
$messages['error_removing_user_from_blog2'] = 'ユーザID「 %s 」からの権限の削除に失敗しました。';

// new blog user
$messages['new_blog_username_help'] = 'このブログへのアクセス権を与えたいユーザのユーザ名。新しく追加されたユーザはこのブログの「管理」＆「リソース」機能へアクセスできます。';
$messages['send_notification'] = '通知を送信';
$messages['send_user_notification_help'] = 'このユーザに通知メールを送信します。';
$messages['notification_text'] = '通知文面';
$messages['notification_text_help'] = '通知メッセージに含む文面。';
$messages['error_adding_user'] = 'このユーザへのアクセス付与に失敗しました。入力内容を確認して再度実行してください。';
$messages['error_empty_text'] = '通知文面を入力してください。';
$messages['error_adding_user'] = 'ユーザの追加に失敗しました。入力内容を確認して再度実行してください。';
$messages['error_invalid_user'] = 'ユーザ「 %s 」は正しくないか存在しません。';
$messages['user_added_to_blog_ok'] = 'ユーザ「 %s 」はこのブログにアクセスできるようになりました。';

// blog templates
$messages['error_no_templates_selected'] = 'テンプレートが選択されていません。';
$messages['error_template_is_current'] = 'テンプレート「 %s 」は使用されているため削除できません。';
$messages['error_removing_template'] = 'テンプレート「 %s 」の削除に失敗しました。';
$messages['template_removed_ok'] = 'テンプレート「 %s 」を削除しました。';
$messages['templates_removed_ok'] = '%s 個のテンプレートを削除しました。';

// new blog template
$messages['template_installed_ok'] = 'テンプレート「 %s 」を追加しました。';
$messages['error_installing_template'] = 'テンプレート「 %s 」のインストールに失敗しました。';
$messages['error_missing_base_files'] = 'テンプレートに必要ないくつかのファイルが見つかりません。';
$messages['error_add_template_disabled'] = 'この機能は無効となっているため新しいテンプレートは追加できませんでした。';
$messages['error_must_upload_file'] = 'アップロードするファイルが選択されていません。';
$messages['error_uploads_disabled'] = 'このサイトではアップロード機能が無効になっています。';
$messages['error_no_new_templates_found'] = '新しいテンプレートが見つかりません。';
$messages['error_template_not_inside_folder'] = 'テンプレートセット内で使用されるファイルはテンプレートセットと同じ名前のフォルダ内に配置しなければいけません。';
$messages['error_missing_base_files'] = 'テンプレートに必要ないくつかのファイルが見つかりません。';
$messages['error_unpacking'] = 'ファイルの解凍に失敗しました。';
$messages['error_forbidden_extensions'] = 'このテンプレートには許可されていない拡張子のファイルが含まれています。';
$messages['error_creating_working_folder'] = 'ファイルを解凍するための一時フォルダの作成に失敗しました。';
$messages['error_checking_template'] = 'テンプレートのチェックでエラーが発生しました: %s';
$messages['template_package'] = 'テンプレートパッケージ';
$messages['blog_template_package_help']  = '新しいテンプレートセットをこのフォームからアップロードしてください。追加されたテンプレートはあなたのブログでのみ使用可能となります。ファイルのアップロードがうまく行かない場合は手動でテンプレートファイルを次の場所に配置してください: <b>%s</b> .そして "<b>テンプレートを読み込み</b>" ボタンを押してください。 LifeType はフォルダをスキャンし、見つかったテンプレートを自動で追加します。';
$messages['scan_templates'] = 'テンプレートの検出';

// site users
$messages['user_status_active'] = '有効';
$messages['user_status_disabled'] = '無効';
$messages['user_status_all'] = '全て';
$messages['user_status_unconfirmed'] = '承認待ち';
$messages['error_invalid_user2'] = 'ID "%s" のユーザが見つかりません。';
$messages['error_deleting_user'] = 'ユーザ「 %s 」の無効化に失敗しました。';
$messages['user_deleted_ok'] = 'ユーザ「 %s 」を無効にしました。';
$messages['users_deleted_ok'] = '%s 人のユーザを無効にしました。';

// create user
$messages['user_added_ok'] = 'ユーザ「 %s 」を追加しました。';
$messages['user_status_help'] = '現在のステータス。';
$messages['user_blog_help'] = 'このユーザに最初に紐付けられるブログ。';
$messages['none'] = 'なし';

// edit user
$messages['error_invalid_user'] = 'ユーザIDが間違っているか、ユーザが存在しません。';
$messages['error_updating_user'] = 'ユーザ設定の更新に失敗しました。入力内容を確認して再度実行してください。';
$messages['blogs'] = 'ブログ';
$messages['user_blogs_help'] = 'このユーザが所有している、またはアクセス可能なブログ。';
$messages['site_admin'] = '管理者';
$messages['site_admin_help'] = 'このユーザが管理者権限を持ち「管理者」メニューへのアクセスが許可されているか。';
$messages['user_updated_ok'] = 'ユーザ「 %s 」を更新しました。';

// site blogs
$messages['blog_status_all'] = '全て';
$messages['blog_status_active'] = '有効';
$messages['blog_status_disabled'] = '無効';
$messages['blog_status_unconfirmed'] = '承認待ち';
$messages['owner'] = '所有者';
$messages['quota'] = '容量';
$messages['bytes'] = 'バイト';
$messages['error_no_blogs_selected'] = '無効にするブログが選択されていません。';
$messages['error_blog_is_default_blog'] = 'ブログ「 %s 」はデフォルトにセットされているため削除できません。';
$messages['blog_deleted_ok'] = 'ブログ「 %s 」を無効にしました。';
$messages['blogs_deleted_ok'] = '%s 個のブログを削除しました。';
$messages['error_deleting_blog'] = 'ブログ「 %s 」を無効にできませんでした。';
$messages['error_deleting_blog2'] = 'ブログID「 %s 」を無効にできませんでした。';

// create blog
$messages['error_adding_blog'] = 'ブログの追加に失敗しました。入力内容を確認して再度実行してください。';
$messages['blog_added_ok'] = 'ブログ「 %s 」を追加しました。';

// edit blog
$messages['blog_status_help'] = 'ブログのステータス';
$messages['blog_owner_help'] = '所有者権限を与えるユーザ。全てのブログ設定を操作可能。';
$messages['users'] = 'ユーザ';
$messages['blog_quota_help'] = 'リソース全体の最大容量をバイトで指定してください。容量無制限にする場合は0を指定、グローバル設定を有効にする場合はブランクにしてください。';
$messages['edit_blog_settings_updated_ok'] = 'ブログ「 %s 」の設定を更新しました。';
$messages['error_updating_blog_settings'] = 'ブログ「 %s 」の設定を更新できませんでした。';
$messages['error_incorrect_blog_owner'] = '所有者として選択されたユーザが間違っています。';
$messages['error_fetching_blog'] = 'ブログ設定の取得に失敗しました。';
$messages['error_updating_blog_settings2'] = 'ブログ設定の更新に失敗しました。入力内容を確認して再度実行してください。';
$messages['add_or_remove'] = 'ユーザの追加/削除';

// site locales
$messages['locale'] = 'ロケール';
$messages['locale_encoding'] = '文字コード';
$messages['locale_deleted_ok'] = 'ロケール "%s" を削除しました。';
$messages['error_no_locales_selected'] = '削除するロケールが選択されていません。';
$messages['error_deleting_only_locale'] = '最後の１つなのでこのロケールは削除できません。';
$messages['locales_deleted_ok']= '%s 個のロケールを削除しました。';
$messages['error_deleting_locale'] = 'ロケール「 %s 」の削除に失敗しました。';
$messages['error_locale_is_default'] = 'ロケール「 %s 」は新しいブログのデフォルトに設定されているため削除できません。';

// add locale
$messages['error_invalid_locale_file'] = 'ロケールファイルが正しくありません。';
$messages['error_no_new_locales_found'] = '新しいロケールファイルが見つかりません。';
$messages['locale_added_ok'] = 'ロケール「 %s 」を追加しました。';
$messages['error_saving_locale'] = '新しいロケールの保存に失敗しました。';
$messages['scan_locales'] = 'ロケールの検出';
$messages['add_locale_help'] = 'アップロードしたいロケールファイルをセットしてください。アップロードに失敗する場合は手動でロケールファイルを次の位置に配置してください: <b>./locales/</b> そして "<b>ロケールの検出</b>" ボタンを押してください。LifeType は自動的に新しいロケールを検出し追加します。';

// site templates
$messages['error_template_is_default'] = 'テンプレート「 %s 」は新しいブログのデフォルトにセットされているため削除できません。';

// add template
$messages['global_template_package_help'] = 'アップロードしたいテンプレートセットを選択してください。サイト内の全てのブログで使用可能になります。アップロードに失敗する場合は手動で以下の位置にファイルを配置してください: <b>%s</b> そして、"<b>テンプレートの検出</b>" ボタンをクリックしてください。LifeType は自動的に新しいテンプレートを検出し追加します。';

// global settings
$messages['site_config_saved_ok'] = 'サイト設定を保存しました。';
$messages['error_saving_site_config'] = 'サイト設定の保存に失敗しました。';
/// general settings
$messages['help_comments_enabled'] = 'デフォルトで新しいブログのコメントを有効にする。[Default = Yes]';
$messages['help_beautify_comments_text'] = 'この設定を有効にするとユーザにより投稿されたコメントは段落にフォーマットされ、全てのURLにリンクされます。 [Default = Yes]';
$messages['help_temp_folder'] = 'システムが一時データの保存に使用するためのフォルダ。セキュリティを高めるためにWebサーバーのドキュメントルート以外の場所に配置してください。 [Default = ./tmp]';
$messages['help_base_url'] = 'このブログがインストールされた Base URL.';
$messages['help_subdomains_enabled'] = 'サブドメインを有効にする。サブドメインに関する更なる情報についてはドキュメントを参照してください。 [Default = No]';
$messages['help_include_blog_id_in_url'] = '(この設定はサブドメインが有効で「標準」URLが有効になっているときのみ意味があります。)内部で生成されたURLが "blogId"パラメータを持たないようにします。(よく理解した上で設定を変更してください。) [Default = Yes]';
$messages['help_script_name'] = 'index.php を何か他の名前に変更する必要がある場合のみセットしてください。 [Default = index.php]';
$messages['help_show_posts_max'] = 'メインページに表示される最大投稿数。ブログの新規作成時にデフォルトとしてセットされます。 [Default = 15]';
$messages['help_recent_posts_max'] = 'メインページに表示される「最新の投稿」数。ブログの新規作成時にデフォルトとしてセットされます。 [Default = 10]';
$messages['help_save_drafts_via_xmlhttprequest_enabled'] = 'Ajaxで下書きを保存する機能を有効にするかどうか。 [Default = Yes]';
$messages['help_locale_folder'] = 'ロケールファイルを配置するフォルダ。 [Default = ./locale]';
$messages['help_default_locale'] = '新規ブログのデフォルトロケール。 [Default = en_UK]';
$messages['help_default_blog_id'] = '指定が無いときに表示されるデフォルトのブログID。 [Default = 1]';
$messages['help_default_time_offset'] = '新規ブログのデフォルト時間差。 [Default = 0]';
$messages['help_html_allowed_tags_in_comments'] = 'コメントで許可されるHTMLタグをスペースで区切って入力してください。 [Default = &lt;a&gt;&lt;i&gt;&lt;br&gt;&lt;br/&gt;&lt;b&gt;]';
$messages['help_referer_tracker_enabled'] = '参照元URLをデータベースに保存する機能を有効にするかどうか。パフォーマンス重視の場合は"いいえ"にしてください。 [Default = Yes]';
$messages['help_show_more_enabled'] = '新規ブログにデフォルトで「もっと読む...」機能を有効にするかどうか。 [Default = Yes]';
$messages['help_update_article_reads'] = '投稿が読まれた時刻を更新するかどうか。パフォーマンス重視の場合は"いいえ"にしてください。 [Default = Yes]';
$messages['help_update_cached_article_reads'] = 'キャッシュが有効になっている場合でも投稿が読まれた時刻を更新するかどうか。 [Default = Yes]';
$messages['help_xmlrpc_ping_enabled'] = 'XMLRPC ping をサポートしているサイトに対して送信するかどうか。 [Default = Yes]';
$messages['help_send_xmlrpc_pings_enabled_by_default'] = '記事が投稿または更新されたときにデフォルトで XMLRPC ping を送信するかどうか。 [Default = Yes]';
$messages['help_xmlrpc_ping_hosts'] = 'XMLRPC ping の送信先URL。それぞれのURLを1行ごとに記入してください。 [Default = http://rpc.weblogs.com/RPC2]';
$messages['help_trackback_server_enabled'] = 'トラックバックの受信を有効にするか。 [Default = Yes]';
$messages['help_htmlarea_enabled'] = '新規ブログのデフォルトとしてビジュアルエディタを有効にするか。 [Default = Yes]';
$messages['help_plugin_manager_enabled'] = 'プラグインを有効にするか。 [Default = Yes]';
$messages['help_minimum_password_length'] = 'パスワードの最小長。 [Default = 4]';
$messages['help_xhtml_converter_enabled'] = 'この設定を有効にすると、システムは全てのHTMLコードを正しいXHTMLコードに変換しようと試みます。 [Default = Yes]';
$messages['help_xhtml_converter_aggressive_mode_enabled'] = 'この設定を有効にすると, より積極的にXHTMLに変換しようとします。しかし、そのぶんエラーが発生するかもしれません。 [Default = No]';
$messages['help_session_save_path'] = 'PHPの session_save_path()経由で保存されるセッションデータの保存先を変更したい場合は指定してください。指定したフォルダがWebサーバの実行ユーザから書き込み可能であることを確認してください。PHPのデフォルト値を使用する場合はこの項目をブランクにしてください。 [Default = (empty)]';
// summary settings
$messages['help_summary_page_show_max'] = 'サマリーページに表示するアイテムの数。この設定はサマリーページ内の全てのリストに適用されます。(最近の投稿, よく更新されているブログ, etc). [Default = 10]';
$messages['help_summary_items_per_page'] = '「ブログ一覧」セクションの1ページの表示件数。 [Default = 25]';
$messages['help_forbidden_usernames'] = 'ユーザ名として使用できないワードをスペースで区切ってセットしてください。 [Default = admin www blog ftp]';
$messages['help_force_one_blog_per_email_account'] = '1つのメールアカウントにつき1つしかブログを持てないように制限する。 [Default = No]';
$messages['help_summary_show_agreement'] = 'ユーザ登録画面で規約に同意させる。 [Default = Yes]';
$messages['help_need_email_confirm_registration'] = 'ユーザ登録時にメールアドレスに記載されたリンクをクリックして確認を取るしくみを導入する。 [Default = Yes]';
$messages['help_summary_disable_registration'] = 'このサイトではユーザ登録を無効にする。 [Default = Yes]';
// templates
$messages['help_template_folder'] = 'テンプレート保存フォルダ名。 [Default = ./templates]';
$messages['help_default_template'] = '新規ブログのデフォルトテンプレート。 [Default = standard]';
$messages['help_users_can_add_templates'] = 'ユーザがカスタムテンプレートをアップロードすることを許可する。 [Default = Yes]';
$messages['help_template_compile_check'] = 'この設定を有効にすると、Smartyは毎回テンプレートファイルの更新をチェックします。パフォーマンス重視の場合は"いいえ"にしてください。 [Default = Yes]';
$messages['help_template_cache_enabled'] = 'テンプレートのキャッシュを有効にする。キャッシュを有効にすると可能な限りキャッシュされたデータが使用されるため、データベースからデータを取得する必要が無くなり、テンプレートの再コンパイルも不要になるため、パフォーマンスが向上します。 [Default = Yes]';
$messages['help_template_cache_lifetime'] = 'キャッシュの有効期間。キャッシュを永久に有効にするには "-1" をセットしてください。0をセットするとキャッシュは無効になりますが、無効にしたいのであれば "template_cache_enabled" を "いいえ"にするほうが自然です。 [Default = -1]';
$messages['help_template_http_cache_enabled'] = 'HTTPキャッシュを有効にする。この設定を有効にすると、システムは"If-Modified-Since" HTTP header を取得し、本当に必要なコンテンツだけを送信します。ネットワーク帯域の削減につながります。 [Default = Yes]';
$messages['help_allow_php_code_in_templates'] = 'Smartyテンプレート内で {php}...{/php} ブロックによるPHPコードの埋め込みを許可する。 [Default = No]';
// urls
$messages['help_request_format_mode'] = 'URL形式を選択してください。「カスタムURL」を使用する場合は以下の設定も確認してください。 [Default = Plain]';
$messages['plain'] = 'Plain';
$messages['search_engine_friendly'] = 'Search engine friendly';
$messages['custom_url_format'] = 'カスタムURL';
$messages['help_permalink_format'] = 'カスタムURLを使用する場合のパーマリンク形式。 [Default = /blog/{blogname}/{catname}/{year}/{month}/{day}/{postname}$]';
$messages['help_category_link_format'] = 'カスタムURLを使用する場合のカテゴリページへのリンク形式。[Default = /blog/{blogname}/{catname}$]';
$messages['help_blog_link_format'] = 'カスタムURLを使用する場合のブログメインページへのリンク形式。[Default = /blog/{blogname}$]';
$messages['help_archive_link_format'] = 'カスタムURLを使用する場合のアーカイブへのリンク形式。 [Default = /blog/{blogname}/archives/{year}/?{month}/?{day}]';
$messages['help_user_posts_link_format'] = 'カスタムURLを使用する場合の特定ユーザごとの投稿ページへのリンク形式。[Default = /blog/{blogname}/user/{username}$]';
$messages['help_post_trackbacks_link_format'] = 'カスタムURLを使用する場合のトラックバックページへのリンク形式。 [Default = /blog/{blogname}/post/trackbacks/{postname}$]';
$messages['help_template_link_format'] = 'カスタムURLを使用する場合のスタティックテンプレートページへのリンク形式。 [Default = /blog/{blogname}/content/{templatename}$]';
$messages['help_album_link_format'] = 'カスタムURLを使用する場合のアルバムページへのリンク形式。 [Default = /blog/{blogname}/album/{albumname}$]';
$messages['help_resource_link_format'] = 'カスタムURLを使用する場合のリソースページへのリンク形式。 [Default = /blog/{blogname}/resource/{albumname}/{resourcename}$]';
$messages['help_resource_preview_link_format'] = 'カスタムURLを使用する場合のリソースプレビューへのリンク形式。 [Default = /blog/{blogname}/resource/{albumname}/preview/{resourcename}$]';
$messages['help_resource_medium_size_preview_link_format'] = 'カスタムURLを使用する場合の"mediumサイズリソースプレビュー"へのリンク形式。 [Default = /blog/{blogname}/resource/{albumname}/preview-med/{resourcename}$]';
$messages['help_resource_download_link_format'] = 'カスタムURLを使用する場合のファイルへのリンク形式。 [Default = /blog/{blogname}/resource/{albumname}/download/{resourcename}$]';
// email
$messages['help_check_email_address_validity'] = 'メールアドレスのチェックを行なうときに、MXレコードやメールボックスの存在チェックなどを行なうかどうか。 [Default = No]';
$messages['help_email_service_enabled'] = 'メール送信を有効にするか。 [Default = Yes]';
$messages['help_post_notification_source_address'] = 'システムから送信されるメールの Fromアドレス。 [Default = noreply@your.host.com]';
$messages['help_email_service_type'] = 'メール送信にどのシステムを使うか。 [Default = PHP]';
$messages['help_smtp_host'] = 'メール送信にSMTPを使う場合はSMTPサーバーのアドレスを指定してください。 [Default = (empty)]';
$messages['help_smtp_port'] = 'SMTPサーバーが25番ポート以外で動作している場合はポート番号を指定してください。 [Default = (empty)]';
$messages['help_smtp_use_authentication'] = 'SMTPサーバーが認証を要求する場合はこちらを有効にしてください。 [Default = No]';
$messages['help_smtp_username'] = 'SMTPサーバーが認証を要求する場合のユーザ名。 [Default = (empty)]';
$messages['help_smtp_password'] = 'SMTPサーバーが認証を要求する場合のパスワード。 [Default = (empty)]';
// helpers
$messages['help_path_to_tar'] = '"tar" コマンドのパス。.tar.gzや.tar.bz2形式のテンプレートセットを解凍するのに必要です。 [Default = /bin/tar]';
$messages['help_path_to_gzip'] = '"gzip"コマンドのパス。.tar.gz形式のテンプレートセットを解凍するのに必要です。 [Default = /bin/gzip]';
$messages['help_path_to_bz2'] = '"bzip2"コマンドのパス。.tar.bz2形式のテンプレートセットを解凍するのに必要です。 [Default = /usr/bin/bzip2]';
$messages['help_path_to_unzip'] = '"unzip"コマンドのパス。.zip形式のテンプレートセットを解凍するのに必要です。 [Default = /usr/bin/unzip]';
$messages['help_unzip_use_native_version'] = 'zipファイルの解凍にPHP標準のバージョンを使用するか。 [Default = No]';
// uploads
$messages['help_uploads_enabled'] = 'ユーザにファイルのアップロードを許可するか。この設定はリソース、カスタムテンプレート、ロケールに適用されます。 [Default = Yes]';
$messages['help_maximum_file_upload_size'] = '最大ファイルサイズをbyteで指定してください。PHPで設定されているlimitを超えることはできません。 [Default = 2000000]';
$messages['help_upload_forbidden_files'] = 'アップロードを禁止するファイルタイプをスペース区切りで指定してください。\'*\' や \'?\' が使用できます。 [Default = *.php *.php3 *.php4 *.phtml]';
// interfaces
$messages['help_xmlrpc_api_enabled'] = 'XMLRPC での接続を許可する。 [Default = Yes]';
$messages['help_rdf_enabled'] = 'AtomやRSSでのフィードを有効にする。 [Default = Yes]';
$messages['help_default_rss_profile'] = '特に指定がない場合の標準のRSSまたはAtomのバージョン。 [Default = RSS 1.0]';
// security
$messages['help_security_pipeline_enabled'] = '"security pipeline"と全ての関連するフィルターを有効にする。これは新しいフィルタを登録したプラグインにも適用されます。 [Default = Yes]';
$messages['help_maximum_comment_size'] = 'コメントの最大サイズをbyteで指定してください。この機能を無効にするには0をセットしてください。 [Default = 0]';
// bayesian filter
$messages['help_bayesian_filter_enabled'] = 'スパムフィルターに "Bayesian filter"を使用する。 [Default = Yes]';
$messages['help_bayesian_filter_spam_probability_treshold'] = 'コメントがspamと認定されるしきい値。 [Default = 0.9]';
$messages['help_bayesian_filter_nonspam_probability_treshold'] = 'コメントがspamでないと判定されるしきい値。 [Default = 0.2]';
$messages['help_bayesian_filter_min_length_token'] = '"Bayesian Filter"の判定対象とするtokenの最小長。 [Default = 3]';
$messages['help_bayesian_filter_max_length_token'] = '"Bayesian Filter"の判定対象とするtokenの最大長。 [Default = 100]';
$messages['help_bayesian_filter_number_significant_tokens'] = '必要なtokenの数。 [Default = 15]';
$messages['help_bayesian_filter_spam_comments_action'] = 'コメントがspamと認定されたときの動作。"削除する"を選択する場合は filterが十分に学習されたことを確認してからにしてください。 [Default = Keep]';
$messages['keep_spam_comments'] = '"Spam"としてマークして保存';
$messages['throw_away_spam_comments'] = '削除する(保存しない)';
// resources
$messages['help_resources_enabled'] = 'リソースを有効にする。 [Default = Yes]';
$messages['help_resources_folder'] = 'リソースファイル(写真, ビデオ, etc.)が保存されるフォルダへの相対パス。 [Default = ./gallery]';
$messages['help_thumbnail_method'] = 'サムネイルを生成する方法。PHPを使用する場合はGDが必要となります。 [Default = PHP]';
$messages['help_path_to_convert'] = 'ImageMagickの"convert"コマンドのパス。サムネイルの生成方法で"ImageMagick"を指定した場合は必須になります。 [Default = /usr/bin/convert]';
$messages['help_thumbnail_format'] = 'サムネイルの形式。 [Default = Same as image]';
$messages['help_thumbnail_height'] = '小サムネイルのデフォルト高さ。 [Default = 120]';
$messages['help_thumbnail_width'] = '小サムネイルのデフォルト幅。 [Default = 120]';
$messages['help_medium_size_thumbnail_height'] = '中サムネイルのデフォルト高さ。 [Default = 480]';
$messages['help_medium_size_thumbnail_width'] = '中サムネイルのデフォルト幅。 [Default = 640]';
$messages['help_thumbnails_keep_aspect_ratio'] = 'サムネイル生成時にアスペクト比を変更しない。上記指定のサイズより大きくなる可能性もあるが画質はよくなります。 [Default = Yes]';
$messages['help_thumbnail_generator_force_use_gd1'] = 'GD1でサポートされている機能のみ使用する。 [Default = No]';
$messages['help_thumbnail_generator_user_smoothing_algorithm'] = 'サムネイルを滑らかにするアルゴリズム。GDのときのみ有効。 [Default = PHP Imagecopyresampled]';
$messages['help_resources_quota'] = 'システム全体の最大リソース容量をbyteで指定してください。(i.e. 5242880 Bytes = 5MB), 制限をかけない場合は0を指定してください。[Default = 0]';
$messages['help_resource_server_http_cache_enabled'] = '"If-Modified-Since" header と "HTTP conditional requests"の利用を有効にする。帯域の有効利用に効きます。 [Default = No]';
$messages['help_resource_server_http_cache_lifetime'] = 'キャッシュされたリソースの有効期間。(秒) [Default = 86400]';
$messages['same_as_image'] = '元画像と同じ';
// search
$messages['help_search_engine_enabled'] = '検索エンジンを有効にする。 [Default = Yes]';
$messages['help_search_in_custom_fields'] = 'カスタムフィールドを検索対象にする。 [Default = Yes]';
$messages['help_search_in_comments'] = 'コメントを検索対象にする。 [Default = Yes]';

// cleanup
$messages['purge'] = '完全削除';
$messages['cleanup_spam'] = 'スパムを削除する';
$messages['cleanup_spam_help'] = 'スパムとしてマークされた全てのコメントを削除します。一度削除すると元には戻せません。';
$messages['spam_comments_purged_ok'] = 'スパムコメントを削除しました。';
$messages['cleanup_posts'] = 'ごみ箱の投稿を削除する';
$messages['cleanup_posts_help'] = '削除された投稿データ("削除"としてマーク)を完全に削除します。完全に削除すると元には戻せません。';
$messages['posts_purged_ok'] = '投稿は完全に削除されました。';
$messages['purging_error'] = 'データの完全削除に失敗しました。';

/// summary ///
// front page
$messages['summary'] = 'サマリー';
$messages['register'] = '登録';
$messages['summary_welcome'] = 'ようこそ!';
$messages['summary_most_active_blogs'] = '最近投稿の多いブログ';
$messages['summary_most_commented_articles'] = 'もっともコメントが多い記事';
$messages['summary_most_read_articles'] = 'もっとも読まれた記事';
$messages['password_forgotten'] = 'パスワードを忘れましたか?';
$messages['summary_newest_blogs'] = '新着ブログ';
$messages['summary_latest_posts'] = '最新記事';
$messages['summary_search_blogs'] = 'ブログを検索';

// blog list
$messages['updated'] = '更新日時';
$messages['total_reads'] = '総PV';

// blog profile
$messages['blog'] = 'ブログ';
$messages['latest_posts'] = '最近の投稿';

// registration
$messages['register_step0_title'] = '規約に同意';
$messages['agreement'] = '規約'; 
$messages['decline'] = '同意しない';
$messages['accept'] = '同意する';
$messages['read_service_agreement'] = 'サービス規約を確認し、同意される場合は「同意する」ボタンを押してください。';
$messages['register_step1_title'] = 'ユーザ登録 [1/4]';
$messages['register_step1_help'] = 'ブログを作成するにはまずはじめにユーザ登録をします。作成したユーザはブログの所有者となり、すべての機能にアクセス可能です。';
$messages['register_next'] = '次へ';
$messages['register_back'] = '戻る';
$messages['register_step2_title'] = 'ブログの作成 [2/4]';
$messages['register_blog_name_help'] = '新しいブログの名称。';
$messages['register_step3_title'] = 'テンプレートの選択 [3/4]';
$messages['step1'] = 'Step 1';
$messages['step2'] = 'Step 2';
$messages['step3'] = 'Step 3';
$messages['register_step3_help'] = 'あなたのブログのデフォルトテンプレートを1つ選択してください。あとで気に入らなくなっても変更することができます。';
$messages['error_must_choose_template'] = 'テンプレートを1つ選択してください。';
$messages['select_template'] = 'テンプレートを選択';
$messages['register_step5_title'] = 'ブログ作成完了! [4/4]';
$messages['finish'] = '完了';
$messages['register_need_confirmation'] = 'あなたのメールアドレス宛に確認用のメールが送信されました。メールを受信したらリンクをクリックしてブログをスタートしてください。';
$messages['register_step5_help'] = 'おめでとうございます！新しいユーザとブログが作成されました。';
$messages['register_blog_link'] = '作成したブログを閲覧したい場合は次のリンクをクリックしてください: <a href="%2$s">%1$s</a>';
$messages['register_blog_admin_link'] = '今すぐに投稿をしたい場合は <a href="admin.php">管理画面</a> をクリックしてください。';
$messages['register_error'] = '登録に失敗しました。';
$messages['error_registration_disabled'] = 'このサイトでは新しいブログの登録は無効になっています。';
// registration article topic and text
$messages['register_default_article_topic'] = 'おめでとうございます!';
$messages['register_default_article_text'] = 'あなたがこの投稿を読めているということはブログ作成が成功し、投稿が可能になっています。この投稿は削除して、あなたの記事を投稿してください。';
$messages['register_default_category'] = '未分類';
// confirmation email
$messages['register_confirmation_email_text'] = 'あなたのブログを有効にするために以下のリンクをクリックしてください:

%s

良い一日を！';
$messages['error_invalid_activation_code'] = '確認コードが正しくありません。';
$messages['blog_activated_ok'] = 'おめでとうございます！新しいユーザとブログが有効になりました。';
// forgot your password?
$messages['reset_password'] = 'パスワードリセット';
$messages['reset_password_username_help'] = 'パスワードのリセットを行いたいユーザ名。';
$messages['reset_password_email_help'] = 'このユーザに登録されているメールアドレス。';
$messages['reset_password_help'] = 'パスワードをお忘れになった場合など、パスワードをリセットしたい場合はこのフォームに入力してください。リセットしたいユーザのユーザ名とメールアドレスを入力してください。';
$messages['error_resetting_password'] = 'パスワードのリセットに失敗しました。入力内容を確認して再度実行してください。';
$messages['reset_password_error_incorrect_email_address'] = 'メールアドレスが間違っているか、登録されたメールアドレスと異なっています。';
$messages['password_reset_message_sent_ok'] = 'あなたのメールアドレス宛にパスワードリセット用のメッセージを送信しました。メッセージ内のリンクをクリックしてパスワードをリセットすることができます。';
$messages['error_incorrect_request'] = 'URL内のパラメータが間違っています。';
$messages['change_password'] = '新しいパスワードの入力';
$messages['change_password_help'] = '新しいパスワードを入力してください。';
$messages['new_password'] = '新しいパスワード';
$messages['new_password_help'] = '新しいパスワードを入力してください。';
$messages['password_updated_ok'] = 'パスワードを更新しました。';

// Suggested by BCSE, some useful messages that not available in official locale
$messages['upgrade_information'] = 'This page looks plain and un-styled because you\'re using a non-standard compliant browser. To see it in its best form, please <a href="http://www.webstandards.org/upgrade/" title="The Web Standards Project\'s Browser Upgrade initiative">upgrade</a> to a browser that supports web standards. It\'s free and painless.';
$messages['jump_to_navigation'] = 'Jump to Navigation.';
$messages['comment_email_never_display'] = '行と段落は自動的に反映されます。メールアドレスは表示されません。';
$messages['comment_html_allowed'] = '次の <acronym title="Hypertext Markup Language">HTML</acronym> タグが使用可能です: &lt;<acronym title="Hyperlink">a</acronym> href=&quot;&quot; title=&quot;&quot; rel=&quot;&quot;&gt; &lt;<acronym title="Acronym Description">acronym</acronym> title=&quot;&quot;&gt; &lt;<acronym title="Quote">blockquote</acronym> cite=&quot;&quot;&gt; &lt;<acronym title="Strike">del</acronym>&gt; &lt;<acronym title="Italic">em</acronym>&gt; &lt;<acronym title="Underline">ins</acronym>&gt; &lt;<acronym title="Bold">strong</acronym>&gt;';
$messages['trackback_uri'] = 'このエントリーのトラックバック <acronym title="Uniform Resource Identifier">URL</acronym> は次の通りです: ';

$messages['xmlrpc_ping_ok'] = 'XMLRPC Ping を送信しました: ';
$messages['error_sending_xmlrpc_ping'] = '次のURLにXMLRPC ping を送信できませんでした: ';
$messages['error_sending_xmlrpc_ping_message'] = 'XMLRPC pingの送信に失敗しました: ';

//
// new strings for 1.1
//
$messages['error_incorrect_trackback_id'] = 'トラックバックIDが間違っています。';
$messages['error_marking_trackback_as_spam'] = 'トラックバックをスパムとしてマークできませんでした。';
$messages['trackback_marked_as_spam_ok'] = 'トラックバックをスパムとしてマークしました。';
$messages['error_marking_trackback_as_nonspam'] = 'トラックバックのスパムマーク解除に失敗しました。';
$messages['trackback_marked_as_nonspam_ok'] = 'トラックバックのスパムマークを解除しました。';
$messages['upload_here'] = 'ここにアップロード';
$messages['cleanup_users'] = 'ユーザを完全削除';
$messages['cleanup_users_help'] = '管理者によって削除マークされた全てのユーザを完全に削除します。同時にこのユーザが所有する全てのブログとそのデータを削除します。このユーザが他のブログに投稿する権限がある場合は、このユーザにより投稿された全ての記事もあわせて削除されます。一度削除されたデータは元に戻すことはできません。';
$messages['users_purged_ok'] = 'ユーザの完全削除が完了しました。';
$messages['cleanup_blogs'] = 'ブログを完全削除';
$messages['cleanup_blogs_help'] = '管理者によって無効にされた全てのブログを完全に削除します。ブログ内の全てのデータを削除します。一度削除されたデータは元に戻すことができません。';
$messages['blogs_purged_ok'] = 'ブログを完全に削除しました。';
$messages['help_use_http_accept_language_detection'] = 'Mozilla Firefox や Safari, Internet Explorerなど多くのブラウザはユーザが表示可能な言語を少なくとも1つ通知します。 この機能を有効にするとシステムは要求された言語が有効であればその言語でデータを提供しようとします。 [Default = No]';

$messages['error_invalid_blog_category'] = '不正なブログカテゴリです。';
$messages['error_adding_blog_category'] = 'ブログカテゴリの追加に失敗しました。';
$messages['newBlogCategory'] = '新しいブログカテゴリ';
$messages['editBlogCategories'] = 'ブログカテゴリ';
$messages['blog_category_added_ok'] = 'ブログカテゴリを追加しました。';
$messages['error_blog_category_has_blogs'] = 'ブログカテゴリ「 %s 」は既に使用されています。先にブログカテゴリをブログから解除して、再度実行してください。';
$messages['error_deleting_blog_category'] = 'ブログカテゴリ「 %s 」の削除に失敗しました。';
$messages['blog_category_deleted_ok'] = 'ブログカテゴリ「 %s 」を削除しました。';
$messages['blog_categories_deleted_ok'] = '%s 個のブログカテゴリを削除しました。';
$messages['error_deleting_blog_category2'] = 'ブログカテゴリID「 %s 」の削除に失敗しました。';
$messages['blog_category'] = 'ブログカテゴリ';
$messages['blog_category_help'] = 'このブログにアサインされるグローバルブログカテゴリ。';

$messages['help_use_captcha_auth'] = '不正登録を防ぐため、ユーザ登録時に CAPTCHA 機能を使用する。 [ Default = No ]';
$messages['help_skip_dashboard'] = 'ダッシュボードページは表示されなくなり、ユーザが属する最初のブログが表示されるようになります。 [ Default = No ]';

$messages['manageGlobalArticleCategory'] = '共通記事カテゴリ';
$messages['newGlobalArticleCategory'] = '新しい共通記事カテゴリ';
$messages['editGlobalArticleCategories'] = '共通記事カテゴリ';
$messages['global_category_name_help'] = '共通記事カテゴリの名称。';
$messages['global_category_description_help'] = '共通記事カテゴリの説明。';
$messages['error_incorrect_global_category_id'] = '不正な共通記事カテゴリIDです。';
$messages['global_category_deleted_ok'] = '共通記事カテゴリ「 %s 」を削除しました。';
$messages['global_category_added_ok'] = '共通記事カテゴリ「 %s 」を追加しました。';
$messages['error_deleting_global_category2'] = '共通記事カテゴリID「 %s 」の削除に失敗しました。';

$messages['help_page_suffix_format'] = 'ページネーション時にURLに付加されるパス。 [ Default = /page/{page} ]';

$messages['help_final_size_thumbnail_width'] = 'アップロードされる画像の幅。縮小しない場合はブランクまたは0をセットしてください。 [ Default = 0 ]';
$messages['help_final_size_thumbnail_height'] = 'アップロードされる画像の高さ。縮小しない場合はブランクまたは0をセットしてください。 [ Default = 0 ]';
$messages['error_comment_too_big'] = 'コメントが長すぎます。';
$messages['error_you_have_been_blocked'] = 'ブロックされました: このリクエストは完了しませんでした。';
$messages['created'] = '作成日時';
$messages['view'] = '見る';
$messages['editUser'] = 'ユーザ編集';
$messages['help_urlize_word_separator'] = '生成される記事URLに使われる単語の繋ぎに使用する文字。 この文字はサブドメインのサポートが有効になっているときにホスト名をブログ名称から生成する際にも使用されます。 [ Default = - ]';
$messages['help_summary_template_cache_lifetime'] = 'サマリーページのキャッシュ有効期間。0以外をセットするとサマリーページはその期間キャッシュされます。0をセットした場合はデータが変更されるたびに即反映されます。 [ Default = 0 ]';
$messages['register_default_album_name'] = '分類なし';
$messages['register_default_album_description'] = '新しい写真はここにアップロードされます。';
$messages['show_in_summary'] = 'サマリーに表示';
$messages['show_in_summary_help'] = 'このブログをサマリーページに読み込む。';

$messages['saving_message'] = '保存中 ...';
$messages['show_option_panel'] = 'オプションの表示';
$messages['hide_option_panel'] = 'オプションを隠す';

$messages['quick_launches'] = 'ショートカット';

$messages['confirmation_message_resent_ok'] = '確認メッセージが再送されました。';

$messages['goto_blog_page'] = '%s へ行く';

$messages['help_num_blogs_per_user'] = '所有者が管理画面からブログを作成できる数。';

$messages['massive_change_option'] = '一括編集オプション';
$messages['show_massive_change_option'] = '一括編集オプションを表示';
$messages['hide_massive_change_option'] = '一括編集オプションを隠す';
$messages['change_status'] = 'ステータス変更';
$messages['change_category'] = 'カテゴリ変更';
$messages['error_updating_comment_no_comment'] = 'コメントの更新に失敗しました。コメント #%s が見つかりません。';
$messages['error_updating_comment_wrong_blog'] = 'コメントの更新に失敗しました。このコメント (%s) はこのブログに投稿されたものではありません。';
$messages['error_updating_comment'] = 'コメント (%s) の更新に失敗しました。';
$messages['error_updating_comment_already_updated'] = 'コメント (%s) に変更がありませんでした。';
$messages['comment_updated_ok'] = 'コメントを更新しました。';
$messages['comments_updated_ok'] = '%s 個のコメントを更新しました。';

$messages['error_post_status'] = '投稿ステータスを選択してください。';
$messages['error_comment_status'] = 'コメントステータスを選択してください。';
$messages['admin_mode'] = '管理者モード';
$messages['administrate_user_blog'] = 'このブログを管理';
$messages['trackbacks_updated_ok'] = '%s 個のトラックバックを更新しました。';
$messages['trackback_updated_ok'] = 'トラックバックを更新しました。';
$messages['error_trackback_status'] = '正しいステータスを選択してください。';
$messages['select'] = '選択';
$messages['remove_selected'] = '選択項目を削除';

$messages['notification_subject'] = 'LifeType Notification System';
$messages['error_no_trackback_links_sent'] = '※: トラックバックが1つも送信されませんでした。';

$messages['help_http_cache_lifetime'] = 'ブラウザーキャッシュの有効期間を秒で指定 (この期間はブラウザはサーバーに接続せず、ローカルにキャッシュされたページを表示します。ブラウザの表示速度を劇的に向上させますが、投稿やコメントの反映が遅れることがあります。 [Default = 1800]';

$messages['trackbacks_no_trackback'] = '以下のURLにトラックバックを送信できませんでした: ';

$messages['error_comment_spam_throw_away'] = 'メッセージはスパムフィルターによりブロックされました。';
$messages['error_comment_spam_keep'] = 'コメントを受け付けました。ブログ所有者の確認を待って表示されます。ありがとうございました!';

$messages['blog_categories'] = 'ブログカテゴリ';
$messages['global_article_categories'] = '共通記事カテゴリ';

$messages['help_force_posturl_unique'] = '全ての投稿のURLがユニークになるようにする。 あなたがURLを変更し、URLの日付部分を削除した場合にのみ必要となります。 [ Default = no ]';

$messages['default_send_notification'] = '標準の送信通知';

$messages['enable_pull_down_menu'] = 'プルダウンメニュー';
$messages['enable_pull_down_menu_help'] = 'プルダウンメニューを有効にする。';

$messages['change_album'] = 'アルバムの変更';

$messages['warning_autosave_message'] = '<img src="imgs/admin/icon_warning-16.png" alt="Error" class="InfoIcon"/><p class="ErrorText">投稿を保存せずにページを離れようとしています。 <a href="#" onclick="restoreAutoSave();">ここをクリックしてリストアする</a> か <a href="#" onclick="eraseAutoSave();">削除してください</a>。</p>';

$messages['check_username'] = 'ユーザ名のチェック';
$messages['check_username_ok'] = 'このユーザ名は使用可能です。';
$messages['error_username_exist'] = 'このユーザ名は使用できません。別のものをセットしてください。';

$messages['error_rule_email_dns_server_temp_fail'] = '一時的にエラーが発生しました - 少し間をおいてから再度実行してください。';
$messages['error_rule_email_dns_server_unreachable'] = 'メールサーバーに接続できません。';
$messages['error_rule_email_dns_not_permitted'] = 'メール送信が許可されていません。';

$messages['blog_users_help'] = 'このブログにアクセス(投稿)可能なユーザ。';

$messages['summary_welcome_paragraph'] = 'これはサンプルメッセージです。このページをカスタマイズするときに変更してください。このメッセージは ja_JPロケールファイルにセットされていますが、テンプレートファイル templates/summary/index.template も変更してください。';

$messages['first_day_of_week'] = 0;
$messages['first_day_of_week_label'] = '週の始まりの曜日';
$messages['first_day_of_week_help'] = 'カレンダー表示のための週の始まりの曜日。';

$messages['help_subdomains_base_url'] = 'サブドメインを有効にしている場合、この base URL が base_url のかわりに使用されます。{blogname}はブログ名称に、{username}はユーザ名に、{blogdomain}はユーザが指定するサブドメインに変換されます。 (e.g. http://{blogname}.yourdomain.com)';

$messages['registration_default_subject'] = 'LifeType registration confirmation';

$messages['error_invalid_subdomain'] = 'サブドメインが正しくないか、他と重複しています。';
$messages['register_blog_domain_help'] = '新しく作成するブログの名前とサブドメイン。';
$messages['domain'] = 'ドメイン';
$messages['help_subdomains_available_domains'] = 'サブドメインの選択肢をスペースで区切ってセットしてください。ユーザはこの中から好きなサブドメインを選択することができるようになります。この設定はサブドメインを有効にして、上記 subdomain_base_url の設定を {blogdomain} にしたときに使われます。ドメインをユーザに自由に決めさせる場合は \'?\' を入力してください。';
$messages['subdomains_any_domain'] = '<- マルチドメインが有効です。フルドメイン名を入力してください。';
$messages['error_updating_blog_subdomain'] = 'サブドメインの更新に失敗しました。入力内容を確認して再度実行してください。';
$messages['error_updating_blog_main_domain'] = 'メインドメインの設定変更に失敗しました。サイト管理者が何かの設定を間違えたものと思われます。';

$messages['monthsshort'] = Array( '1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月' );
$messages['weekdaysshort'] = Array( '日', '月', '火', '水', '木', '金', '土' );

$messages['search_type'] = '検索対象';
$messages['posts'] = '投稿';
$messages['blogs'] = 'ブログ';
$messages['resources'] = 'リソース';
$messages['upload_in_progress'] = 'アップロードしています。お待ちください...';
$messages['error_incorrect_username'] = 'ユーザ名が正しくありません。既に使用されているか、使用できない文字が含まれているか、長すぎる可能性があります。(特殊文字, 大文字は使用しない。最長15文字まで。)';

$messages['Miscellaneous'] = 'その他';
$messages['Plugins'] = 'プラグイン';

$messages['auth_img'] = '認証コード';
$messages['auth_img_help'] = '上記画像内に見える文字を入力してください。';

$messages['global_category'] = '共通カテゴリ';
$messages['global_article_category_help'] = 'サイト内の全投稿に使えるカテゴリ。';

$messages['password_reset_subject'] = 'LifeType Password Request';

//
// new strings for LifeType 1.2
//
$messages['auth'] = '認証';
$messages['authenticated'] = '認証されました';
$messages['dropdown_list_field'] = 'ドロップダウンリスト';
$messages['values'] = '選択肢';
$messages['field_values'] = 'このフィールドの選択肢として表示される値。最初の値がデフォルトとして使用されます。';

$messages['permission_added_ok'] = '権限作成が成功しました。';
$messages['core_perm'] = '標準権限';
$messages['admin_only'] = '管理者のみ';
$messages['permissionsList'] = '権限一覧';
$messages['newPermission'] = '新規権限';
$messages['permission_name_help'] = 'パーミッションの名称(重複しないようにしてください)。';
$messages['permission_description_help'] = 'パーミッションの説明';
$messages['core_perm_help'] = 'もしこの権限が標準権限の一部である場合は削除することはできません。';
$messages['admin_only_help'] = 'この権限を管理者ユーザにのみ付与可能とするかどうか。';
$messages['error_adding_new_permission'] = '新規権限の追加に失敗しました。入力内容を確認してください。';
$messages['error_incorrect_permission_id'] = '権限IDが正しくありません。';
$messages['error_permission_cannot_be_deleted'] = '権限 "%s" の削除に失敗しました。1人以上のユーザに付与されているか、標準権限に含まれている場合は削除できません。';
$messages['error_deleting_permission'] = '権限 "%s" の削除に失敗しました。';
$messages['permission_deleted_ok'] = '権限 "%s" を削除しました。';
$messages['permissions_deleted_ok'] = '%s 個の権限を削除しました。';
$messages['error_deleting_permission2'] = '権限ID "%s" の削除に失敗しました。';

$messages['help_hard_show_posts_max'] = 'ブログページ内に表示される記事の最大上限数。ユーザがこの値以上の値を個別にセットしていた場合、その値は無視されてこちらの設定が有効になります。 [ Default = 50 ]';
$messages['help_hard_recent_posts_max'] = 'ブログページ内に表示される「最近の投稿」の最大上限数。ユーザがこの値以上の値を個別にセットしていた場合、その値は無視されてこちらの設定が有効になります。 [ Default = 25 ]';

$messages['error_permission_required'] = 'この操作を行なう権限がありません。';
$messages['user_permissions_updated_ok'] = 'ユーザの権限を更新しました。';

// blog permissions
$messages['add_album_desc'] = '新規アルバムの追加';
$messages['add_blog_template_desc'] = '新規テンプレートの追加';
$messages['add_blog_user_desc'] = '新規ユーザの追加';
$messages['add_category_desc'] = '新規カテゴリの追加';
$messages['add_custom_field_desc'] = '新規カスタムフィールドの追加';
$messages['add_link_desc'] = '新規リンクの追加';
$messages['add_link_category_desc'] = '新規リンクカテゴリの追加';
$messages['add_post_desc'] = '新規投稿の追加';
$messages['add_resource_desc'] = '新規リソースの追加';
$messages['blog_access_desc'] = 'このブログへのアクセスを許可する';
$messages['update_album_desc'] = '既存アルバムの編集';
$messages['update_blog_desc'] = 'ブログ設定の編集';
$messages['update_blog_template_desc'] = 'ブログテンプレートの編集';
$messages['update_blog_user_desc'] = 'ユーザ権限の編集';
$messages['update_category_desc'] = '既存カテゴリの編集';
$messages['update_comment_desc'] = '既存コメントの編集';
$messages['update_custom_field_desc'] = '既存カスタムフィールドの編集';
$messages['update_link_desc'] = '既存リンクの編集';
$messages['update_link_category_desc'] = '既存リンクカテゴリの編集';
$messages['update_post_desc'] = '既存投稿の編集';
$messages['update_resource_desc'] = '既存リソースの編集';
$messages['update_trackback_desc'] = '既存トラックバックの編集';
$messages['view_blog_templates_desc'] = 'ブログテンプレートの参照';
$messages['view_blog_users_desc'] = 'ブログユーザの参照';
$messages['view_categories_desc'] = 'ブログカテゴリの参照';
$messages['view_comments_desc'] = 'ブログコメントの参照';
$messages['view_custom_fields_desc'] = 'ブログカスタムフィールドの参照';
$messages['view_links_desc'] = 'ブログリンクの参照';
$messages['view_link_categories_desc'] = 'ブログリンクカテゴリの参照';
$messages['view_posts_desc'] = '投稿の参照';
$messages['view_resources_desc'] = 'リソースの参照';
$messages['view_trackbacks_desc'] = 'トラックバックの参照';
$messages['login_perm_desc'] = 'ログイン許可';
// admin permissions
$messages['add_blog_category_desc'] = 'ブログカテゴリの追加';
$messages['add_global_article_category_desc'] = '共通記事カテゴリの追加';
$messages['add_locale_desc'] = '新規ロケールの追加';
$messages['add_permission_desc'] = '新規権限の追加';
$messages['add_site_blog_desc'] = '新規ブログの追加';
$messages['add_template_desc'] = '新規テンプレートの追加';
$messages['add_user_desc'] = '新規ユーザの追加';
$messages['edit_blog_admin_mode_desc'] = '他のブログの管理 (管理者モード)';
$messages['purge_data_desc'] = 'データの完全削除';
$messages['update_blog_category_desc'] = 'ブログカテゴリの編集/削除';
$messages['update_global_article_category_desc'] = '共通記事カテゴリの編集/削除';
$messages['update_global_settings_desc'] = 'サイト設定の編集';
$messages['update_locale_desc'] = 'ロケールの編集/削除';
$messages['update_permission_desc'] = '権限の編集/削除';
$messages['update_plugin_settings_desc'] = 'プラグイン設定の編集';
$messages['update_site_blog_desc'] = 'ブログの編集/削除';
$messages['update_template_desc'] = 'テンプレートの編集/削除';
$messages['update_user_desc'] = 'ユーザの編集/削除';
$messages['view_blog_categories'] = 'ブログカテゴリの参照';
$messages['view_global_article_categories_desc'] = '共通記事カテゴリの参照';
$messages['view_global_settings_desc'] = 'サイト設定の参照';
$messages['view_locales_desc'] = 'ロケールの参照';
$messages['view_permissions_desc'] = '権限の参照';
$messages['view_plugins_desc'] = 'インストールされたプラグインの参照';
$messages['view_site_blogs_desc'] = 'サイトブログの参照';
$messages['view_templates_desc'] = 'テンプレートの参照';
$messages['view_users_desc'] = 'ユーザの参照';
$messages['update_blog_stats_desc'] = '参照元の削除';
$messages['manage_admin_plugins_desc'] = '管理者プラグインの管理';

$messages['summary_welcome_msg'] = 'ようこそ, %s!';
$messages['summary_go_to_admin'] = '管理画面を開く';

$messages['error_can_only_update_own_articles'] = '他人の投稿を編集する権限がありません。';
$messages['update_all_user_articles_desc'] = '他人の投稿を編集';
$messages['error_can_only_view_own_articles'] = '他人の投稿を参照する権限がありません。';
$messages['view_all_user_articles_desc'] = '他人の投稿を参照';
$messages['error_fetching_permission'] = '権限の読み込みに失敗しました。';
$messages['editPermission'] = '権限の編集';
$messages['error_updating_permission'] = '権限の更新に失敗しました。';
$messages['permission_updated_ok'] = '権限を更新しました。';
$messages['error_adding_permission'] = '権限の追加に失敗しました。';
$messages['error_cannot_login'] = 'ログインが許可されていません。';
$messages['admin_user_permissions_help'] = 'このユーザに付与される全サイト共通の権限';

$messages['permissions'] = '権限';
$messages['blog_user_permissions_help'] = 'ユーザに付与されたこのブログにおける権限';
$messages['pluginSettings'] = 'プラグイン設定';
$messages['user_can_override'] = 'Users can override';
$messages['user_cannot_override'] = 'Users cannot override';
$messages['global_plugin_settings_saved_ok'] = '共通プラグイン設定を保存しました。';
$messages['error_updating_global_plugin_settings'] = '共通プラグイン設定の保存に失敗しました。';
$messages['error_incorrect_value'] = '値が正しくありません。';
$messages['parameter'] = 'パラメータ';
$messages['value'] = '値';
$messages['override'] = '上書き';
$messages['editCustomField'] = 'カスタムフィールドの編集';
$messages['view_blog_stats_desc'] = 'ブログ統計の参照';
$messages['manage_plugins_desc'] = 'ブログプラグインの管理';

$messages['error_global_category_has_articles'] = '共通記事カテゴリを削除できません。このカテゴリにはまだ記事が割り当てられています。';
$messages['error_adding_global_article_category'] = '共通記事カテゴリの追加に失敗しました。';

$messages['temp_folder_reset_ok'] = '一時ディレクトリをクリアしました。';
$messages['cleanup_temp_help'] = '一時ディレクトリのクリーンアップを開始します。全てのブログにおけるデータキャッシュとテンプレートキャッシュがクリアされます。';
$messages['cleanup_temp'] = '一時ディレクトリのクリーンアップ';

$messages['comment_only_auth_users'] = '認証されたユーザのみコメントが可能';
$messages['comment_only_auth_users_help'] = '正しいユーザ名とパスワードでログインしているユーザのみコメントを書くことができます。';
$messages['show_comments_max'] = 'コメント表示件数';
$messages['show_comments_max_help'] = '1ページあたりのコメント表示最大件数。 [ Default = 20 ]';
$messages['hard_show_comments_max_help'] = 'システムで制限される1ページあたりのコメント表示最大件数。 [ Default = 50 ]';

$messages['error_resource_not_whitelisted_extension'] = 'このファイル形式は許可されていません。';
$messages['help_upload_allowed_files'] = 'アップロードを許可するファイル形式をスペースで区切って入力してください。* と ? を使うことができます。もし upload_forbidden_file とこの設定が両方セットされている場合は、許可リスト (upload_allowed_files) が 拒否リストより優先されます。 [Default = None]';

$messages['help_template_load_order'] = 'テンプレートファイルの探索順と読み込み順を定義します。「デフォルトテンプレート優先」の場合は、まず templates/default/ フォルダを探し、見つからない場合にユーザテンプレートをロードします。 もし同じテンプレートファイルが両方の場所に存在する場合はデフォルトテンプレートが使用されます。「ユーザテンプレート優先」の場合はその逆です。';
$messages['template_load_order_user_first'] = 'デフォルトテンプレート優先';
$messages['template_load_order_default_first'] = 'ユーザテンプレート優先';

$messages['editBlogUser'] = 'ブログユーザの編集';

$messages['help_summary_service_name'] = 'サイト/サービスの名称。フロントページやRSSフィードなどいくつかの場所に表示されます。 [ Default = empty ]';

$messages['register_step2_help'] = 'ブログの作成に必要な情報を入力してください。';

$messages['create_date'] = '作成日';

$messages['insert_media'] = 'メディアの挿入';
$messages['insert_more'] = '"もっと読む..." リンクのON/OFF';

$messages['purging_please_wait'] = 'データが完全削除されるまでお待ちください。このページは全てのデータが削除されるまでリフレッシュされますのでそのままにしておいてください。';

$messages['error_cannot_delete_last_blog_category'] = 'ブログカテゴリは最低1つ残しておかなければなりません。';

$messages['help_logout_destination_url'] = 'ユーザが管理画面からログアウトしたときに、ログイン画面のかわりに表示するURL。 [ Default Value = empty ]';
$messages['help_default_global_article_category_id'] = '標準の共通記事カテゴリに指定するID。 [ Default = empty ]';
$messages['help_blog_does_not_exist_url'] = '表示しようとしたブログが存在しなかった場合に、デフォルトのブログページに遷移する代わりに表示するURL。 [ Default = empty ]';

$messages['error_invalid_blog_name'] = 'ブログ名称が正しくありません。';

/* strings for /default/ templates */


$messages['help_forbidden_blognames'] = 'ブログ名称として使用できない単語をスペースで区切って入力してください。 [ Default = (empty) ]';

$messages['posts_updated_ok'] = '%s 個の投稿が更新されました。';
$messages['error_updating_post2'] = '投稿ID「 %s 」の更新に失敗しました。';
$messages['resources_updated_ok'] = '% 個のリソースが更新されました。';
$messages['error_updating_resource2'] = 'リソースID「 %s 」の更新に失敗しました。';
$messages['albums_updated_ok'] = '%s 個のアルバムを更新しました。';
$messages['error_updating_album2'] = 'アルバムID「 %s 」の更新に失敗しました。';
$messages['links_updated_ok'] = '%s 個のリンクを更新しました。';
$messages['error_updating_link2'] = 'リンクID「 %s 」の更新に失敗しました。';

$messages['version'] = 'バージョン';

$messages['error_resources_disabled'] = 'このサイトでは新しいリソースをアップロードできません。';
$messages['help_login_admin_panel'] = 'ブログ名称をクリックして管理画面に進んでください。';

$messages['blog_updated_ok'] = 'ブログ「 %s 」を更新しました。';
$messages['blogs_updated_ok'] = '%s 個のブログを更新しました。';
$messages['error_updating_blog2'] = 'ブログID「 %s 」の更新に失敗しました。';
$messages['error_updating_blog'] = 'ブログ「 %s 」の更新に失敗しました。';

// TODO: this string was already used above, change it, and fix all locales
//$messages['error_updating_user'] = 'There was an error updating user "%s".';
$messages['user_updated_ok'] = 'ユーザ「 %s 」を更新しました。';
$messages['users_updated_ok'] = '%s 個のユーザを更新しました。';
$messages['eror_updating_user2'] = 'ユーザID「 %s 」の更新に失敗しました。';

$messages['error_select_status'] = '正しいステータスを選択してください。';
$messages['error_invalid_blog_name'] = 'ブログネームが正しくありません。';

$messages['help_resources_naming_rule'] = 'アップロードされたリソースの命名規則。 \'元のファイル名\' はアップロードされたファイル名をそのまま使用します。 \'エンコードしたファイル名\' は元のファイル名をエンコードして使用します。命名規則は [BlogId]-[ResourceId].[Ext] となります。システムをマルチバイトのWindowsServerで動かしている場合は、\'エンコードしたファイル名\' を使用してください。<strong>NOTE: ユーザがファイルをアップロードした後は個の設定を変更しないでください。変更前のファイルにはアクセスできなくなります。</strong> [Default = 元のファイル名]';
$messages['original_file_name'] = '元のファイル名';
$messages['encoded_file_name'] = 'エンコードしたファイル名';

$messages['quick_permission_selection'] = 'かんたん権限選択';
$messages['basic_blog_permission'] = '投稿、リンク、リソースの追加、変更、削除を許可する';
$messages['full_blog_permission'] = 'ブログ所有者として全ての機能を許可する';

$messages['error_template_exist'] = 'テンプレートのアップロードに失敗しました。テンプレート 「 %s 」は既に存在しています。';

/// new strings in LT 1.2.2 ///
$messages['posted_by_help'] = '記事の所有者を選択';
$messages['insert_player'] = 'Insert Player';

/// new strings in LT 1.2.3 ///
$messages['help_allow_javascript_blocks_in_posts'] = '&lt;script&gt; タグによるJavascriptの挿入を許可する。これはセキュリティリスクを伴うことをご注意ください。 [ Default = No ]';

$messages['Versions'] = 'バージョン一覧';
$messages['incorrect_file_version_error'] = '以下のファイルはコンテンツに一致しません:';
$messages['lifetype_version'] = 'LifeType';
$messages['lifetype_version_help'] = '現在インストールされているLifeTypeのバージョンは:';
$messages['file_version_check'] = 'ファイルバージョンのチェック';
$messages['file_version_check_help'] = 'This will perform a basic check on most of LifeType\'s core files, in order to ensure that the current version of the files matches the expected contents according to the installed version. If you have not performed any customizations or changes,
all files should match the expected version. Please be patient, this process may take a while.';
$messages['check'] = 'チェック';
$messages['all_files_ok'] = '全てのファイルは正常です。';

/// new strings for LT 1.2.4 ///
$messages['plugin_latest_version'] = '利用可能な最新のバージョン: ';
$messages['check_versions'] = 'バージョンチェック';
$messages['lt_version_ok'] = 'LifeTypeの現在のバージョンは最新です。';
$messages['lt_version_error'] = 'LifeTYpeの最新バージョンは: ';
$messages['release_notes'] = 'リリースノート';

$messages['kb'] = 'Kb';
$messages['mb'] = 'Mb';
$messages['gb'] = 'Gb';
$messages['edit'] = '編集';

/// new strings for LT 1.2.5 ///
$messages['bookmark_this_filter'] = 'このフィルターをブックマークする';
$messages['help_trim_whitespace_output'] = '出力されたHTMLから不要なスペースを取り除く。ページ容量を40%小さくすることができます。パフォーマンスを気にしない限りこの設定は有効にしておいたほうがいいでしょう。 [ Default = Yes ]';
$messages['help_notify_new_blogs'] = 'このサイトでブログが作成されたら毎回サイト管理者に通知する';
$messages['new_blog_admin_notification_text'] = 'This is LifeType\'s automatic notification system.

新しいブログ "%1$s" (%2$s) が作成されました。

それでは！
';
?>
