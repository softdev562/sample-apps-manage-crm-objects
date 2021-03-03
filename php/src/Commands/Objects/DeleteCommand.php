<?php

namespace Commands\Objects;

use Helpers\HubspotClientHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DeleteCommand extends ObjectsCommand
{
    protected static $defaultName = 'objects:delete';

    protected function configure()
    {
        parent::configure();

        $this->setDescription('Delete an object by Id.');

        $this
            ->addArgument(
                'id',
                InputArgument::REQUIRED,
                'Delete an object by Id.'
            )
        ;
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $io = new SymfonyStyle($input, $output);
        $hubspot = HubspotClientHelper::createFactory();
        $objectType = $this->getObjectType($input);

        $io->writeln('Deleting an object by id...');

        $hubspot->crm()->{$objectType}()->basicApi()->archive($input->getArgument('id'));

        return ObjectsCommand::SUCCESS;
    }
}
