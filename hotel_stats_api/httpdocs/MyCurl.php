<?php
class MyCurl
{
  const MAX_TRIES = 15;
  const SECONDS_BETWEEN_TRIES = 0.5;

  private function initCurl($options)
  {
    $curl = curl_init();
    curl_setopt_array($curl, $options);
    return $curl;
  }

  public function getData($options)
  {
    $curl = $this->initCurl($options);

    if ($curl) {
      $tries = 0;
      do {
        $tries++;

        $error = null;
        $data = curl_exec($curl);

        $response_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        $curl_errno = curl_errno($curl);
        $curl_error = curl_error($curl);

        if ($curl_errno) {
          $error = "cURL error ($curl_errno): $curl_error";
        }

        if ($response_code === 200) break;

        if ($tries >= self::MAX_TRIES) {
          $error = "Last error: $error";
          break;
        };

        sleep(self::SECONDS_BETWEEN_TRIES);
      } while (true);

      curl_close($curl);
    }

    $response = array('error' => $error, 'data' => json_decode($data, true));

    return $response;
  }
}
