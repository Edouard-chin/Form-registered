<?php

namespace Dudek\FormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Dudek\FormBundle\Form\QuestionType;

class StepType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rank')
            ->add('name')
            ->add('questions', 'collection', [
                'type' => new QuestionType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('previous', 'submit')
            ->add('finish', 'submit')
            ->add('next', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dudek\FormBundle\Entity\Step'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dudek_formbundle_step';
    }
}
