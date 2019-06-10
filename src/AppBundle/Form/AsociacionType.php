<?php
/**
 * @author: albertosanchez
 * Nueva Clase para administración de las agrupaciones
 */


// src/AppBundle/Form/AsociacionType.php
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

class AsociacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nombre', 'attr' => ['class' => 'form-control']])

            ->add('submit', SubmitType::class, ['label' => 'Crear Asociación'])
        ;
    }
}