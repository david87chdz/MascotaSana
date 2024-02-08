<?php

namespace App\Form;

use App\Entity\Mascota;
use Symfony\Component\Form\AbstractType;
//Hay que añadir las dos siguientes
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
