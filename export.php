<?php

/*%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

Lifetype JSON Export

Create a JSON representation of all of the blog posts inside a lifetype
blog, for backups or import to another blog engine.

A quick PHP script that, using the LifeType API, exports your post data in 
a JSON format.

This script can be placed in the LifeType root directory.

Simply drop this script into your LifeType folder, and visit it in a web 
browser or via curl/wget.

https://github.com/lo-windigo/lifetype-export
https://github.com/acoul/lifetype

-------------------------------------------------------------------------------

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%*/

// Configuration values: make any changes here!
define('EXPORT_BLOG_ID', 1);


// NO CHANGES SHOULD BE NECESSARY PAST THIS POINT!
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
if (!defined( "PLOG_CLASS_PATH" )) {
	define( "PLOG_CLASS_PATH", dirname(__FILE__)."/");
}

include 'class/object/loader.class.php';
include 'class/dao/articles.class.php';


function FormatCategory($categoryObject) {
	/*
	 * Format a single category's data for JSON export
	 */
	return $categoryObject->getName();
}


function FormatComment($commentObject) {
	/*
	 * Format a single comment's data for JSON export
	 */
	$comment = array();

	$comment['id'] = $commentObject->getId();
	$comment['title'] = $commentObject->getTopic();
	$comment['name'] = $commentObject->getUserName();
	$comment['url'] = $commentObject->getUserUrl();
	$comment['email'] = $commentObject->getUserEmail();
	$comment['date'] = $commentObject->getDate();
	$comment['text'] = $commentObject->getText();

	return $comment;
}


function FormatArticle($articleObject) {
	/*
	 * Format a single article's data for JSON export
	 */
	$article = array();

	$article['id'] = $articleObject->getId();
	$article['title'] = $articleObject->getTopic();
	$article['body'] = $articleObject->getText();
	$article['date'] = $articleObject->getDate();
	$article['categories'] = array_map('FormatCategory', $articleObject->getCategories());
	$article['comments'] = array_map('FormatComment', $articleObject->getComments());

	return $article;
}


// Get a collection of all published blog posts
// (For ALL posts, you need to specify POST_STATUS_ALL)
$articlesObject = new Articles();
$articles = array_map('FormatArticle', $articlesObject->getBlogArticles(EXPORT_BLOG_ID));
echo json_encode($articles);

?>
