<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('precio_minimo',IntegerType::class,[
                'required'   => false])
            ->add('precio_maximo',IntegerType::class,[
                'required'   => false])
            ->add('potencia_minima',IntegerType::class,[
                'required'   => false])
            ->add('potencia_maxima',IntegerType::class,[
                'required'   => false])
            ->add('km_minimo',IntegerType::class,[
                'required'   => false])
            ->add('km_maximo',IntegerType::class,[
                'required'   => false])
            ->add('plazas',IntegerType::class,[
                'required'   => false])
            ->add('puertas',IntegerType::class,[
                'required'   => false])
            ->add('cambio', ChoiceType::class, ['choices' => [
                ''=>null,
                'Manual' => 'manual',
                'Automatico' => 'automatico'
            ]])
            ->add('combustible',  ChoiceType::class, ['choices' => [
                ''=>null,
                'Electrico' => 'electrico',
                'Gasolina' => 'gasolina',
                'Diesel' => 'diesel'
            ]])
            ->add('Filtrar', SubmitType::class, ['attr' => ['class' => 'save']]);
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
