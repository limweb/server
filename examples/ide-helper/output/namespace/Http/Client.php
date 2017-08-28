<?php
namespace Swoole\Http;

/**
 * @since 1.9.5
 */
class Client
{


    /**
     * @param $host[required]
     * @param $port[optional]
     * @param $ssl[optional]
     * @return mixed
     */
    public function __construct($host, $port=null, $ssl=null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param $settings[required]
     * @return mixed
     */
    public function set($settings){}

    /**
     * @param $method[required]
     * @return mixed
     */
    public function setMethod($method){}

    /**
     * @param $headers[required]
     * @return mixed
     */
    public function setHeaders($headers){}

    /**
     * @param $cookies[required]
     * @return mixed
     */
    public function setCookies($cookies){}

    /**
     * @param $data[required]
     * @return mixed
     */
    public function setData($data){}

    /**
     * @param $path[required]
     * @param $name[required]
     * @param $type[optional]
     * @param $filename[optional]
     * @param $offset[optional]
     * @return mixed
     */
    public function addFile($path, $name, $type=null, $filename=null, $offset=null){}

    /**
     * @param $path[required]
     * @param $callback[required]
     * @return mixed
     */
    public function execute($path, $callback){}

    /**
     * @param $data[required]
     * @param $opcode[optional]
     * @param $finish[optional]
     * @return mixed
     */
    public function push($data, $opcode=null, $finish=null){}

    /**
     * @param $path[required]
     * @param $callback[required]
     * @return mixed
     */
    public function get($path, $callback){}

    /**
     * @param $path[required]
     * @param $data[required]
     * @param $callback[required]
     * @return mixed
     */
    public function post($path, $data, $callback){}

    /**
     * @param $path[required]
     * @param $callback[required]
     * @return mixed
     */
    public function upgrade($path, $callback){}

    /**
     * @param $path[required]
     * @param $file[required]
     * @param $callback[required]
     * @param $offset[optional]
     * @return mixed
     */
    public function download($path, $file, $callback, $offset=null){}

    /**
     * @return mixed
     */
    public function isConnected(){}

    /**
     * @return mixed
     */
    public function close(){}

    /**
     * @param $event_name[required]
     * @param $callback[required]
     * @return mixed
     */
    public function on($event_name, $callback){}


}