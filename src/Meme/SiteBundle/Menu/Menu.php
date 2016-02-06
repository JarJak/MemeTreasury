<?php

namespace Meme\SiteBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Menu
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array(
            'childrenAttributes'    => array(
                'class'             => 'nav navbar-nav',
            ),
        ));

        $menu->addChild('Przeglądaj', array('route' => 'meme_list'));
        $menu->addChild('Dodaj', array('route' => 'meme_new'));
        $menu->addChild('Losuj i taguj', array('route' => 'meme_random'));

        /*
        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

        $menu->addChild('Latest Blog Post', array(
            'route' => 'blog_show',
            'routeParameters' => array('id' => $blog->getId())
        ));

        // create another menu item
        $menu->addChild('About Me', array('route' => 'about'));
        // you can also add sub level's to your menu's as follows
        $menu['About Me']->addChild('Edit profile', array('route' => 'edit_profile'));

        // ... add more children
         * 
         */

        return $menu;
    }
}