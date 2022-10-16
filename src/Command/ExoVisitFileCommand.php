<?php

namespace App\Command;

use App\Service\VisitFiles;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'exo:visit-file',
    description: 'Add a short description for your command',
)]
class ExoVisitFileCommand extends Command
{
    public function __construct(private VisitFiles $visitFiles)
    {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('root', InputArgument::REQUIRED, 'Argument description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $root = $input->getArgument('root');
        $files = $this->visitFiles->visitFiles($root, function ($file) {
            if (str_contains($file->name, 'Book')) {
                return true;
            }

            return false;
        });
        print_r($files);

        $this->visitFiles->usageExemple();

        return Command::SUCCESS;
    }
}
