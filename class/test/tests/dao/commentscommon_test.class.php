<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/test/helpers/testtools.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/dao/bloginfo.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/blogs.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/article.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/commentscommon.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/usercomment.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/trackbacks.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/users.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/userinfo.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/articles.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/articlecomments.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/timestamp.class.php" );
	lt_include( PLOG_CLASS_PATH."class/template/cachecontrol.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test cases for the CommentsCommon class
	 */
	class CommentsCommon_Test extends LifeTypeTestCase
	{
        function setUp(){
			// create the scenario
			$this->user = TestTools::createUser();
			$this->blog = TestTools::createBlog( $this->user->getId());
			$this->cat  = TestTools::createArticleCategory( $this->blog->getId());
			$this->article = TestTools::createArticle( $this->blog->getId(), $this->user->getId(),
                                                       Array( $this->cat->getId()));
        }

        function tearDown(){
			// destroy the test data
			TestTools::deleteDaoTestData(Array($this->article, $this->cat, $this->user));
			TestTools::deleteBlog($this->blog);
        }

        
        function testGetNumPostComments()
		{


            // Add comments
            $timestamp = new Timestamp();
            $comment1 = new UserComment($this->article->getId(),
                                        $this->article->getBlogId(),
                                        0, // dummy parent
                                        "dummy topic",
                                        "dummy text",
                                        $timestamp->getTimestamp());
            
            $timestamp = new Timestamp();
            $comment2 = new UserComment($this->article->getId(),
                                        $this->article->getBlogId(),
                                        0, // dummy parent
                                        "dummy topic 2",
                                        "dummy text 2",
                                        $timestamp->getTimestamp());

            $timestamp = new Timestamp();
            $comment3 = new UserComment($this->article->getId(),
                                        $this->article->getBlogId(),
                                        0, // dummy parent
                                        "dummy topic 2",
                                        "spam",
                                        $timestamp->getTimestamp(),
                                        "username",
                                        "",
                                        "",
                                        "0.0.0.0",
                                        0,
                                        COMMENT_STATUS_SPAM);

                // add trackbacks
            $timestamp = new Timestamp();
            $trackback1 = new Trackback("fake url",
                                        "this is a title",
                                        $this->article->getId(),
                                        $this->article->getBlogId(),
                                        "excerpt from my blog",
                                        "my blog name",
                                        $timestamp->getTimestamp(),
                                        "0.0.0.0");

            $timestamp = new Timestamp();
            $trackback2 = new Trackback("fake url 2",
                                        "this is a title",
                                        $this->article->getId(),
                                        $this->article->getBlogId(),
                                        "excerpt from my blog",
                                        "my blog name",
                                        $timestamp->getTimestamp(),
                                        "0.0.0.0",
                                        0,
                                        COMMENT_STATUS_SPAM);
            $timestamp = new Timestamp();
            $trackback3 = new Trackback("fake url 3",
                                        "this is a title",
                                        $this->article->getId(),
                                        $this->article->getBlogId(),
                                        "excerpt from my blog",
                                        "my blog name",
                                        $timestamp->getTimestamp(),
                                        "0.0.0.0",
                                        0,
                                        COMMENT_STATUS_SPAM);
            $timestamp = new Timestamp();
            $trackback4 = new Trackback("fake url 4",
                                        "this is a title",
                                        $this->article->getId(),
                                        $this->article->getBlogId(),
                                        "excerpt from my blog",
                                        "my blog name",
                                        $timestamp->getTimestamp(),
                                        "0.0.0.0",
                                        0,
                                        COMMENT_STATUS_SPAM);


            $comments = new CommentsCommon();
            $this->assertTrue($comments->addComment($comment1), "Couldn't add test comment 1");
            $this->assertTrue($comments->addComment($comment2), "Couldn't add test comment 2");
            $this->assertTrue($comments->addComment($comment3), "Couldn't add test comment 3");
            $this->assertTrue($comments->addComment($trackback1), "Couldn't add test trackback 1");
            $this->assertTrue($comments->addComment($trackback2), "Couldn't add test trackback 2");
            $this->assertTrue($comments->addComment($trackback3), "Couldn't add test trackback 3");
            $this->assertTrue($comments->addComment($trackback4), "Couldn't add test trackback 4");
            
            $num = $comments->getNumPostComments($this->article->getId(), COMMENT_STATUS_ALL, COMMENT_TYPE_ANY);
            $this->assertTrue($num == 7, "Wrong number of comments/trackbacks (all) ". $num);
            $num = $comments->getNumPostComments($this->article->getId(), COMMENT_STATUS_NONSPAM, COMMENT_TYPE_ANY);
            $this->assertTrue($num == 3, "Wrong number of comments/trackbacks (nonspam) ". $num);
            $num = $comments->getNumPostComments($this->article->getId(), COMMENT_STATUS_SPAM, COMMENT_TYPE_ANY);
            $this->assertTrue($num == 4, "Wrong number of comments/trackbacks (spam) ". $num);

            $num = $comments->getNumPostComments($this->article->getId(), COMMENT_STATUS_ALL, COMMENT_TYPE_COMMENT);
            $this->assertTrue($num == 3, "Wrong number of comments (all) ". $num);
            $num = $comments->getNumPostComments($this->article->getId(), COMMENT_STATUS_NONSPAM, COMMENT_TYPE_COMMENT);
            $this->assertTrue($num == 2, "Wrong number of comments (nonspam) ". $num);
            $num = $comments->getNumPostComments($this->article->getId(), COMMENT_STATUS_SPAM, COMMENT_TYPE_COMMENT);
            $this->assertTrue($num == 1, "Wrong number of comments (spam) ". $num);

            $num = $comments->getNumPostComments($this->article->getId(), COMMENT_STATUS_ALL, COMMENT_TYPE_TRACKBACK);
            $this->assertTrue($num == 4, "Wrong number of trackbacks (all) ". $num);
            $num = $comments->getNumPostComments($this->article->getId(), COMMENT_STATUS_NONSPAM, COMMENT_TYPE_TRACKBACK);
            $this->assertTrue($num == 1, "Wrong number of trackbacks (nonspam) ". $num);
            $num = $comments->getNumPostComments($this->article->getId(), COMMENT_STATUS_SPAM, COMMENT_TYPE_TRACKBACK);
            $this->assertTrue($num == 3, "Wrong number of trackbacks (spam) ". $num);

            
                // delete the temporary data
			TestTools::deleteDaoTestData(Array($comment1, $comment2, $comment3,
                                               $trackback1, $trackback2, $trackback3, $trackback4));
		}
		
		/**
		 * Test case for mantis bug http://bugs.lifetype.net/view.php?id=1144
		 *
		 * Dates with time offset being saved to the database
		 */
		function testUpdateCommentWithTimeOffsets()
		{
			// update the time offset settings for the blog
			$this->blog->setValue( "time_offset", "+3" );
			$blogs = new Blogs();
			$blogs->updateBlog($this->blog);
			
			// create the comment and save it to the database
			$comment = new UserComment( $this->article->getId(),
                                        $this->blog->getId(),
                                        0, "test comment", "test comment body" );
			$comments = new ArticleComments();
			$comments->addComment( $comment );
			
			// now get the time
			$origTime = $comment->getTimestamp();
			
			// update the comment and reload the comment
			$comments->updateComment( $comment );
			$comment2 = $comments->getComment( $comment->getId());
			$newTime = $comment2->getTimestamp();
			
			// check that dates are the same
			$this->assertEquals( $origTime->getTimestamp(), $newTime->getTimestamp(), "Comment times are not the same!" );
			
			// destroy the test data
			TestTools::deleteDaoTestData(Array($comment, $comment2));
		}
	}
?>


