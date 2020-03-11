<?php
/**
 * @author: albertosanchez
 * Nueva Clase para formulario de contacto
 */


// src/AppBundle/Form/ContactType.php
namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

// Para los objetos de formulario

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

// usamos CKEditor
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

// usamos reCaptcha
use AppBundle\Form\Type\RecaptchaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*var_dump($options['public_key']); die(' ==> eso');*/

        $builder
            ->setAttribute('submitLabel', $options['submitLabel'])
            ->setAttribute('choices', $options['choices'])
        ;

        $builder
            ->add('name', TextType::class, array('label' => 'Nombre', 'attr' => array('placeholder' => 'Tu nombre', 'class' => 'form-control'),
                'constraints' => array(
                    new NotBlank(array("message" => "Por favor, rellena tu nombre")),
                )
            ))
            ->add('subject', TextType::class, array('label' => 'Asunto','attr' => array('placeholder' => 'Especifica un asunto', 'class' => 'form-control'),
                'constraints' => array(
                    new NotBlank(array("message" => "Por favor, indica un asunto")),
                )
            ))
            ->add('email', EmailType::class, array('attr' => array('placeholder' => 'Tu dirección de email', 'class' => 'form-control'),
                'constraints' => array(
                    new NotBlank(array("message" => "Por favor, rellena tu email")),
                    new Email(array("message" => "El email introducido no parece ser válido")),
                )
            ))
            ->add('asociaciones', ChoiceType::class, ['label' => 'Asociaciones destinatarias', 'choices' => $options['choices'], 'multiple' => true, 'attr' => ['class' => 'form-control']])
            ->add('message', CKEditorType::class, array('label' => 'Mensaje', 'attr' => array('placeholder' => 'Tu mensaje', 'class' => 'form-control'),
                'constraints' => array(
                    new NotBlank(array("message" => "Por favor, rellena tu mensaje")),
                )
            ))
            ->add('recaptcha', RecaptchaType::class)
            ->add('submit', SubmitType::class, ['label' => $options['submitLabel']])
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // For Symfony 2.1 and higher:
        $view->vars['submitLabel'] = $options['submitLabel'];
        $view->vars['choices'] = $options['choices'];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true,
            'submitLabel'=>'Enviar',
            'choices'=>['ninguna'],
        ));
    }
}