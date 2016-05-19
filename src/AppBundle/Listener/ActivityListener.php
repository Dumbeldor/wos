<?php
namespace AppBundle\Listener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use AppBundle\Entity\User;
use DateTime;


class ActivityListener
{
    protected $token;
    protected $em;
    protected $twig;

    public function __construct(TokenStorageInterface $token, EntityManager $doctrine, \Twig_Environment $twig)
    {
        $this->token = $token;
        $this->em = $doctrine;
        $this->twig = $twig;
    }
    /**
     * On each request we want to update the user's last activity datetime
     *
     * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event
     * @return void
     */
    public function onCoreController(FilterControllerEvent $event)
    {
      if ($this->token->getToken()) {
        $user = $this->token->getToken()->getUser();
        if($user instanceof User) {
            $town = $user->getTownCurrant();
            $ressources = $this->em->getRepository('GameBundle:Town')->getRessource($town->getId());

	          $interval = 0;
	          if($user->getLastActivity() != null)
                $interval = $user->getLastActivity()->diff(new DateTime())->format('%s');

            foreach ($ressources as $r) {
                $nb = $r->getNb();
                $stockMax = $r->getStock() + $r->getRessource()->getStock();
                $add = $r->getAdd() + $r->getRessource()->getAdd();
                $ajout = $nb + (($add / 3600) * $interval);
                if ($ajout > $stockMax)
                    $ajout = $stockMax;

                $r->setNb($ajout);
            }

            $this->twig->addGlobal('town', $town);
            $this->twig->addGlobal('ressources', $ressources);
            $this->twig->addGlobal('user', $user);
            $user->setLastActivity(new DateTime());
            $this->em->persist($user);
            $this->em->flush();
            return $ressources;
        }
      }
    }
}
