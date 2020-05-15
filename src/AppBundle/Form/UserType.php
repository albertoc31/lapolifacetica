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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

// usamos reCaptcha
use AppBundle\Form\Type\RecaptchaType;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

// usamos Data Transformer
use Symfony\Component\Form\CallbackTransformer;

class UserType extends AbstractType
{

    /* To check user roles, as seen in https://stackoverflow.com/questions/35433295/how-to-customize-form-field-based-on-user-roles-in-symfony2-3 */
    private $authorization;
    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorization = $authorizationChecker;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAttribute('choices', $options['choices'])
            ->setAttribute('submitLabel', $options['submitLabel'])
            ->setAttribute('isEdit', $options['isEdit'])
            ->setAttribute('selfEdit', $options['selfEdit'])
            ->setAttribute('roles', $options['roles'])
        ;
        $builder
            ->add('username', TextType::class, ['label' => 'Nombre de usuario', 'attr' => ['class' => 'form-control'],
                'constraints' => array(
                    new NotBlank(array("message" => "Se requiere un nombre de usuario")),
                )]);

        if ($options['isEdit']) {
            $builder
                ->add('email', EmailType::class, ['label' => 'Email', 'attr' => ['class' => 'form-control'],
                    'disabled' => true
                    ])
                ->add('active', CheckboxType::class, ['label' => 'Activo', 'required' => false, 'attr' => ['class' => 'form-control']])
            ;

            // Only SuperAdmin can change user's roles
            if($this->authorization->isGranted('ROLE_SUPER_ADMIN')) {

                $builder->add('roles', ChoiceType::class, [
                    'label' => 'Rol',
                    'choices' => $options['roles'],
                    'multiple' => false,
                    'expanded' => false,
                    'attr' => ['class' => 'form-control']
                ])
                    ->add('build_apikey', CheckboxType::class, ['label' => 'Generar Api Key', 'required' => false, 'attr' => ['class' => 'form-control'], 'mapped' => false])
                ;

                /** roles field data transformer (is a Model Transformer as seen here:
                 * https://symfony.com/doc/3.4/form/data_transformers.html
                 * Needed since 'multiple' = false
                 */

                $builder->get('roles')
                    ->addModelTransformer(new CallbackTransformer(
                        function ($rolesArray) {
                            // transform the array to a string
                            return count($rolesArray) ? $rolesArray[0] : null;
                        },
                        function ($rolesString) {
                            // transform the string back to an array
                            return [$rolesString];
                        }
                    ));
            }

        } else {
            if ($options['selfEdit']) {
                $builder
                    ->add('email', EmailType::class, ['label' => 'Email', 'attr' => ['class' => 'form-control'],
                        'disabled' => true
                    ])
                ;
            } else {
                $builder
                    ->add('email', EmailType::class, ['label' => 'Email', 'attr' => ['class' => 'form-control'],
                        'constraints' => array(
                            new NotBlank(array("message" => "Por favor, rellena tu email")),
                            new Email(array("message" => "El email introducido no parece ser válido")),
                        )]);
            }
            $builder
                ->add('plainPassword', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'first_options'  => ['label' => 'Password', 'attr' => ['class' => 'form-control']],
                    'second_options' => ['label' => 'Repite Password', 'attr' => ['class' => 'form-control']],
                ])
                ->add('asociacion', ChoiceType::class, ['label' => 'Asociacion', 'choices' => $options['choices'], 'multiple' => false, 'attr' => ['class' => 'form-control']])
                /** with mapped avoid to "match" with entity properties **/
                /** will implement constraint with custom validator: https://symfony.com/doc/3.4/validation/custom_constraint.html
                 * or with callback: https://symfony.com/doc/3.4/reference/constraints/Callback.html **/
                ->add('recaptcha', RecaptchaType::class, ['mapped' => false])
            ;
        }

        $builder
            ->add('submit', SubmitType::class, ['label' => $options['submitLabel']])
        ;
    }
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // For Symfony 2.1 and higher:
        $view->vars['choices'] = $options['choices'];
        $view->vars['submitLabel'] = $options['submitLabel'];
        $view->vars['isEdit'] = $options['isEdit'];
        $view->vars['selfEdit'] = $options['selfEdit'];
        $view->vars['roles'] = $options['roles'];

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true,
            'submitLabel'=>'Registrarse',
            'choices'=>['ninguna'],
            'isEdit'=>false,
            'selfEdit'=>false,
            'roles'=>[]
        ));
    }
}