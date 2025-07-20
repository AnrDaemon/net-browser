<?php

/** Curl errors wrapper
 *
 * @version SVN: $Id$
 */

namespace AnrDaemon\Exceptions;

class CurlException
extends \Exception
{
  /** Creates an exception from cURL instance data
   *
   * @param \CurlHandle|resource $curl
   * @param ?\Exception $previous
   * @return void
   */
  public static function fromInstance($curl, \Exception $previous = null)
  {
    if (!(\is_object($curl) && $curl instanceof \CurlHandle) && !(\is_resource($curl) && \get_resource_type($curl) === 'curl'))
    {
      throw new \Exception("Requires a cURL instance to proceed", -1);
    }

    $error = \curl_errno($curl);
    $message = \curl_strerror($error);
    $text = \curl_error($curl);
    if (!empty($text))
    {
      $message .= ": {$text}";
    }

    return new static($message, $error, $previous);
  }
}
