<?php
 namespace UmiCms\System\Request\Http;class Request implements iRequest {private $cookies;private $server;private $post;private $get;private $files;public function __construct(iCookies $v55e7dd3016ce4ac57b9a0f56af12f7c2, iServer $vcf1e8c14e54505f60aa10ceb8d5d8ab3, iPost $v42b90196b487c54069097a68fe98ab6f, iGet $vb5eda0a74558a342cf659187f06f746f, iFiles $v45b963397aa40d4a0063e0d85e4fe7a1) {$this->cookies = $v55e7dd3016ce4ac57b9a0f56af12f7c2;$this->server = $vcf1e8c14e54505f60aa10ceb8d5d8ab3;$this->post = $v42b90196b487c54069097a68fe98ab6f;$this->get = $vb5eda0a74558a342cf659187f06f746f;$this->files = $v45b963397aa40d4a0063e0d85e4fe7a1;}public function Cookies() {return $this->cookies;}public function Server() {return $this->server;}public function Post() {return $this->post;}public function Get() {return $this->get;}public function Files() {return $this->files;}public function method() {return $this->Server()->get('REQUEST_METHOD');}public function isPost() {return $this->method() === 'POST';}public function isGet() {return $this->method() === 'GET';}public function host() {return $this->Server()->get('HTTP_HOST');}public function userAgent() {return $this->Server()->get('HTTP_USER_AGENT');}public function remoteAddress() {return $this->Server()->get('REMOTE_ADDR');}public function serverAddress() {return $this->Server()->get('SERVER_ADDR');}public function uri() {return $this->Server()->get('REQUEST_URI');}public function query() {return $this->Server()->get('QUERY_STRING');}public function getRawBody() {return file_get_contents('php://input');}}