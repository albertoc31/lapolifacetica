<?php
/**
 * @author: albertosanchez
 * Nueva Clase para administración de las actividades
 */


// src/AppBundle/Form/ActivityType.php
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

// Para los objetos de formulario

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

// usamos CKEditor
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class ActivityType extends AbstractType
{
    /* To check user roles, as seen in https://stackoverflow.com/questions/35433295/how-to-customize-form-field-based-on-user-roles-in-symfony2-3 */
    private $authorization;
    public function __construct(AuthorizationChecker $authorizationChecker)
    {
        $this->authorization = $authorizationChecker;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAttribute('submitLabel', $options['submitLabel'])
            ->setAttribute('requireFoto', $options['requireFoto'])
            ->setAttribute('oldFoto', $options['oldFoto'])
            ->setAttribute('apiKey', $options['apiKey'])
        ;

        $builder
            ->add('activity_name', TextType::class, ['label' => 'Nombre', 'attr' => ['class' => 'form-control']])
            ->add('category', EntityType::class, ['label' => 'Categoría','class' => 'AppBundle:Category', 'attr' => ['class' => 'form-control']])
            ->add('description', CKEditorType::class, ['label' => 'Descripción'])
            ->add('short_description', TextType::class, ['label' => 'Descripción Breve', 'attr' => ['class' => 'form-control']])
            ->add('foto', FileType::class, ['label' => 'Imagen', 'attr' => ['class' => 'form-control', 'onchange' => 'onChange(event)', 'oldFoto' => $options['oldFoto']], "data_class" => null, 'required' => $options['requireFoto']])
            ->add('asociaciones', EntityType::class, ['class' => 'AppBundle:Asociacion', 'multiple' => true, 'attr' => ['class' => 'form-control']])
            ->add('fechaIni', DateType::class, ['widget' => 'single_text', 'html5' => false, 'attr' => ['class' => 'js-datepicker form-control']])
            ->add('fechaFin', DateType::class, ['widget' => 'single_text', 'html5' => false, 'attr' => ['class' => 'js-datepicker form-control']])
        ;

        if($this->authorization->isGranted('ROLE_SUPER_ADMIN')) {
            $builder->add('destacado', CheckboxType::class, ['label' => 'Destacar en Portada', 'required' => false]);
        }

        $builder->add('submit', SubmitType::class, ['label' => $options['submitLabel']]);
    }

    /// https://stackoverflow.com/questions/10920006/pass-custom-options-to-a-symfony2-form

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        // For Symfony 2.1 and higher:
        $view->vars['submitLabel'] = $options['submitLabel'];
        $view->vars['requireFoto'] = $options['requireFoto'];
        $view->vars['oldFoto'] = $options['oldFoto'];
        $view->vars['apiKey'] = $options['apiKey'];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            // 'required'=>['foto'=>true],   mejor no sobreescribir variables por defecto, por siaca
            'submitLabel'=>'Crear Actividad',
            'requireFoto'=>true,
            'oldFoto'=>'',
            'apiKey'=>''
        ));
    }

}