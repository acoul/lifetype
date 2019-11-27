<?php

// set this to the encoding that should be used to display the pages correctly
$messages['encoding'] = 'UTF-8';
$messages['locale_description'] = 'Japanese locale file for LifeType';
// locale format, see LTLocale::formatDate for more information
$messages['date_format'] = '%Y/%m/%d %H:%M';

// days of the week
$messages['days'] = Array( '日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日' );
// -- compatibility, do not touch -- //
$messages['Monday'] = $messages['days'][1];
$messages['Tuesday'] = $messages['days'][2];
$messages['Wednesday'] = $messages['days'][3];
$messages['Thursday'] = $messages['days'][4];
$messages['Friday'] = $messages['days'][5];
$messages['Saturday'] = $messages['days'][6];
$messages['Sunday'] = $messages['days'][0];

// abbreviations
$messages['daysshort'] = Array( '日', '月', '火', '水', '木', '金', '土' );
// -- compatibility, do not touch -- //
$messages['Mo'] = $messages['daysshort'][1];
$messages['Tu'] = $messages['daysshort'][2];
$messages['We'] = $messages['daysshort'][3];
$messages['Th'] = $messages['daysshort'][4];
$messages['Fr'] = $messages['daysshort'][5];
$messages['Sa'] = $messages['daysshort'][6];
$messages['Su'] = $messages['daysshort'][0];

// months of the year
$messages['months'] = Array( '1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月' );
// -- compatibility, do not touch -- //
$messages['January'] = $messages['months'][0];
$messages['February'] = $messages['months'][1];
$messages['March'] = $messages['months'][2];
$messages['April'] = $messages['months'][3];
$messages['May'] = $messages['months'][4];
$messages['June'] = $messages['months'][5];
$messages['July'] = $messages['months'][6];
$messages['August'] = $messages['months'][7];
$messages['September'] = $messages['months'][8];
$messages['October'] = $messages['months'][9];
$messages['November'] = $messages['months'][10];
$messages['December'] = $messages['months'][11];
$messages['message'] = 'メッセージ';
$messages['error'] = 'エラー';
$messages['date'] = '日付';

// miscellaneous texts
$messages['of'] = 'の';
$messages['recently'] = '最近の投稿...';
$messages['comments'] = 'コメント';
$messages['comment on this'] = 'コメント';
$messages['my_links'] = 'リンク集';
$messages['archives'] = '過去の投稿';
$messages['search'] = '検索';
$messages['calendar'] = 'カレンダー';
$messages['search_s'] = '検索';
$messages['search_this_blog'] = 'このブログを検索:';
$messages['about_myself'] = 'プロフィール';
$messages['permalink_title'] = 'この記事へのパーマリンク';
$messages['permalink'] = 'パーマリンク';
$messages['posted_by'] = '投稿者';
$messages['reply_string'] = 'Re: ';
$messages['reply'] = '返信';
$messages['category'] = 'カテゴリ';

// add comment form
$messages['add_comment'] = 'コメントを書く';
$messages['comment_topic'] = 'タイトル';
$messages['comment_text'] = '本文';
$messages['comment_username'] = 'お名前';
$messages['comment_email'] = 'メールアドレス(任意)';
$messages['comment_url'] = 'ホームページURL(任意)';
$messages['comment_send'] = '送信';
$messages['comment_added'] = 'コメントを追加しました!';
$messages['comment_add_error'] = 'コメントの追加に失敗しました。';
$messages['article_does_not_exist'] = '記事が存在しませんでした。';
$messages['no_posts_found'] = '記事が見つかりません。';
$messages['user_has_no_posts_yet'] = 'このユーザはまだ投稿していません。';
$messages['back'] = '戻る';
$messages['post'] = '投稿';
$messages['trackbacks_for_article'] = '記事のトラックバック: ';
$messages['trackback_excerpt'] = '抜粋';
$messages['trackback_weblog'] = 'Weblog';
$messages['search_results'] = '検索結果';
$messages['search_matching_results'] = '以下の投稿がヒットしました: ';
$messages['search_no_matching_posts'] = '1件もヒットしませんでした。';
$messages['read_more'] = '(もっと読む)';
$messages['syndicate'] = 'フィード';
$messages['main'] = 'メイン';
$messages['about'] = 'About';
$messages['download'] = 'ダウンロード';
$messages['error_incorrect_email_address'] = 'メールアドレスが正しくありません。';
$messages['invalid_url'] = '入力されたURLが正しくありません。訂正して再度実行してください。';

////// error messages /////
$messages['error_fetching_article'] = '指定された記事が見つかりません。';
$messages['error_fetching_articles'] = 'このカテゴリには記事が1つもありません。';
$messages['error_fetching_category'] = '指定されたカテゴリが見つかりません。';
$messages['error_trackback_no_trackback'] = 'この記事に対するトラックバックはありません。';
$messages['error_incorrect_article_id'] = '記事IDが間違っています。';
$messages['error_incorrect_blog_id'] = 'ブログIDが間違っています。';
$messages['error_comment_without_text'] = '何かコメントを入力してください。';
$messages['error_comment_without_name'] = '名前もしくはニックネームを入力してください。';
$messages['error_adding_comment'] = 'コメントの追加に失敗しました。';
$messages['error_incorrect_parameter'] = 'パラメータが間違っています。';
$messages['error_parameter_missing'] = 'パラメータが不足しています。';
$messages['error_comments_not_enabled'] = 'このサイトではコメントは無効になっています。';
$messages['error_incorrect_search_terms'] = '検索ワードが正しくありません。';
$messages['error_no_search_results'] = '1件もヒットしませんでした。';
$messages['error_no_albums_defined'] = 'このブログにはアルバムはありません。';
$messages['error_incorrect_category_id'] = 'カテゴリIDが間違っているか、選択されていません。';
$messages['error_fetching_resource'] = '指定されたファイルが見つかりません。';
$messages['error_incorrect_user'] = 'ユーザの指定が間違っています。';

$messages['form_authenticated'] = '認証されました';
$messages['posted_in'] = 'Posted in';

$messages['previous_post'] = '前へ';
$messages['next_post'] = '次へ';
$messages['comment_default_title'] = '(Untitled)';
$messages['guestbook'] = 'ゲストブック';
$messages['trackbacks'] = 'トラックバック';
$messages['menu'] = 'メニュー';
$messages['albums'] = 'アルバム';
$messages['admin'] = '管理';
$messages['links'] = 'リンク';
$messages['categories'] = 'カテゴリ';
$messages['articles'] = '記事';

$messages['num_reads'] = 'PV';
$messages['contact_me'] = 'お問い合わせ';
$messages['required'] = '必須';

$messages['size'] = 'サイズ';
$messages['format'] = '形式';
$messages['dimensions'] = '大きさ';
$messages['bits_per_sample'] = 'Bits per sample';
$messages['sample_rate'] = 'サンプルレート';
$messages['number_of_channels'] = 'チャネル数';
$messages['length'] = '長さ';

/// Strings added in LT 1.2.4 ///
$messages['audio_codec'] = 'Audio codec';
$messages['video_codec'] = 'Video codec';

/// Strings added in LT 1.2.5 ///
$messages['error_rdf_syndication_not_allowed'] = 'エラー: このブログではフィードが無効になっています。';

?>
