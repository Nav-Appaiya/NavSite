<?php
/**
 * Created by PhpStorm.
 * User: nav
 * Date: 14-12-15
 * Time: 03:59
 */

namespace AppBundle\Command;


use AppBundle\Entity\Events;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EventsCommand  extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName("genereer:events")
            ->setDescription("Geneer een aantal events")
//            ->addArgument(
//                "aantal",
//                InputArgument::OPTIONAL,
//                "Hoeveel genereren?"
//            )
            ->addOption(
                "aantal",
                "aantal",
                InputOption::VALUE_REQUIRED,
                'Aantal te genereren events: '
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $aantal = $input->getOption('aantal');
        if(!$aantal){
            $aantal = 30;
        }

        for ($i = 0; $i < $aantal; $i++){
            $em = $this->getContainer()->get('doctrine.orm.entity_manager');
            $faker = Factory::create();
            $event = new Events();

            $event->setName($faker->name);
            $event->setAmount($faker->randomFloat());
            $event->setRemark($faker->realText(400,2));

            if($em->persist($event)){
                $aantal--;
                $output->writeln($aantal);
            }
            $em->flush();
        }
    }


}