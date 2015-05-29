<?php
namespace nikosglikis\ModStatusParser;
/**
 * Class ModStatusUtilities
 * All helper functions needed for the mod_status parser to work.
 *
 * @package nikosglikis\mod_status_parser
 */
class ModStatusUtilities
{
    /**
     * Downloads the url and returns contents.
     * @param $url - The url to download
     * @throws \Exception
     * @return String - The url contents.
     */
    public static function getUrlContents($url)
    {
        if (ModStatusUtilities::isCurlInstalled())
        {
            return ModStatusUtilities::getUrlContentsCurl($url);
        }
        else if( ini_get('allow_url_fopen') )
        {
            return file_get_contents($url);
        }
        else
        {
            if (exec('which curl'))
            {
                $output = `curl $url`;
                return $output;
            } else if (exec('which wget'))
            {

                $output = `wget -qO- $url`;
                return $output;
            }
            else
            {
                throw new \Exception("Cannot download file, no php-curl, Curl or WGET is installed, and allo_url_fopen is false.");
            }
        }
    }

    /**
     * Returns the string between 2 other strings.
     *
     * @param $string - Haystack
     * @param $start - $from
     * @param $end - $to
     * @return string|boolean False in case of error.
     */
    public static function getStringBetween($string, $start, $end)
    {
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }

    /**
     * Checks if Php Curl is installed.
     *
     * @return bool - True if curl is installed, false if not.
     */
    function isCurlInstalled()
    {
        return function_exists('curl_version');
    }

    function getUrlContentsCurl($url)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}

?>