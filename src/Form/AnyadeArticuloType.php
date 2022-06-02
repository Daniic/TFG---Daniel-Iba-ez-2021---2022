<?php

namespace App\Form;

use App\Entity\Articulo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnyadeArticuloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('archivo', FileType::class, array('mapped'=>false))
        ->add('titulo')
        ->add('subtitulo')
        ->add('descripcion', TextareaType::class)
        ->add('tipo', ChoiceType::class,['choices' => [
            'F1' => 'f1',
            'Noticias' => 'noticia'
        ]])
        ->add('crear_articulo', SubmitType::class, ['attr'=>['class'=>'save']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articulo::class,
        ]);
    }
}
