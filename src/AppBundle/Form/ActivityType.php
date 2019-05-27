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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

// usamos CKEditor
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activity_name', TextType::class, ['label' => 'Nombre', 'attr' => ['class' => 'form-control']])
            ->add('category', EntityType::class, ['class' => 'AppBundle:Category', 'attr' => ['class' => 'form-control']])
            ->add('description', CKEditorType::class, ['label' => 'Descripción'])
            ->add('short_description', TextType::class, ['label' => 'Descripción Breve', 'attr' => ['class' => 'form-control']])
            ->add('foto', FileType::class, ['label' => 'Imagen', 'attr' => ['class' => 'form-control', 'onchange' => 'onChange(event)']])
            ->add('agrupaciones', EntityType::class, ['class' => 'AppBundle:Agrupacion', 'multiple' => true, 'attr' => ['class' => 'form-control']])
            ->add('fechaIni', DateTimeType::class, ['widget' => 'single_text', 'html5' => false, 'attr' => ['class' => 'js-datepickerr form-control']])
            ->add('fechaFin', DateTimeType::class)
            ->add('destacado', CheckboxType::class, ['required' => false])
            ->add('submit', SubmitType::class, ['label' => 'Crear Evento'])
        ;
    }
}