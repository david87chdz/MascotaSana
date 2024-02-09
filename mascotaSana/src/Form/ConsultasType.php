<?php


use App\Entity\Mascota;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Agrega el campo de búsqueda, por ejemplo, el nombre de la mascota
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre de la mascota' // Personaliza la etiqueta si es necesario
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Buscar' // Etiqueta del botón de envío
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Configura las opciones por defecto del formulario
        $resolver->setDefaults([
            // Establece la clase de datos del formulario según sea necesario
            'data_class' => null, // Puedes establecer la clase aquí si el formulario se vincula directamente a una entidad
        ]);
    }
}

