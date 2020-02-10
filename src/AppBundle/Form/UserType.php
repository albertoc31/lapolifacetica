<?php
/**
 * @author: albertosanchez
 * Nueva Clase para administración de los usuarios
 */


// src/AppBundle/Form/UserType.php
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

// Para los objetos de formulario

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

// usamos CKEditor
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAttribute('choices', $options['choices'])
        ;
        $builder
            ->add('email', EmailType::class, ['label' => 'Email', 'attr' => ['class' => 'form-control'],
                'constraints' => array(
                    new NotBlank(array("message" => "Por favor, rellena tu email")),
                    new Email(array("message" => "El email introducido no parece ser válido")),
                )])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Password', 'attr' => ['class' => 'form-control']],
                'second_options' => ['label' => 'Repite Password', 'attr' => ['class' => 'form-control']],
            ])
            ->add('asociacion', ChoiceType::class, ['label' => 'Asociacion', 'choices' => $options['choices'], 'multiple' => false, 'attr' => ['class' => 'form-control']])
            ->add('register', SubmitType::class, ['label' => 'Registrarse'])
        ;
    }
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // For Symfony 2.1 and higher:
        $view->vars['choices'] = $options['choices'];

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true,
            'submitLabel'=>'Enviar',
            'choices'=>['ninguna']
        ));
    }
}