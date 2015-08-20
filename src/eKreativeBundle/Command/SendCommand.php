<?php

namespace eKreativeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendCommand extends ContainerAwareCommand
{
    /**
     * configure command line
     */
    protected function configure()
    {
        $this
            ->setName('ekreative:send')
            ->setDescription('Send messages from DB to mail.')
            ->addArgument(
                'login',
                InputArgument::OPTIONAL,
                'Enter user name (Google Account):'
            )
            ->addArgument(
                'password',
                InputArgument::OPTIONAL,
                'Enter password:'
            )
        ;
    }

    /**
     * action on command ekreative:send
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('login');
        $password = $input->getArgument('password');

        if (!$name || !$password) {
            $output->writeln('Please enter your login and password for Google Account!');
        }
        else {
            $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
                ->setUsername($name)
                ->setPassword($password)
            ;
            $mailer = \Swift_Mailer::newInstance($transport);

            $el = $this->getContainer()->get('doctrine.orm.entity_manager');

            $messages = $el->getRepository('eKreativeBundle:Message')
                ->findBy(array('sent' => 0));

            foreach($messages as $message) {

                $user = $message->getUserTo();

                try {
                    $bodyMessage = \Swift_Message::newInstance()
                        ->setSubject($message->getTopic())
                        ->setFrom($name)
                        ->setTo($user->getEmail())
                        ->setBody($message->getBody())
                    ;
                    $mailer->send($bodyMessage);
                    $message->setSent();

                    $el->persist($message);
                    $el->flush();

                    $output->writeln('The message "' . $message->getTopic() . '" was sent to ' . $user->getEmail());
                }
                catch (Exception $e) {
                    $output->writeln('The message "' . $message->getTopic() . '" was NOT sent!!!');
                }
            }
        }
    }
}