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

class ConsultasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('searchTerm', TextType::class, [
            'label' => 'Buscar:'
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Buscar'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mascota::class,
        ]);
    }
}
