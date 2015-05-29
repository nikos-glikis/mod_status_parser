<?php
namespace nikosglikis\ModStatusParser;
/**
 * Class ModStatusOutput
 *
 * Represents mod_status output. Has all info provided by the mod_status + a table with all the active workers.
 *
 * @package nikosglikis\mod_status_parser
 */
class ModStatusOutput
{
    /**
     * @var int - updtim
     */
    private $uptime;

    /**
     * @var string - uptime human readable format
     */
    private $uptimeHumanReadable;

    /**
     * @var - Restart time human readable format
     */
    private $restartTimeHumanReadable;

    /**
     * @var int - Total Accesses
     */
    private $totalAccesses;


    /**
     * @var int - Total Accesses
     */
    private $totalKbs;

    /**
     * @var - CPU Load
     */
    private $cpuLoad;

    /**
     * @var - CPU Load - Human Readable Format
     */
    private $cpuLoadHumanReadable;

    /**
     * @var int - Requests per second
     */
    private $requestsPerSecond;

    /**
     * @var - Bytes Per Second
     */
    private $bytesPerSecond;

    /**
     * @var - Bytes Per Second Human readable
     */
    private $bytesPerSecondHumanReadable;

    /**
     * @var - Bytes Per Request human readable format
     */
    private $bytesPerRequestHumanReadable;

    /**
     * @var - Bytes Per Request
     */
    private $bytesPerRequest;

    /**
     * @var Number of busy workers
     */
    private $busyWorkers;

    /**
     * @var Number of idle workers
     */
    private $idleWorkers;

    /**
     * @var ModStatusWorker[] - Current active connections
     */
    private $workers = array();

    /**
     * @var array Workers as associative array
     */
    private $workersArray;

    /**
     * Adds a new worker to the workers array.
     * @param $worker ModStatusWorker
     */
    public function addWorker($worker)
    {
        $this->workers[] = $worker;
    }

    //setters - getters
    /**
     * @return int
     */
    public function getUptime()
    {
        return $this->uptime;
    }

    /**
     * @param int $uptime
     */
    public function setUptime($uptime)
    {
        $this->uptime = $uptime;
    }

    /**
     * @return string
     */
    public function getUptimeHumanReadable()
    {
        return $this->uptimeHumanReadable;
    }

    /**
     * @param string $uptimeHumanReadable
     */
    public function setUptimeHumanReadable($uptimeHumanReadable)
    {
        $this->uptimeHumanReadable = $uptimeHumanReadable;
    }

    /**
     * @return mixed
     */
    public function getRestartTimeHumanReadable()
    {
        return $this->restartTimeHumanReadable;
    }

    /**
     * @param mixed $restartTimeHumanReadable
     */
    public function setRestartTimeHumanReadable($restartTimeHumanReadable)
    {
        $this->restartTimeHumanReadable = $restartTimeHumanReadable;
    }

    /**
     * @return int
     */
    public function getTotalAccesses()
    {
        return $this->totalAccesses;
    }

    /**
     * @param int $totalAccesses
     */
    public function setTotalAccesses($totalAccesses)
    {
        $this->totalAccesses = $totalAccesses;
    }

    /**
     * @return mixed
     */
    public function getCpuLoad()
    {
        return $this->cpuLoad;
    }

    /**
     * @param mixed $cpuLoad
     */
    public function setCpuLoad($cpuLoad)
    {
        $this->cpuLoad = $cpuLoad;
    }

    /**
     * @return mixed
     */
    public function getCpuLoadHumanReadable()
    {
        return $this->cpuLoadHumanReadable;
    }

    /**
     * @param mixed $cpuLoadHumanReadable
     */
    public function setCpuLoadHumanReadable($cpuLoadHumanReadable)
    {
        $this->cpuLoadHumanReadable = $cpuLoadHumanReadable;
    }

    /**
     * @return int
     */
    public function getRequestsPerSecond()
    {
        return $this->requestsPerSecond;
    }

    /**
     * @param int $requestsPerSecond
     */
    public function setRequestsPerSecond($requestsPerSecond)
    {
        $this->requestsPerSecond = $requestsPerSecond;
    }

    /**
     * @return mixed
     */
    public function getBytesPerSecond()
    {
        return $this->bytesPerSecond;
    }

    /**
     * @param mixed $bytesPerSecond
     */
    public function setBytesPerSecond($bytesPerSecond)
    {
        $this->bytesPerSecond = $bytesPerSecond;
    }

    /**
     * @return mixed
     */
    public function getBytesPerSecondHumanReadable()
    {
        return $this->bytesPerSecondHumanReadable;
    }

    /**
     * @param mixed $bytesPerSecondHumanReadable
     */
    public function setBytesPerSecondHumanReadable($bytesPerSecondHumanReadable)
    {
        $this->bytesPerSecondHumanReadable = $bytesPerSecondHumanReadable;
    }

    /**
     * @return mixed
     */
    public function getBytesPerRequestHumanReadable()
    {
        return $this->bytesPerRequestHumanReadable;
    }

    /**
     * @param mixed $bytesPerRequestHumanReadable
     */
    public function setBytesPerRequestHumanReadable($bytesPerRequestHumanReadable)
    {
        $this->bytesPerRequestHumanReadable = $bytesPerRequestHumanReadable;
    }

    /**
     * @return mixed
     */
    public function getBytesPerRequest()
    {
        return $this->bytesPerRequest;
    }

    /**
     * @param mixed $bytesPerRequest
     */
    public function setBytesPerRequest($bytesPerRequest)
    {
        $this->bytesPerRequest = $bytesPerRequest;
    }

    /**
     * @return Number
     */
    public function getBusyWorkers()
    {
        return $this->busyWorkers;
    }

    /**
     * @param Number $busyWorkers
     */
    public function setBusyWorkers($busyWorkers)
    {
        $this->busyWorkers = $busyWorkers;
    }

    /**
     * @return Number
     */
    public function getIdleWorkers()
    {
        return $this->idleWorkers;
    }

    /**
     * @param Number $idleWorkers
     */
    public function setIdleWorkers($idleWorkers)
    {
        $this->idleWorkers = $idleWorkers;
    }

    /**
     * @return ModStatusWorker[]
     */
    public function getWorkers()
    {
        return $this->workers;
    }

    /**
     * @param ModStatusWorker[] $workers
     */
    public function setWorkers($workers)
    {
        $this->workers = $workers;
    }

    /**
     * @return ModStatusWorker[] Workers
     */
    public function getWorkersArray()
    {
        return $this->workersArray;
    }

    /**
     * @param $workersArray array ModStatusWorker
     */
    public function setWorkersArray($workersArray)
    {
        $this->workersArray = $workersArray;
    }

    /**
     * @return int
     */
    public function getTotalKbs()
    {
        return $this->totalKbs;
    }

    /**
     * @param int $totalKbs
     */
    public function setTotalKbs($totalKbs)
    {
        $this->totalKbs = $totalKbs;
    }


}
?>
