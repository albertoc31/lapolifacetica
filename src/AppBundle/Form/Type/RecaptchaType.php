<?php
/**
 * @author: albertosanchez
 * Nuevo Custom Type para usar reCaptcha
 */

// src/AppBundle/Form/Type/RecaptchaType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class RecaptchaType extends AbstractType
{

    /**
     * The public key.
     * @var string
     */
    protected $publicKey;

    public function __construct($args)
    {
        $this->publicKey = $args['public_key'];
        /*var_dump($args); die(' ==> eso');*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'public_key' => null,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAttribute('public_key', $this->publicKey);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, array(
            'public_key' => $this->publicKey,
        ));
        if (!isset($options['public_key'])) {
            $options['public_key'] = $this->publicKey;
        }
        /*var_dump($options); die(' ==> eso');*/
    }

    /**
     * Gets the public key.
     * @return string The PublicKeyL

    public function getPublicKey()
    {
        return $this->publicKey;
    }*/
}