<?php

namespace App\Form;

use App\Entity\Mascota;
use App\Entity\Propietario;
use App\Entity\Raza;
use App\Entity\Tipo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MascotaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('fecha')
            ->add('fecha_nac')
            ->add('raza', EntityType::class, [
                'class' => Raza::class,
'choice_label' => 'id',
            ])
            ->add('tipo', EntityType::class, [
                'class' => Tipo::class,
'choice_label' => 'id',
            ])
            ->add('propietario', EntityType::class, [
                'class' => Propietario::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mascota::class,
        ]);
    }
}
