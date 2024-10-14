<?php

namespace App\Form;

use App\Entity\Vol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 


class VolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('villeDestination', TextType::class, [
                'label' => 'Destination City',
            ])
            ->add('dateDeDepart', DateTimeType::class, [
                'label' => 'Departure Date',
                'widget' => 'single_text', // Render as a single input
            ])
            ->add('dateDArrivee', DateTimeType::class, [
                'label' => 'Arrival Date',
                'widget' => 'single_text', // Render as a single input
            ])
            ->add('aeroport', EntityType::class, [
                'class' => Aeroport::class,
                'choice_label' => 'nom', // Display name in dropdown
                'label' => 'Select Airport',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
