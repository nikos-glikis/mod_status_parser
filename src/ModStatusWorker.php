<?php
namespace nikosglikis\ModStatusParser;
/**
 * Class ModStatusWorker
 * This class represents a worker line in the mod_status output.
 *
 * @package nikosglikis\mod_status_parser
 */
class ModStatusWorker
{
    //workerId
    const WORKER_SRV = 'Srv';

    //pid
    const WORKER_PID = 'PID';

    //Accesses
    const WORKER_ACCESSES = 'Acc';

    //Mode
    const WORKER_MODE = 'M';

    //cpu
    const WORKER_CPU = 'CPU';

    //How many seconds has the worker been idle
    const WORKER_IDLE_SECONDS = "SS";

    //How many milliseconds to run last request.
    const WORKER_REQ = 'Req';

    //KB transfered in the request.
    const WORKER_REQUEST_KB = 'Conn';

    //Mb Transferred by this child
    const WORKER_MB_TRANSFERED_BY_CHILD = 'Child';

    //MB Transferred by child
    const WORKER_MB_TRANSFERED_BY_SLOT = 'Slot';

    //Client Ip
    const WORKER_CLIENT = "Client";

    //Virtual Host (domain);
    const WORKER_VHOST = 'VHost';

    //Worker Request
    const WORKER_REQUEST = 'Request';

    /**
     * @var String WorkerId
     */
    private $workerid;

    /**
     * @var int
     */
    private $lastRequestMiliseconds;

    /**
     * @var integer Server PID
     */
    private $pid;

    /**
     * @var String Accesses
     */
    private $accesses;

    /**
     * @var String - mode
     */
    private $mode;

    /**
     * @var - Status as $text
     */
    private $statusText;

    /**
     * @var String CPU Usage
     */
    private $cpu;

    /** @var integer Number of requests */
    private $requests;

    /** @var integer Number of connections */
    private $connections;

    /** @var string  Slot */
    private $slot;

    /** @var string Client IP */
    private $client;

    /** @var string Virtual Hostname (Domain) */
    private $vhost;

    /** @var string Request */
    private $request;

    /** @var integer Idle Seconds */
    private $idleSeconds;

    /** @var integer - Kbs of last request*/
    private $requestKb;

    /** @var integer - Mbs transfered by this child*/
    private $childTransferredMbs;

    /** @var integer - Mbs transfered by this slot */
    private $slotTransferredMbs;



    //Setters and getters

    /**
     * @return int
     */
    public function getSlotTransferredMbs()
    {
        return $this->slotTransferredMbs;
    }

    /**
     * @param int $slotTransferredMbs
     */
    public function setSlotTransferredMbs($slotTransferredMbs)
    {
        $this->slotTransferredMbs = $slotTransferredMbs;
    }

    /**
     * @return int
     */
    public function getChildTransferredMbs()
    {
        return $this->childTransferredMbs;
    }

    /**
     * @param int $childTransferredMbs
     */
    public function setChildTransferredMbs($childTransferredMbs)
    {
        $this->childTransferredMbs = $childTransferredMbs;
    }

    /**
     * @return int
     */
    public function getRequestKb()
    {
        return $this->requestKb;
    }

    /**
     * @param int $requestKb
     */
    public function setRequestKb($requestKb)
    {
        $this->requestKb = $requestKb;
    }


    /**
     * @return int
     */
    public function getLastRequestMiliseconds()
    {
        return $this->lastRequestMiliseconds;
    }

    /**
     * @param int $lastRequestMiliseconds
     */
    public function setLastRequestMiliseconds($lastRequestMiliseconds)
    {
        $this->lastRequestMiliseconds = $lastRequestMiliseconds;
    }


    /**
     * @return String  WorkerId
     */
    public function getWorkerid()
    {
        return $this->workerid;
    }

    /**
     * @param String $workerid
     */
    public function setWorkerid($workerid)
    {
        $this->workerid = $workerid;
    }

    /**
     * @return integer
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param $pid String Server
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
    }

    /**
     * @return mixed
     */
    public function getStatusText()
    {
        return $this->statusText;
    }

    /**
     * @param mixed $statusText
     */
    public function setStatusText($statusText)
    {
        $this->statusText = $statusText;
    }

    /**
     * @return String CPU
     */
    public function getCpu()
    {
        return $this->cpu;
    }

    /**
     * @param $cpu String CPU
     */
    public function setCpu($cpu)
    {
        $this->cpu = $cpu;
    }

    /**
     * @return Number
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param Number $requests
     */
    public function setRequests($requests)
    {
        $this->requests = $requests;
    }

    /**
     * @return Number
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * @param Number $connections
     */
    public function setConnections($connections)
    {
        $this->connections = $connections;
    }

    /**
     * @return String Slot
     */
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * @param $slot String Slot
     */
    public function setSlot($slot)
    {
        $this->slot = $slot;
    }

    /**
     * @return String Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param $client String Client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return String Virtual
     */
    public function getVhost()
    {
        return $this->vhost;
    }

    /**
     * @param $vhost String Virtual
     */
    public function setVhost($vhost)
    {
        $this->vhost = $vhost;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param $request String
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return String
     */
    public function getAccesses()
    {
        return $this->accesses;
    }

    /**
     * @param String $accesses
     */
    public function setAccesses($accesses)
    {
        $this->accesses = $accesses;
    }

    /**
     * @return String
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param String $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * @return int
     */
    public function getIdleSeconds()
    {
        return $this->idleSeconds;
    }

    /**
     * @param int $idleSeconds
     */
    public function setIdleSeconds($idleSeconds)
    {
        $this->idleSeconds = $idleSeconds;
    }



}