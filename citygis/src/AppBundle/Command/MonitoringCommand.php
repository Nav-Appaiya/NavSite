<?php
/**
 * Created by PhpStorm.
 * User: nav
 * Date: 14-12-15
 * Time: 03:59
 */

namespace AppBundle\Command;

use AppBundle\Entity\Events;
use AppBundle\Entity\Monitoring;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MonitoringCommand  extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName("genereer:monitoring")
            ->setDescription("Geneer een aantal monitoring events")
            ->addArgument(
                "aantal",
                InputOption::VALUE_OPTIONAL,
                "Hoeveel genereren?"
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $aantal = $input->getArgument('aantal');
        if(!$aantal){
            $aantal = 30;
        }

        for ($i = 0; $i < $aantal; $i++){
            $em = $this->getContainer()->get('doctrine.orm.entity_manager');
            $faker = Factory::create();
            $monitoring = new Monitoring();

            $monitoring->setUnitId($faker->randomNumber());
            $monitoring->setType($this->getRealMonitoringType());
            $monitoring->setBeginTime($faker->dateTime());
            $monitoring->setEndTime($faker->dateTime());
            $monitoring->setDate($faker->dateTime());
            $monitoring->setCreatedAt($faker->dateTime());
            $monitoring->setUpdatedAt($faker->dateTime());
            $monitoring->setMin($faker->randomNumber());
            $monitoring->setMax($faker->randomNumber());
            $monitoring->setSum($faker->randomNumber());
            $formattedLine = $this->getHelper('formatter')->formatSection(
                $monitoring->getId(),
                'Created unitId: #'.$monitoring->getUnitId()
            );
            $output->writeln($formattedLine);
            if($em->persist($monitoring)){
                $aantal--;
                echo $monitoring->getId();
                $output->writeln($aantal);
            }
            $em->flush();
        }
    }


    /**
     * Geeft een willekeurige type string
     * terug, zoals in sample data is gegeven.
     *
     * @return array
     */
    private function getRealMonitoringType()
    {
        $faker = Factory::create();

        $possibleTypes = array(
            "Gps/GpsAccuracyGyroBias",
            "Hsdpa/SQual",
            "SystemInfo/ManagedMemoryUsage",
            "SystemInfo/AvailableDiskSpace",
            "Gps/GpsGyroMean",
            "Gps/GpsTemperature",
            "Hsdpa/NumberOfConnects",
            "Hsdpa/RSSI",
            "Gps/NumberOfSatellitesTracked",
            "Gps/Speed",
            "SystemInfo/AvailableMemory",
            "Gps/GpsAccuracyGyroScale",
            "SystemInfo/MemoryLoad",
            "Hsdpa/RSCP",
            "Gps/GpsPulseScale",
            "SystemInfo/ProcessorUsage",
            "Hsdpa/SRxLev",
            "Gps/GpsGyroBias",
            "MessageStack/MessageCount"
        );


        return $faker->randomElement($possibleTypes);
    }


}