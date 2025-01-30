<?php

namespace php_utilities\Utilities;

class NameUtility
{
    protected string $first = "";
    protected string $middle = "";
    protected string $last = "";
    protected string $prefix = "";
    protected string $suffix = "";
    protected array $name_codes = [
        'p' => 'prefix',
        'f' => 'first',
        'm' => 'middle',
        'l' => 'last',
        's' => 'suffix',
    ];

    /**
     * initialize class
     * 
     * @param array $name
     * 
     */
    public function __construct(array $names)
    {
        foreach($this->name_codes as $code => $full_code)
        {
            $this->{$full_code} = $names[$code] ?? $names[$full_code] ?? "";
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                                  Accessors                                 */
    /* -------------------------------------------------------------------------- */

    /**
     * @return string $prefix property
     */
    public function get_prefix():string
    {
        return $this->prefix;
    }

    /**
     * @return string $first property
     */
    public function get_first():string
    {
        return $this->first;
    }

    /**
     * @return string $middle property
     */
    public function get_middle():string
    {
        return $this->middle;
    }

    /**
     * @return string $last property
     */
    public function get_last():string
    {
        return $this->last;
    }

    /**
     * @return string $suffix property
     */
    public function get_suffix():string
    {
        return $this->suffix;
    }

    /**
     * @return array $name_codes property
     */
    public function get_name_codes():array
    {
        return $this->name_codes;
    }

    /* -------------------------------------------------------------------------- */
    /*                              End of Accessors                              */
    /* -------------------------------------------------------------------------- */

    /**
     * format name based on provided format
     * 
     * @param string $format
     * @param bool $trim
     * 
     * @return string
     */
    public function format($format = "p f m l s", bool $trim = TRUE): string
    {
        //get list of characters
        $characters = mb_str_split(strtolower($format));
        $name = "";

        foreach($characters as $key => $char)
        {
            $name .= $this->{$this->name_codes[$char]} ?? $char;
        }

        return $trim ? trim($name) : $name;
    }



}