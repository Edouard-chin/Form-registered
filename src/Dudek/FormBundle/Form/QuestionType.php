<?php

namespace Dudek\FormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Dudek\FormBundle\Entity\Question;

class QuestionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', [
                'choices' => [
                    Question::TYPE_DATE => 'Date',
                    Question::TYPE_DATETIME => 'Date et heure',
                    Question::TYPE_STRING => 'Texte court',
                    Question::TYPE_TEXT => 'Texte long',
                    Question::TYPE_CHOICE => 'Choix unique',
                    Question::TYPE_MULTI_CHOICES => 'Choix multiples',
                    Question::TYPE_NUMBER => 'Nombre',
                ]
            ])
            ->add('name')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dudek\FormBundle\Entity\Question'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dudek_formbundle_question';
    }
}
