<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:create-user',
    description: 'Création d\'un utilisateur'
)]
class CreateUserCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'Nom d\'utilisateur')
            ->addArgument('password', InputArgument::REQUIRED, 'Mot de passe')
            ->addArgument('email', InputArgument::REQUIRED, 'Email');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $email = $input->getArgument('email');

        // Affiche les informations (simule la création sans hashage ni sauvegarde)
        $output->writeln("Création d'utilisateur avec les informations suivantes :");
        $output->writeln("Nom d'utilisateur : $username");
        $output->writeln("Mot de passe : $password");
        $output->writeln("Email : $email");

        return Command::SUCCESS;
    }
}


?>