<?php

namespace Dudek\FormBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class ImportUserCommand extends ContainerAwareCommand
{
    const MAIL_DOMAIN = '@student.42.fr';

    protected function configure()
    {
        $this
            ->setName('dudek:import:user')
            ->setDescription('Import all users from the 42 LDAP')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('fos_user.user_manager');
        $ldapManager = $this->getContainer()->get('dudek.ldap_manager');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $users = $ldapManager->import();
        $bar = new ProgressBar($output, $users['count']);
        unset($users['count']);
        foreach ($users as $key => $ldapUser) {
            $user = $manager->createUser();
            $user->setUsername($ldapUser['uid'][0]);
            $user->setFullName($ldapUser['cn'][0]);
            $user->setPlainPassword(hash('sha512', rand()));
            $user->setEmail($user->getUsername().self::MAIL_DOMAIN);
            $user->setRoles(['ROLE_USER']);
            $manager->updateUser($user, false);
            $bar->advance();
        }
        $bar->finish();
        $em->flush();
    }
}
