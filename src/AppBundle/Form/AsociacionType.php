<?php
/**
 * @author: albertosanchez
 * Nueva Clase para administración de las agrupaciones
 */


// src/AppBundle/Form/AsociacionType.php
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

// Para los objetos de formulario

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

// usamos CKEditor
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class AsociacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //var_dump($options); die();
        $builder
            ->setAttribute('submitLabel', $options['submitLabel'])
            ->setAttribute('requireFoto', $options['requireFoto'])
            ->setAttribute('oldFoto', $options['oldFoto'])
        ;

        $builder
            ->add('name', TextType::class, ['label' => 'Nombre', 'attr' => ['class' => 'form-control']])
            ->add('description', CKEditorType::class, ['label' => 'Descripción'])
            ->add('short_description', TextType::class, ['label' => 'Descripción Breve', 'attr' => ['class' => 'form-control']])
            ->add('foto', FileType::class, ['label' => 'Imagen', 'attr' => ['class' => 'form-control', 'onchange' => 'onChange(event)', 'oldFoto' => $options['oldFoto']], "data_class" => null, 'required' => $options['requireFoto']])
            ->add('email', EmailType::class, ['label' => 'Email', 'attr' => ['class' => 'form-control'],
                'constraints' => array(
                    new NotBlank(array("message" => "Por favor, rellena tu email")),
                    new Email(array("message" => "El email introducido no parece ser válido")),
                )])
            ->add('submit', SubmitType::class, ['label' => $options['submitLabel']])
        ;

    }

    /// https://stackoverflow.com/questions/10920006/pass-custom-options-to-a-symfony2-form

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        // For Symfony 2.1 and higher:
        $view->vars['oldFoto'] = $options['oldFoto'];
        $view->vars['submitLabel'] = $options['submitLabel'];
        $view->vars['requireFoto'] = $options['requireFoto'];

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            // 'required'=>['foto'=>true],   mejor no sobreescribir variables por defecto, por siaca
            'oldFoto'=>'hola',
            'submitLabel'=>'Crear Asociación',
            'requireFoto'=>true,

        ));
    }


    /// Para pasar custom options que se puedan leer desde twig del custom form type
    /// https://stackoverflow.com/questions/29408879/add-custom-options-to-symfony-form

    /*public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $params = array(
            'testOption'=>$options['testOption'],
        );

        $this->setParam( $view, $params);

    }

    private function setParam(FormView $view, array $params)
    {
        $this->updateParam($view, $params);
        $this->updateChild($view, $params);
    }

    private function updateChild(FormView $parent, array $params)
    {
        foreach ($parent->children as $child){
            $this->updateParam($child, $params);
            $this->updateChild($child, $params);
        }
    }

    private function updateParam(FormView $view, array $params)
    {
        foreach($params as $key => $value){
            $view->vars[$key] = $value;
        }
    }*/

}