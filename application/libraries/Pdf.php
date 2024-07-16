<?php
// application/libraries/Pdf.php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/tcpdf/tcpdf.php');

class Pdf extends TCPDF {
    public function __construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false) {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }

    // You can add custom methods here if needed
}
