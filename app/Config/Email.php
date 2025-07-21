<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'your-email@example.com';
    public string $fromName   = 'Your Name';
    public string $protocol   = 'smtp';
    public string $SMTPHost   = 'smtp.gmail.com';
    public string $SMTPUser   = 'ullulazmia.l@gmail.com';
    public string $SMTPPass   = 'ktnv dcjr bsgc uqbu';
    public int    $SMTPPort   = 587;
    public int    $SMTPTimeout = 5;
    public bool   $SMTPKeepAlive = false;
    public string $SMTPCrypto = 'tls';
    public bool   $wordWrap    = true;
    public int    $wrapChars   = 76;
    public string $mailType    = 'html';
    public string $charset     = 'UTF-8';
    public bool   $validate    = false;
    public int    $priority    = 3;
    public string $CRLF        = "\r\n";
    public string $newline     = "\r\n";
    public bool   $BCCBatchMode = false;
    public int    $BCCBatchSize = 200;
    public string $DSN         = '';
}
