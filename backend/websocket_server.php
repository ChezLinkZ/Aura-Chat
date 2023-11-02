<?php
require 'vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\ConnectionInterface;

class PresenceServer implements \Ratchet\MessageComponentInterface
{
    protected $connections = [];

    public function onOpen(ConnectionInterface $conn)
    {
        // Add the connection to the list of connections
        $this->connections[$conn->resourceId] = $conn;
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Handle incoming messages (heartbeats, etc.) if needed
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Remove the connection from the list of connections
        unset($this->connections[$conn->resourceId]);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new PresenceServer()
        )
    ),
    8080,
    '0.0.0.0' // This allows external access
);