<?php
// src/AppBundle/Menu/Builder.php
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $loggedUser = $this->container->get('security.token_storage')->getToken()->getUser();
        if($loggedUser!="anon.") {
            $menu->addChild($this->container->get('translator')->trans('Dashboard'), array('route' => '_dashboard'));
            $menu->addChild($this->container->get('translator')->trans('Projects'), array('route' => '_projects'));
        }
        /*$loggedUser = $this->container->get('security.token_storage')->getToken()->getUser();
        if($loggedUser!="anon.") {
            $roles = $loggedUser->getRoles();
            $rolesArr = [];
            foreach ($roles as $role) {
                $rolesArr[] = $role;
            }
            if (in_array("ROLE_OPERATOR", $rolesArr)) {
                $menu->addChild('Заявки', array('route' => '_operator'));
                $menu->addChild('Отчет', array('route' => '_director_report'));
                $menu->addChild('Звонки', array('route' => 'request_calls'));
            }
            elseif (in_array("ROLE_PERFORMER", $rolesArr)) {
                $menu->addChild('Заявки', array('route' => '_performer'));
            }
            elseif (in_array("ROLE_DIRECTOR", $rolesArr)) {
                $menu->addChild('Заявки', array('route' => '_director'));
                $menu->addChild('Отчет', array('route' => '_director_report'));
                $menu->addChild('Звонки', array('route' => 'request_calls'));
            }
            else {
                $menu->addChild('Заявки', array('route' => 'request_index'));
            }
            $menu->addChild('История', array('route' => 'history_index'));

        }*/
        /*// access services from the container!
        $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

        $menu->addChild('Latest Blog Post', array(
        'route' => 'blog_show',
        'routeParameters' => array('id' => $blog->getId())
        ));*/
        // ... add more children

        return $menu;
    }
    public function mainRightMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        /*// access services from the container!
        $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

        $menu->addChild('Latest Blog Post', array(
        'route' => 'blog_show',
        'routeParameters' => array('id' => $blog->getId())
        ));*/
        $loggedUser = $this->container->get('security.token_storage')->getToken()->getUser();
        if($loggedUser!="anon.") {
            $roles = $loggedUser->getRoles();
            $rolesArr = [];
            foreach($roles as $role) {
                $rolesArr[] = $role;
            }
            $menu->addChild($this->container->get('translator')->trans('Profile'), array());
            $menu[$this->container->get('translator')->trans('Profile')]->addChild($this->container->get('translator')->trans('Logout'), array('route' => 'fos_user_security_logout'));
        }
        else {
            $menu->addChild($this->container->get('translator')->trans('Login'), array('route' => 'fos_user_security_login'));
        }

        // create another menu item
        //$menu->addChild('Profile', array('route' => 'about'));
        // you can also add sub level's to your menu's as follows
        //$menu['Profile']->addChild('Edit profile', array('route' => 'edit_profile'));
        // ... add more children
        return $menu;
    }
}