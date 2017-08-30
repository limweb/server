<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2017-08-30
 * Time: 15:06
 */

namespace inhere\server\rpc;

use inhere\server\portListeners\InterfaceTcpListener;
use inhere\server\portListeners\PortListener;
use Swoole\Server;

/**
 * Class RpcServer
 * @package inhere\server\rpc
 */
class RpcServer extends PortListener implements InterfaceTcpListener
{
    // protected $type = 'tcp';

    /**
     * {@inheritDoc}
     */
    public function onConnect(Server $server, $fd)
    {
        $this->mgr->log("Has a new client [FD:$fd] connection.");
    }

    /**
     * 接收到数据
     *     使用 `fd` 保存客户端IP，`from_id` 保存 `from_fd` 和 `port`
     * @param  Server $server
     * @param  int $fd
     * @param  int $fromId
     * @param  mixed $data
     */
    public function onReceive(Server $server, $fd, $fromId, $data)
    {
        $data = trim($data);
        $this->log("Receive data [$data] from client [FD:$fd].");

        $server->send($fd, "I have been received your message.\n");

        // $this->onTaskReceive($server, $fd, $fromId, $data);

        // 群发收到的消息
        // $this->reloadWorker->write($data);
    }

    /**
     * {@inheritDoc}
     */
    public function onClose(Server $server, $fd)
    {
        $this->mgr->log("The client [FD:$fd] connection closed.");
    }
}
