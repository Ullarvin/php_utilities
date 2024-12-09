<?php

namespace php_utilities\Utilities;
use DateTime;

/**
 * Simple DateTime Wrapper class
 */
class DateUtility
{
    protected string $date;
    protected DateTime $dateTime;
    protected string $date_format;
    protected string $year;
    protected string $month;
    protected string $day;
    protected array $holiday_names = [
        "New Year's Day" => "new year",
        "Birthday of Martin Luther King, Jr." => "mlk",
        "Washington's Birthday" => "washington",
        "Memorial Day" => "memorial",
        "Juneteenth National Independence Day" => "juneteenth",
        "Independence Day" => "independence",
        "Labor Day" => "labor",
        "Columbus Day" => "columbus",
        "Veterans Day" => "veterans",
        "Thanksgiving Day" => "thanksgiving",
        "Christmas Day" => "christmas",
    ];

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
            $this->date = $this->dateTime->format("Y-m-d H:i:s");
        }

        $this->year = $this->dateTime->format("Y");
        $this->month = $this->dateTime->format("m");
        $this->day = $this->dateTime->format("d");
    }

    
    /* -------------------------------------------------------------------------- */
    /*                                  Accessors                                 */
    /* -------------------------------------------------------------------------- */

    /**
     * @return string $date property
     */
    public function get_date(): string
    {
        return $this->date;
    }

    /**
     * @return string $year property
     */
    public function get_year(): string
    {
        return $this->year;
    }

    /**
     * @return string $month property
     */
    public function get_month(): string
    {
        return $this->month;
    }

    /**
     * @return string $day property
     */
    public function get_day(): string
    {
        return $this->day;
    }

    /**
     * @return DateTime $dateTime property
     */
    public function get_dateTime(): DateTime
    {
        return $this->dateTime;
    }

    /**
     * @return array $holiday_names property
     */
    public function get_holiday_names(): array
    {
        return $this->holiday_names;
    }

    /**
     * @return string $date_format property
     */
    public function get_date_format(): string
    {
        return $this->date_format;
    }

    /* -------------------------------------------------------------------------- */
    /*                              End of Accessors                              */
    /* -------------------------------------------------------------------------- */

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

    /**
     * return difference of current datetime and date provided
     * 
     * @param ?string|DateTime $date
     * @param ?string $format
     * @param string $diff_format
     * 
     * @return string
     */
    public function diff(?string $date = NULL, string $format = "Y-m-d", string $diff_format = "%a" ): string
    {
        if(isset($date))
        {
            if(is_string($date))
            {
                $dateTime = DateTime::createFromFormat($format, $date);    
            }
            else
            {
                $dateTime = $date;
            }
        }
        else
        {
            $dateTime = new DateTime();
        }
        
        $interval = $this->dateTime->diff($dateTime);
        return $interval->format($diff_format);
    }

    /**
     * Determine if provided date is a holiday
     * 
     * @return bool
     */
    public function is_holiday(): bool
    {
        $is_holiday = $this->grab_holiday()['holiday'];
        return $is_holiday;
    }

    /**
     * Get Holiday name
     * 
     * @param bool $full (optional) True for fullname, False for short hand name
     * 
     * @return bool|string
     */
    public function get_holiday_name(bool $full = FALSE): bool|string
    {
        $holiday = $this->grab_holiday();
        $name = FALSE;

        if($full)
        {
            $name = $holiday['fullname'] ?? FALSE;
        }
        else
        {
            $name = $holiday['name'] ?? FALSE;
        }

        return $name;
    }

    /**
     * Get holiday info for current datetime, if current datetime is a holiday
     * 
     * @param array
     */
    public function grab_holiday(): array
    {
        $return_holiday = ['holiday' => FALSE];
        
        foreach($this->holiday_names as $full_name => $name)
        {
            $holiday = self::get_holiday($name, $this->year);
            if($holiday)
            {
                if($this->dateTime->format("Y-m-d") == $holiday->format("Y-m-d"))
                {
                    $return_holiday = ['name' => $name, 'fullname' => $full_name, 'holiday' => TRUE];
                }
            }
        }

        return $return_holiday;
    }

    /**
     * get holiday by year
     * 
     * @param string $holiday
     * @param string $year
     * 
     * @return DateTime|bool
     */
    public static function get_holiday(string $holiday, string $year): DateTime|bool
    {
        $return_holiday = FALSE;
        
        switch(strtolower($holiday))
        {
            case "new year": //New Year's Day
                $return_holiday = new DateTime("first day of january {$year}");
                break;
            case "mlk": //Birthday of Martin Luther King, Jr.
                $return_holiday = new DateTime("third monday of january {$year}");
                break;
            case "washington": //Washington's Birthday
                $return_holiday = new DateTime("third monday of february {$year}");
                break;
            case "memorial": //Memorial Day
                $return_holiday = new DateTime("last monday of may {$year}");
                break;
            case "juneteenth": //Juneteenth National Independence Day
                $return_holiday = new DateTime("june 19 {$year}");
                break;
            case "independence": //Independence Day
                $return_holiday = new DateTime("july 04 {$year}");
                break;
            case "labor": //Labor Day
                $return_holiday = new DateTime("first monday of september {$year}");
                break;
            case "columbus": //Columbus Day
                $return_holiday = new DateTime("second monday of october {$year}");
                break;
            case "veterans": //Veterans Day
                $return_holiday = new DateTime("November 11 {$year}");
                break;
            case "thanksgiving": //Thanksgiving Day
                $return_holiday = new DateTime("fourth thursday of november {$year}");
                break;
            case "christmas": //Christmas Day
                $return_holiday = new DateTime("December 25 {$year}");
                break;
        }

        return $return_holiday;
    }

    



}
