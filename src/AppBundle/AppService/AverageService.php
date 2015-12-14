<?php
namespace AppBundle\AppService;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
//use Acme\DemoBundle\Mailer\UserMailer;

class AverageService
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function printAverage($data) {
        $average = $this->calculate($data);
        $return = "";
        foreach($average as $ave) {
            $return .= "<th>".$ave."</th>";
        }
        return $return;
    }
    public function calculate($data) {
        switch($data["point"]->getSystemtype()) {
            case "ColdWater":
                return $this->calculateColdWater($data);
                break;
            case "HotWater":
                return $this->calculateHotWater($data);
                break;
            case "Heat":
                return $this->calculateHeat($data);
                break;
            case "Electricity":
                return $this->calculateElectricity($data);
                break;
        }
        return [];
    }
    public function calculateHotWater($data) {
        $average = [
            "T_in" => 0.00,
            "T_out" => 0.00,
            "T_delta" => 0.00,
            "M_in" => 0.00,
            "M_out" => 0.00,
            "M_delta" => 0.00,
            "V_in" => 0.00,
            "V_out" => 0.00,
            "V_delta" => 0.00,
        ];
        $count = 0;
        foreach($data["data"] as $dataItem) {
            $average["V_in"] += str_replace(",",".",$dataItem->getVIn());
            $average["V_out"] += str_replace(",",".",$dataItem->getVOut());
            $average["V_delta"] += str_replace(",",".",$dataItem->getVDelta());
            $average["M_in"] += str_replace(",",".",$dataItem->getMIn());
            $average["M_out"] += str_replace(",",".",$dataItem->getMOut());
            $average["M_delta"] += str_replace(",",".",$dataItem->getMDelta());
            $average["T_in"] += str_replace(",",".",$dataItem->getTIn());
            $average["T_out"] += str_replace(",",".",$dataItem->getTOut());
            $average["T_delta"] += str_replace(",",".",$dataItem->getTDelta());
            $count++;
        }
        if($count>0) {
            $average["V_in"] = round(($average["V_in"]/$count),2);
            $average["V_out"] = round(($average["V_out"]/$count),2);
            $average["V_delta"] = round(($average["V_delta"]/$count),2);

            $average["M_in"] = round(($average["M_in"]),2);
            $average["M_out"] = round(($average["M_out"]),2);
            $average["M_delta"] = round(($average["M_delta"]),2);

            $average["T_in"] = round(($average["T_in"]/$count),2);
            $average["T_out"] = round(($average["T_out"]/$count),2);
            $average["T_delta"] = round(($average["T_delta"]/$count),2);
        }
        else {
            $average = [
                "T_in" => 0.00,
                "T_out" => 0.00,
                "T_delta" => 0.00,
                "M_in" => 0.00,
                "M_out" => 0.00,
                "M_delta" => 0.00,
                "V_in" => 0.00,
                "V_out" => 0.00,
                "V_delta" => 0.00,
            ];
        }
        return $average;

    }
    public function calculateHeat($data) {
        $average = [
            "T_in" => 0.00,
            "T_out" => 0.00,
            "T_delta" => 0.00,
            "M_in" => 0.00,
            "M_out" => 0.00,
            "M_delta" => 0.00,
            "H_in" => 0.00,
            "H_out" => 0.00,
            "H_delta" => 0.00,
        ];
        $count = 0;
        foreach($data["data"] as $dataItem) {
            $average["H_in"] += str_replace(",",".",$dataItem->getHIn());
            $average["H_out"] += str_replace(",",".",$dataItem->getHOut());
            $average["H_delta"] += str_replace(",",".",$dataItem->getHDelta());
            $average["M_in"] += str_replace(",",".",$dataItem->getMIn());
            $average["M_out"] += str_replace(",",".",$dataItem->getMOut());
            $average["M_delta"] += str_replace(",",".",$dataItem->getMDelta());
            $average["T_in"] += str_replace(",",".",$dataItem->getTIn());
            $average["T_out"] += str_replace(",",".",$dataItem->getTOut());
            $average["T_delta"] += str_replace(",",".",$dataItem->getTDelta());
            $count++;
        }
        if($count>0) {
            $average["H_in"] = round(($average["H_in"]/$count),2);
            $average["H_out"] = round(($average["H_out"]/$count),2);
            $average["H_delta"] = round(($average["H_delta"]/$count),2);
            $average["M_in"] = round(($average["M_in"]),2);
            $average["M_out"] = round(($average["M_out"]),2);
            $average["M_delta"] = round(($average["M_delta"]),2);
            $average["T_in"] = round(($average["T_in"]/$count),2);
            $average["T_out"] = round(($average["T_out"]/$count),2);
            $average["T_delta"] = round(($average["T_delta"]/$count),2);
        }
        else {
            $average = [
                "T_in" => 0.00,
                "T_out" => 0.00,
                "T_delta" => 0.00,
                "M_in" => 0.00,
                "M_out" => 0.00,
                "M_delta" => 0.00,
                "H_in" => 0.00,
                "H_out" => 0.00,
                "H_delta" => 0.00,
            ];
        }
        return $average;

    }
    public function calculateColdWater($data) {
        $average = [
            "V_in" => 0.00
        ];
        $count = 0;
        foreach($data["data"] as $dataItem) {
            $average["V_in"] += str_replace(",",".",$dataItem->getVIn());
            $count++;
        }
        if($count>0) {
            $average["V_in"] = round(($average["V_in"]),2);
        }
        else {
            $average = [
                "V_in" => 0.00
            ];
        }
        return $average;
    }
    public function calculateElectricity($data) {
        $average = [
            "Ap1" => 0.00
        ];
        $count = 0;
        foreach($data["data"] as $dataItem) {
            $average["Ap1"] += str_replace(",",".",$dataItem->getAp1());
            $count++;
        }
        if($count>0) {
            $average["Ap1"] = round(($average["Ap1"]/$count),2);
        }
        else {
            $average = [
                "Ap1" => 0.00
            ];
        }
        return $average;
    }

}