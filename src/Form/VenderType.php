<?php

namespace App\Form;

use App\Entity\Oferta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VenderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('foto', FileType::class, array('mapped' => false))
            ->add('modelo')
            ->add('precio')
            ->add('descripcion', TextareaType::class)
            ->add('cv')
            ->add('cilindrada')
            ->add('km')
            ->add('color')
            ->add('plazas')
            ->add('puertas')
            ->add('cambio', ChoiceType::class, ['choices' => [
                'Manual' => 'manual',
                'Automatico' => 'automatico'
            ]])
            ->add('combustible',  ChoiceType::class, ['choices' => [
                'Electrico' => 'electrico',
                'Gasolina' => 'gasolina',
                'Diesel' => 'diesel'
            ]])
            ->add('Subir', SubmitType::class, ['attr' => ['class' => 'save']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Oferta::class,
        ]);
    }
}
