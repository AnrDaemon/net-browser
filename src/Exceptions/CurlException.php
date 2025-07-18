<?php

/** Curl errors wrapper
*
* @version SVN: $Id$
*/

namespace AnrDaemon\Exceptions;

class CurlException
extends \RuntimeException
{
  public function __construct($curl = null, \Exception $previous = null)
  {
    if ((is_object($curl) && $curl instanceof \CurlHandle) || is_resource($curl) && get_resource_type($curl) === 'curl')
    {
      $error = curl_errno($curl);
      $message = curl_strerror($error);
      $text = curl_error($curl);
      if (!empty($text))
      {
        $message .= ": {$text}";
      }
    }
    else
    {
      $message = $curl ?: 'Unable to initialize cURL instance: unknown error';
      $error = 0;
    }

    parent::__construct($message, $error, $previous);
  }
}
