<?php

namespace php_utilities\Utilities;
use \DateTime;

/**
 * Simple DateTime Wrapper class
 */
class DateUtility
{
    protected string $date;
    protected DateTime $dateTime;
    protected string $date_format;

    /**
     * initialize class
     * 
     * @param ?string (optional) $date string of date to manipulate
     * @param string (optional) $date_format string format of give date (e.g. "Y-m-d", "d-m-Y", "Y-m-d")
     */
    public function __construct(?string $date = NULL, string $date_format = "Y-m-d")
    {
        $this->date_format = $date_format;

        if(isset($date))
        {
            $this->date = $date;
            $this->dateTime = DateTime::createFromFormat($this->date_format, $date);
        }
        else
        {
            $this->dateTime = new DateTime();
            $this->date = $this->dateTime->format($this->date_format);
        }
    }

    /****************
        Accessors
    ****************/

    /**
     * @return string $date property
     */
    public function get_date(): string
    {
        return $this->date;
    }

    /**
     * @return DateTime $dateTime property
     */
    public function get_dateTime(): DateTime
    {
        return $this->dateTime;
    }

    /****************
        End of
        Accessors
    ****************/

    /**
     * return formatted date
     * 
     * @param string $date_format
     * 
     * @return string 
     */
    public function format(string $date_format = "Y-m-d"): string
    {
        return $this->dateTime->format($date_format);
    }

    



}
