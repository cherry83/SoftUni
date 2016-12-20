<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditType extends UserType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('roles', ChoiceType::class, array(
            'choices'=>[
                'Администратор'=>'ROLE_ADMIN',
                'Потребител'=>'ROLE_USER'],
                'expanded'=>true,
                'multiple'=>true,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\User'));
    }

    public function getName()
    {
        return 'app_bundle_user_edit';
    }
}
