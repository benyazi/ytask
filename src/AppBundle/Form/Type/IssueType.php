<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class IssueType extends AbstractType
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('project', 'entity', array(
                'class' => 'AppBundle:Projects',
                'required' => true,
                'choice_label' => 'title',
                'label' => $this->container->get('translator')->trans('Project')
            ))
            ->add('type', 'entity', array(
                'class' => 'AppBundle:IssueTypes',
                'choice_label' => 'name',
                'label' => $this->container->get('translator')->trans('Type')
            ))
            ->add('title', 'text', array(
                'label' => $this->container->get('translator')->trans('Title'),
                'required' => true,
                'empty_data' => null
            ))
            ->add('description', 'textarea', array(
                'label' => $this->container->get('translator')->trans('Description'),
                'required' => false,
                'empty_data' => null
            ))
            ->add('status2', 'entity', array(
                'class' => 'AppBundle:IssueStatuses',
                'choice_label' => 'name',
                'label' => $this->container->get('translator')->trans('Status'),
            ))
            ->add('userAssigned', 'entity', array(
                'class' => 'UserBundle:User',
                'choice_label' => 'name',
                'label' => $this->container->get('translator')->trans('Assigned user'),
                'required' => false,
                'empty_data' => null
            ))
            /*->add('status', 'choice', array(
                'choices'  => array(
                    'NEW' => "Новая",
                    'ASSIGNED' => "Назначена",
                    'INPROGRESS' => "В процессе",
                    'COMPLETED' => "Завершена",
                    'CLOSED' => "Закрыта",
                ),
                'label' => $this->container->get('translator')->trans('Step'),
            ))*/
            ->add('dateDue', 'date', array(
                'label' => $this->container->get('translator')->trans('Due date'),
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
                'required' => false,
                'attr' => [
                    'class' => 'datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd.mm.yyyy'
                ],
            ))
            ->add('priority', 'entity', array(
                'class' => 'AppBundle:IssuePriority',
                'choice_label' => 'name',
                'label' => $this->container->get('translator')->trans('Priority')
            ))
            ->add('resolution', 'entity', array(
                'class' => 'AppBundle:IssueResolutions',
                'choice_label' => 'name',
                'label' => $this->container->get('translator')->trans('Resolution')
            ))
        ;
    }
    public function getName() {
        return "IssueType";
    }
}