<?php


namespace App\Security;

use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

class UserChecker implements UserCheckerInterface
{
        public function checkPreAuth(UserInterface $user): void
        {
            if (!$user instanceof User) {
                return;
            }

            if (!$user->isIsActive()) {
                throw new CustomUserMessageAccountStatusException('Your user account no longer exists.');
            }
        }
    
        public function checkPostAuth(UserInterface $user): void
        {
            if (!$user instanceof User) {
                return;
            }
        }
}
