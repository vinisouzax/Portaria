<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('tcpdf/tcpdf.php');

class Mytcpdf extends Tcpdf{
  function __construct (){
    parent::__construct ();
    $CI =& get_instance();

  }

}
?>
