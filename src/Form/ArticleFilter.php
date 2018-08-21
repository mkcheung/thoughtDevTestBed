<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 8/21/18
 * Time: 10:50 AM
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleFilter extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('year', TextType::class, array(
                'required' => false
            ))
            ->add('month', TextType::class, array(
                'required' => false
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Search',
                'attr' => ['class' => 'btn btn-default pull-right'],
            ));
    }

    /**
     * @codeCoverageIgnore
     */
    public function getName()
    {
        return null;
    }

}