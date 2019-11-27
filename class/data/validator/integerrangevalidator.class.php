<?php

	lt_include( PLOG_CLASS_PATH."class/data/validator/validator.class.php" );

    /**
     * \ingroup Validator
     *
     * Checks that the value is an integer and between a certain range
     *
     * @see IntRangeRule
     */
    class IntegerRangeValidator extends Validator 
    {
		/**
		 * Constructor.
		 *
		 * @param signed Whether to allow signed integers or not. For compatibility reasons,
		 * signed integers are not allowed by default.
		 */
    	function IntegerRangeValidator( $minValue, $maxValue )
        {
        	$this->Validator();
        	
            lt_include( PLOG_CLASS_PATH."class/data/validator/rules/intrangerule.class.php" );
            $this->addRule( new IntRangeRule($minValue, $maxValue));
        }
    }
?>