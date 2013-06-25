<?php

namespace Lepermessiah\TwitterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('post')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lepermessiah\TwitterBundle\Entity\Posts'
        ));
    }

    public function getName()
    {
        return 'lepermessiah_twitterbundle_poststype';
    }
}
