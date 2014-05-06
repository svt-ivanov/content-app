<?php
namespace model;

/**
 * Class 'Content' intended to be
 * a model for fetching the necessary
 * data from Yahoo Content-Analysis API.
 */
class Content
{
    private $characters = array("'", "?", "\\");
    private $replacements = array(" ", " ", " ");
    private $data;

    private function curlWrapper($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($ch);

        if (empty($response)) {
            curl_close($ch);
            return array();
        } else {
            $headers = curl_getinfo($ch);
            curl_close($ch);
            if ($headers['http_code'] != 200) {
                return array();
            }

            return $response;
        }
    }

    private function parseResponse($response)
    {
        $term_data = array();
        $dummy = array();

        $response = json_decode($response);
        foreach ($response->query as $record) {
            if ( is_object($record)) {

                foreach ($record->entities as $entity) {
                    $dummy[] = $entity;
                }
            }
        }

        foreach ($dummy as $unit) {
            if (is_array($unit)) {
                foreach ($unit as $value) {
                    $term_data[] = $value;
                }
                
            } else {
                $term_data[] = $unit;
            }
        }

        return $term_data;
    }

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param String $format
     * @return Array $data
     */
    public function getTerms($format='json')
    {
        $text = $this->data['content'];
        $text = str_replace($this->characters, $this->replacements, $text);

        $url = 'http://query.yahooapis.com/v1/public/yql';
        $query = "select * from contentanalysis.analyze where text = '".$text."'";

        $yql_url = $url . "?q=" . urlencode($query);
        $yql_url .= "&format=" . $format;
        $yql_url .= "&diagnostics=false";   

        $response = $this->curlWrapper($yql_url);
        return $this->parseResponse($response);
    }
}