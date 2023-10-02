<?php


namespace App\Event;

use DateTime;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeCrudActionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BeforeCrudActionEventSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeCrudActionEvent::class => 'onBeforeCrudActionEvent',
        ];
    }

    public function onBeforeCrudActionEvent(BeforeCrudActionEvent $event): void
    {
        // dd($event->getAdminContext()->getEntity()->getInstance());
        $requestAll = $event->getAdminContext()->getRequest()->request->all();
        if (
            $event->getAdminContext()->getRequest()->getMethod() === 'POST'
            &&
            (isset($requestAll['JobOffer']['notes']['content'])
            ||
            isset($requestAll['Customer']['notes']['content'])
            ||
            isset($requestAll['Candidate']['notes']['content']))
            &&
            $event->getAdminContext()->getEntity()->getInstance() !== null
            &&
            $event->getAdminContext()->getEntity()->getInstance()->getNotes() !==null
        ) {
            $requestNotesContentData =
                isset($requestAll['JobOffer']['notes']['content']) ?
                $requestAll['JobOffer']['notes']['content'] : (isset($requestAll['Customer']['notes']['content']) ?
                $requestAll['Customer']['notes']['content'] : (isset($requestAll['Candidate']['notes']['content']) ?
                $requestAll['Candidate']['notes']['content'] : null));

            $entityNotesContentData = $event->getAdminContext()
                ->getEntity()
                ->getInstance()
                ->getNotes()
                ->getContent();

            if ($requestNotesContentData !== $entityNotesContentData) {
                $event->getAdminContext()
                    ->getEntity()
                    ->getInstance()
                    ->getNotes()->setUpdatedAt(new DateTimeImmutable());
            }
        }
    }
}
