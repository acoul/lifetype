<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/locale/ltlocales.class.php" );
	lt_include( PLOG_CLASS_PATH."class/locale/ltlocale.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/timestamp.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test cases for the LTLocale class.
	 */
	class LTLocale_Test extends LifeTypeTestCase
	{
		var $l;
		
		function setUp()
		{
			// let's use the English locale as the base one
			$this->l = new LTLocale( "en_UK" );
		}
		
		/**
		 * test all the modifiers from the LTLocale::formatDate() method:
		 *
		 * <li>%a abbreviated weekday</li>
		 * <li>%A	complete weekday</li>
		 * <li>%b	abbreviated month</li>
		 * <li>%B	long month</li>
		 * <li>%d	day of the month, 2 digits with leading zero</li>
         * <li>%j   day of the month, numeric (without leading zero)</li>
		 * <li>%H	hours, in 24-h format</li>
		 * <li>%I	hours, in 12-h format (without leading zero)</li>
		 * <li>%p   returns 'am' or 'pm'</li>
		 * <li>%P   returns 'AM' or 'PM'</li>
		 * <li>%M	minutes</li>
		 * <li>%m	month number, from 00 to 12</li>
		 * <li>%S	seconds</li>
		 * <li>%y	2-digit year representation</li>
		 * <li>%Y	4-digit year representation</li>
		 * <li>%O   Difference to Greenwich time (GMT) in hours</li>
		 * <li>%%	the '%' character
         * </ul>
         * (these have been added by myself and are therefore incompatible with php)<ul>
         * <li>%T	"_day_ of _month_", where the day is in ordinal form and 'month' is the name of the month</li>
         * <li>%D	cardinal representation of the day</li>		
		 */
		function testFormatDate()
		{
			$d = new Timestamp( "20070205230000" );			
			
			$this->assertEquals( "Mon", $this->l->formatDate( $d, "%a" ));
			$this->assertEquals( "Monday", $this->l->formatDate( $d, "%A" ));
			$this->assertEquals( "Feb", $this->l->formatDate( $d, "%b" ));
			$this->assertEquals( "February", $this->l->formatDate( $d, "%B" ));
			$this->assertEquals( "05", $this->l->formatDate( $d, "%d" ));
			$this->assertEquals( "5", $this->l->formatDate( $d, "%j" ));
			$this->assertEquals( "23", $this->l->formatDate( $d, "%H" ));
			$this->assertEquals( "11", $this->l->formatDate( $d, "%I" ));
			$this->assertEquals( "pm", $this->l->formatDate( $d, "%p" ));			
			$this->assertEquals( "PM", $this->l->formatDate( $d, "%P" ));						
			$this->assertEquals( "00", $this->l->formatDate( $d, "%M" ));			
			$this->assertEquals( "02", $this->l->formatDate( $d, "%m" ));
			$this->assertEquals( "00", $this->l->formatDate( $d, "%S" ));
			$this->assertEquals( "07", $this->l->formatDate( $d, "%y" ));			
			$this->assertEquals( "2007", $this->l->formatDate( $d, "%Y" ));
			$this->assertEquals( "%", $this->l->formatDate( $d, "%%" ));
			$this->assertEquals( "5th of February", $this->l->formatDate( $d, "%T" ));			
			$this->assertEquals( "5th", $this->l->formatDate( $d, "%D" ));						
			
			// a longer format test
			$this->assertEquals( "Feb ", $this->l->formatDate( $d, "%b " ));
			$this->assertEquals( "Feb 5", $this->l->formatDate( $d, "%b %j" ));
			$this->assertEquals( "05/02/2007", $this->l->formatDate( $d, "%d/%m/%Y" ));
			$this->assertEquals( "05 February, 2007 23:00", $this->l->formatDate( $d, "%d %B, %Y %H:%M" ));
		}
		
		/**
		 * Tests that the LTLocale::testFormatDateGMT() method also behaves
		 * as expected during daylight savings time
		 */
		function testFormatDateGMT_DST()
		{
			$d = new Timestamp( "20070605180000" );
			
			$diff = $this->l->formatDate( $d, "%O" );
            $diff = $diff / 100;

			$this->assertEquals( "Tue", $this->l->formatDateGMT( $d, "%a" ));
			$this->assertEquals( "Tuesday", $this->l->formatDateGMT( $d, "%A" ));
			$this->assertEquals( "Jun", $this->l->formatDateGMT( $d, "%b" ));
			$this->assertEquals( "June", $this->l->formatDateGMT( $d, "%B" ));
			$this->assertEquals( "05", $this->l->formatDateGMT( $d, "%d" ));
			$this->assertEquals( "5", $this->l->formatDateGMT( $d, "%j" ));
			$this->assertEquals( 18-$diff, $this->l->formatDateGMT( $d, "%H" ));
			$this->assertEquals( (18-$diff)%12, $this->l->formatDateGMT( $d, "%I" ));
			$this->assertEquals( "pm", $this->l->formatDateGMT( $d, "%p" ));			
			$this->assertEquals( "PM", $this->l->formatDateGMT( $d, "%P" ));						
			$this->assertEquals( "00", $this->l->formatDateGMT( $d, "%M" ));			
			$this->assertEquals( "06", $this->l->formatDateGMT( $d, "%m" ));
			$this->assertEquals( "00", $this->l->formatDateGMT( $d, "%S" ));
			$this->assertEquals( "07", $this->l->formatDateGMT( $d, "%y" ));			
			$this->assertEquals( "2007", $this->l->formatDateGMT( $d, "%Y" ));
			$this->assertEquals( "%", $this->l->formatDateGMT( $d, "%%" ));
			$this->assertEquals( "5th of June", $this->l->formatDateGMT( $d, "%T" ));			
			$this->assertEquals( "5th", $this->l->formatDateGMT( $d, "%D" ));	
			
			// a longer format test
			$this->assertEquals( "Jun ", $this->l->formatDateGMT( $d, "%b " ));
			$this->assertEquals( "Jun 5", $this->l->formatDateGMT( $d, "%b %j" ));
			$this->assertEquals( "05/06/2007", $this->l->formatDateGMT( $d, "%d/%m/%Y" ));
			$this->assertEquals( "05 June, 2007 ".(18-$diff).":00", $this->l->formatDateGMT( $d, "%d %B, %Y %H:%M" ));								
		}		

		
		/**
		 * Tests that the LTLocale::testFormatDateGMT() method also behaves
		 * as expected
		 */
		function testFormatDateGMT()
		{
			$d = new Timestamp( "20070205120000" );
			
			$diff = $this->l->formatDate( $d, "%O" );
            $diff = $diff / 100;

			$this->assertEquals( "Mon", $this->l->formatDateGMT( $d, "%a" ));
			$this->assertEquals( "Monday", $this->l->formatDateGMT( $d, "%A" ));
			$this->assertEquals( "Feb", $this->l->formatDateGMT( $d, "%b" ));
			$this->assertEquals( "February", $this->l->formatDateGMT( $d, "%B" ));
			$this->assertEquals( "05", $this->l->formatDateGMT( $d, "%d" ));
			$this->assertEquals( "5", $this->l->formatDateGMT( $d, "%j" ));
			$this->assertEquals( 12-$diff, $this->l->formatDateGMT( $d, "%H" ));
			$this->assertEquals( (12-$diff)%12, $this->l->formatDateGMT( $d, "%I" ));
			$this->assertEquals( "pm", $this->l->formatDateGMT( $d, "%p" ));			
			$this->assertEquals( "PM", $this->l->formatDateGMT( $d, "%P" ));						
			$this->assertEquals( "00", $this->l->formatDateGMT( $d, "%M" ));			
			$this->assertEquals( "02", $this->l->formatDateGMT( $d, "%m" ));
			$this->assertEquals( "00", $this->l->formatDateGMT( $d, "%S" ));
			$this->assertEquals( "07", $this->l->formatDateGMT( $d, "%y" ));			
			$this->assertEquals( "2007", $this->l->formatDateGMT( $d, "%Y" ));
			$this->assertEquals( "%", $this->l->formatDateGMT( $d, "%%" ));
			$this->assertEquals( "5th of February", $this->l->formatDateGMT( $d, "%T" ));			
			$this->assertEquals( "5th", $this->l->formatDateGMT( $d, "%D" ));	
			
			// a longer format test
			$this->assertEquals( "Feb ", $this->l->formatDateGMT( $d, "%b " ));
			$this->assertEquals( "Feb 5", $this->l->formatDateGMT( $d, "%b %j" ));
			$this->assertEquals( "05/02/2007", $this->l->formatDateGMT( $d, "%d/%m/%Y" ));
			$this->assertEquals( "05 February, 2007 ".(12-$diff).":00", $this->l->formatDateGMT( $d, "%d %B, %Y %H:%M" ));								
		}		

    }
?>