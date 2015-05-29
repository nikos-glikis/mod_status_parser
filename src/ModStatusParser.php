<?php
namespace nikosglikis\ModStatusParser;

require_once 'ModStatusUtilities.php';
require_once 'ModStatusOutput.php';
require_once 'ModStatusWorker.php';

/**
 * This class handles the parsing.
 *
 * Class ModStatusParser
 * @package nikosglikis\mod_status_parser
 */
class ModStatusParser
{
    /**
     * @var String - The mod_status output html.
     */
    private $htmlOutput;

    /**
     * @var
     */
    private $rawAutoOutput;

    /**
     * @var string Mod Status Url
     */
    private $modStatusUrl;

    /**
     * @var ModStatusOutput
     */
    private $modStatusOutput;

    public function __construct($modStatusUrl)
    {
        $this->htmlOutput = $modStatusUrl;
        $this->rawHtml = ModStatusUtilities::getUrlContents($modStatusUrl);
        $this->rawAutoOutput = ModStatusUtilities::getUrlContents($modStatusUrl.'?auto');
        $this->modStatusOutput = new ModStatusOutput();

        $this->parseAuto();
    }

    function parseAuto()
    {
        $temp = ModStatusUtilities::getStringBetween($this->rawAutoOutput, "Total Accesses: ", "\n");

        if ($temp)
        {
            $this->modStatusOutput->setTotalAccesses($temp);
        }
        $temp = ModStatusUtilities::getStringBetween($this->rawAutoOutput, "Total kBytes: ", "\n");
        if ($temp)
        {
            $this->modStatusOutput->setTotalKbs($temp);
        }

        $temp = ModStatusUtilities::getStringBetween($this->rawAutoOutput, "CPULoad: ", "\n");
        if ($temp)
        {
            $this->modStatusOutput->setCpuLoad($temp);
        }

        $temp = ModStatusUtilities::getStringBetween($this->rawAutoOutput, "Uptime: ", "\n");
        if ($temp)
        {
            $this->modStatusOutput->setUptime($temp);
        }

        $temp = ModStatusUtilities::getStringBetween($this->rawAutoOutput, "ReqPerSec: ", "\n");
        if ($temp)
        {
            $this->modStatusOutput->setRequestsPerSecond($temp);
        }

        $temp = ModStatusUtilities::getStringBetween($this->rawAutoOutput, "BytesPerSec: ", "\n");
        if ($temp)
        {
            $this->modStatusOutput->setBytesPerSecond($temp);
        }

        $temp = ModStatusUtilities::getStringBetween($this->rawAutoOutput, "BytesPerReq: ", "\n");
        if ($temp)
        {
            $this->modStatusOutput->setBytesPerRequest($temp);
        }

        $temp = ModStatusUtilities::getStringBetween($this->rawAutoOutput, "BusyWorkers: ", "\n");
        if ($temp)
        {
            $this->modStatusOutput->setBusyWorkers($temp);
        }

        $temp = ModStatusUtilities::getStringBetween($this->rawAutoOutput, "IdleWorkers: ", "\n");
        if ($temp !== FALSE)
        {
            $this->modStatusOutput->setIdleWorkers($temp);
        }
        $temp = ModStatusUtilities::getStringBetween($this->getRawHtml(), "Restart Time: ", "<");
        if ($temp)
        {
            $this->modStatusOutput->setRestartTimeHumanReadable(trim($temp));
        }

        $temp = ModStatusUtilities::getStringBetween($this->getRawHtml(), "Server uptime:  ", "<");
        if ($temp)
        {
            $this->modStatusOutput->setUptimeHumanReadable(trim($temp));
        }

        $temp = ModStatusUtilities::getStringBetween($this->getRawHtml(), "CPU load</dt>", "<pre>");
        if ($temp)
        {
            $temp = ModStatusUtilities::getStringBetween($temp, "<dt>", "</dt>");
            $this->modStatusOutput->setUptimeHumanReadable(trim($temp));
            $parts = explode("-",$temp);
            if (sizeof($parts) == 3)
            {
                $this->modStatusOutput->setBytesPerRequestHumanReadable(trim($parts[0]));
                $this->modStatusOutput->setBytesPerSecondHumanReadable(trim($parts[1]));
                $this->modStatusOutput->setBytesPerRequestHumanReadable(trim($parts[2]));
            }
        }


        $temp = ModStatusUtilities::getStringBetween($this->getRawHtml(), "CPU Usage: ", "dt");
        if ($temp)
        {
            $temp = ModStatusUtilities::getStringBetween($temp, " - ","<");
            $this->modStatusOutput->setCpuLoadHumanReadable(trim($temp));
        }
        //var_dump($this->modStatusOutput);

        $htmlDoc = new \DOMDocument();
        $workersHtml = ModStatusUtilities::getStringBetween($this->getRawHtml(), "<table","</table>");
        $htmlDoc->loadHTML($workersHtml);
        $rows = $htmlDoc->getElementsByTagName('tr');


        //On the first line we get the headers.
        $first = true;
        $indexes = array();
        if (!is_null($rows))
        {
            foreach ($rows as $row)
            {
                $nodes = $row->childNodes;
                $i = 0;
                $modStatusWorker = new ModStatusWorker();
                foreach ($nodes as $node)
                {
                    $value = trim($node->nodeValue);

                    if ($first)
                    {
                        $indexes[$i] = $value;

                    }
                    else
                    {
                        if ($indexes[$i] == ModStatusWorker::WORKER_CLIENT)
                        {
                            $modStatusWorker->setClient($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_REQ)
                        {
                            $modStatusWorker->setLastRequestMiliseconds($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_SRV)
                        {
                            $modStatusWorker->setWorkerid($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_PID)
                        {
                            $modStatusWorker->setPid($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_ACCESSES)
                        {
                            $modStatusWorker->setAccesses($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_MODE)
                        {
                            $modStatusWorker->setMode($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_CPU)
                        {
                            $modStatusWorker->setCpu($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_IDLE_SECONDS)
                        {
                            $modStatusWorker->setIdleSeconds($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_REQUEST_KB)
                        {
                            $modStatusWorker->setRequestKb($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_MB_TRANSFERED_BY_CHILD)
                        {
                            $modStatusWorker->setChildTransferredMbs($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_MB_TRANSFERED_BY_SLOT)
                        {
                            $modStatusWorker->setSlotTransferredMbs($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_VHOST)
                        {
                            $modStatusWorker->setVhost($value);
                        }
                        else if ($indexes[$i] == ModStatusWorker::WORKER_REQUEST)
                        {
                            $modStatusWorker->setRequest($value);
                        }
                        else
                        {
                            //extra field ?
                            var_dump($indexes[$i]);
                        }
                        $this->modStatusOutput->addWorker($modStatusWorker);
                    }
                    $i++;
                }
                $first = false;
            }
            $this->modStatusOutput->addWorker($modStatusWorker);
        }
        //var_dump($this->modStatusOutput);
    }

    public function getModStatusOutput()
    {
        return $this->modStatusOutput;
    }

    /**
     * @return String
     */
    public function getRawHtml()
    {
        return $this->rawHtml;
    }

    /**
     * @param String $rawHtml
     */
    public function setRawHtml($rawHtml)
    {
        $this->rawHtml = $rawHtml;
    }

    /**
     * @return mixed
     */
    public function getRawAutoOutput()
    {
        return $this->rawAutoOutput;
    }

    /**
     * @param mixed $rawAutoOutput
     */
    public function setRawAutoOutput($rawAutoOutput)
    {
        $this->rawAutoOutput = $rawAutoOutput;
    }

    /**
     * @return String the ModStatus url
     */
    public function getModStatusUrl()
    {
        return $this->modStatusUrl;
    }

    /**
     * @param $modStatusUrl String Mod
     */
    public function setModStatusUrl($modStatusUrl)
    {
        $this->modStatusUrl = $modStatusUrl;
    }


}

?>