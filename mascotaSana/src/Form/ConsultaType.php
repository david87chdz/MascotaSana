<?php

namespace App\Form;

use App\Entity\Consulta;
use App\Entity\Mascota;
use App\Entity\Tratamiento;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha')
            ->add('observaciones')
            ->add('mascota', EntityType::class, [
                'class' => Mascota::class,
'choice_label' => 'id',
            ])
            ->add('tratamiento', EntityType::class, [
                'class' => Tratamiento::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consulta::class,
        ]);
    }
}
