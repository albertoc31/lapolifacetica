<?php
/**
 * @author: albertosanchez
 * Nueva Clase para administración de las categorias
 */


// src/AppBundle/Form/CategoryType.php
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

// Para los objetos de formulario

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

// usamos CKEditor
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAttribute('submitLabel', $options['submitLabel'])
        ;

        $builder
            ->add('name', TextType::class, ['label' => 'Nombre', 'attr' => ['class' => 'form-control']])
            ->add('description', CKEditorType::class, ['label' => 'Descripción'])
            ->add('submit', SubmitType::class, ['label' => $options['submitLabel']])
        ;
    }

    /// https://stackoverflow.com/questions/10920006/pass-custom-options-to-a-symfony2-form

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        // For Symfony 2.1 and higher:
        $view->vars['submitLabel'] = $options['submitLabel'];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            // 'required'=>['foto'=>true],   mejor no sobreescribir variables por defecto, por siaca
            'submitLabel'=>'Crear Categoria',
        ));
    }
}