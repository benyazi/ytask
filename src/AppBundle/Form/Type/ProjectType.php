<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ProjectType extends AbstractType
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => $this->container->get('translator')->trans('Key'),
                'required' => true
            ))
            ->add('title', 'text', array(
                'label' => $this->container->get('translator')->trans('Title'),
                'required' => true
            ))
            ->add('description', 'textarea', array(
                'label' => $this->container->get('translator')->trans('Description'),
                'required' => false,
                'empty_data' => null
            ))
        ;
    }
    public function getName() {
        return "ProjectType";
    }
}