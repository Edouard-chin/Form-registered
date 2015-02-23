<?php

namespace Dudek\FormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnswerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $questions = $options['form']->getSteps()->first()->getQuestions();
        $options = ['mapped' => false];
        foreach ($questions as $question) {
            $options['label'] = $question->getName();
            $builder
                ->add('question-'.$question->getId(), $question->getType(), $options)
            ;
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dudek\FormBundle\Entity\Answer'
        ));
        $resolver->setRequired(array(
            'form',
        ));
        $resolver->setAllowedTypes(array(
            'form' => 'Dudek\FormBundle\Entity\Form'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dudek_formbundle_answer';
    }
}
