<?php

declare(strict_types=1);

namespace Stu\Component\Player\Deletion\Confirmation;

use Laminas\Mail\Exception\RuntimeException;
use Laminas\Mail\Message;
use Laminas\Mail\Transport\Sendmail;
use Noodlehaus\ConfigInterface;
use Stu\Module\PlayerSetting\Lib\PlayerEnum;
use Stu\Orm\Entity\UserInterface;
use Stu\Orm\Repository\UserRepositoryInterface;

final class RequestDeletionConfirmation implements RequestDeletionConfirmationInterface
{
    private UserRepositoryInterface $userRepository;

    private ConfigInterface $config;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ConfigInterface $config
    ) {
        $this->userRepository = $userRepository;
        $this->config = $config;
    }

    public function request(UserInterface $user): void
    {
        $token = sha1(time().$user->getCreationDate());

        $user->setDeletionMark(PlayerEnum::DELETION_REQUESTED);
        $user->setPasswordToken($token);

        $body = <<<EOT
        Hallo\n\n
        Du hast eine Accountlöschung in Star Trek Universe angefordert.\n\n
        Bitte bestätige die Löschung mittels Klick auf folgenden Link:\n
        %s/?CONFIRM_ACCOUNT_DELETION=1&token=%s\n
        Das STU-Team\n\n,
        EOT;

        $mail = new Message();
        $mail->addTo($user->getEmail());
        $mail->setSubject(_('Star Trek Universe - Accountlöschung'));
        $mail->setFrom($this->config->get('game.email_sender_address'));
        $mail->setBody(
            sprintf(
                $body,
                $this->config->get('game.base_url'),
                $token,
            )
        );

        try {
            $transport = new Sendmail();
            $transport->send($mail);
        } catch (RuntimeException $e) {
            return;
        }

        $this->userRepository->save($user);
    }
}
