<?php
/**
 * @author: albertosanchez
 * Nueva Clase para administración de los programas
 */


// src/AppBundle/Form/ActivityType.php
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

// usamos CKEditor
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class ProgramaType extends AbstractType
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
            ->setAttribute('submitLabel', $options['submitLabel'])
            ->setAttribute('requireFoto', $options['requireFoto'])
            ->setAttribute('oldFoto', $options['oldFoto'])
            ->setAttribute('choices', $options['choices'])
            ->setAttribute('colectivo', $options['colectivo'])
        ;

        $builder
            ->add('name', TextType::class, ['label' => 'Nombre', 'attr' => ['class' => 'form-control']])
            ->add('description', CKEditorType::class, ['label' => 'Descripción'])
            ->add('foto', FileType::class, ['label' => 'Imagen', 'attr' => ['class' => 'form-control', 'onchange' => 'onChange(event)', 'oldFoto' => $options['oldFoto']], "data_class" => null, 'required' => $options['requireFoto']])
            ->add('fecha', DateType::class, ['widget' => 'single_text', 'html5' => false, 'attr' => ['class' => 'js-datepicker form-control']])
            ->add('url', TextType::class, ['label' => 'URL', 'attr' => ['class' => 'form-control']])
            ->add('colectivo', ChoiceType::class, ['label' => 'Colectivo', 'choices' => $options['choices'], 'multiple' => false, 'attr' => ['class' => 'form-control'], 'data' => $options['colectivo']])
            ->add('submit', SubmitType::class, ['label' => $options['submitLabel']]);
    }

    /// https://stackoverflow.com/questions/10920006/pass-custom-options-to-a-symfony2-form

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        // For Symfony 2.1 and higher:
        $view->vars['submitLabel'] = $options['submitLabel'];
        $view->vars['requireFoto'] = $options['requireFoto'];
        $view->vars['oldFoto'] = $options['oldFoto'];
        $view->vars['choices'] = $options['choices'];
        $view->vars['colectivo'] = $options['colectivo'];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            // 'required'=>['foto'=>true],   mejor no sobreescribir variables por defecto, por siaca
            'submitLabel'=>'Crear Actividad',
            'requireFoto'=>false,
            'oldFoto'=>'',
            'choices' => [],
            'colectivo' => null
        ));
    }

}