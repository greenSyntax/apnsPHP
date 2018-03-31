<?php

namespace apns;

public class apnsPHP {

  // Mode of APNS
    private $mode = "DEVELOPMENT";
    #private $mode = "PRODUCTION";

    private $apnsPort = 2195;
    private $pathOfCertificate;
    private $payload;

    function __construct($pathOfCertficate){
      // Set APNS Cer Certificate
      $this->pathOfCertficate = $pathOfCertficate;
    }

    private function getHostName(){

      if($this->mode == "DEVELOPMENT"){
        return "gateway.sandbox.push.apple.com";
      }
      else{
        return "gateway.push.apple.com";
      }
    }

    private function validate($payload, $token){

      # This is Lame Logic. Kindly Improve this.
      if($payload == null){
        return "Payload is assigned";
      }

      if($token == null){
        return "Token is not assigned";
      }

      if($this->pathOfCertficate == null){
        return "APNS Certifcate is not assigned";
      }

      return true;
    }

    public function sendPushNotification($message, $token) {

      $paylod = $payload['aps'] = array('alert' => $message, 'badge' => 1, 'sound' => 'default');
      sendPushNotificationAsJSON(json_encode($payload), $token);
    }

    // Send Push Notification To Tokens
    public function sendPushNotificationAsJSON($payload, $token){

      if($this->validate($payload, $token) != true){
        return "Validation Error";
      }

      //echo $this->pathOfCertficate;
      $token = pack('H*', str_replace(' ', '', $token));
      $apnsMessage = chr(0).chr(0).chr(32).$token.chr(0).chr(strlen($payload)).$payload;
      $streamContext = stream_context_create();
      stream_context_set_option($streamContext, 'ssl', 'local_cert', $this->pathOfCertficate);
      $apns = stream_socket_client('ssl://'.$this->getHostName().':'.$this->apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
      fwrite($apns, $apnsMessage);
      fclose($apns);
    }

}

 ?>
