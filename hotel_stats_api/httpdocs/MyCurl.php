<?php
class MyCurl
{
  private $curl;
  const MAX_TRIES = 10;
  const SECONDS_BETWEEN_TRIES = 0.5;

  function __construct($request_url, $options)
  {
    $this->initCurl($request_url, $options);
  }

  private function initCurl($request_url, $options)
  {
    $this->curl = curl_init($request_url);
    curl_setopt_array($this->curl, $options);
  }

  public function getData()
  {
    $error = 'Curl session has not been initialized';
    $data = null;

    if (isset($this->curl)) {
      $tries = 0;
      do {
        $tries++;
        $error = null;
        $data = json_decode(curl_exec($this->curl));
        $response_code = curl_getinfo($this->curl, CURLINFO_RESPONSE_CODE);

        if ($response_code === 200) break;

        $error = "The server responded with code $response_code";

        if ($tries >= self::MAX_TRIES) {
          $error = 'Error loading data';
          break;
        };

        sleep(self::SECONDS_BETWEEN_TRIES);
      } while (true);

      curl_close($this->curl);
    }

    $response = array('error' => $error, 'data' => $data);

    return $response;
  }
}
