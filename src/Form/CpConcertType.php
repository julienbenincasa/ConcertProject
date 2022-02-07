<?php

namespace App\Form;

use App\Entity\CpConcert;
use App\Entity\CpBand;
use App\Entity\CpBooker;
use App\Entity\CpHall;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CpConcertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'choice',
                'format' => 'dd / MM / yyyy'
            ])
            ->add('band', EntityType::class, [
                'class' => CpBand::class,
                'choice_label' => 'name'
            ])
            ->add('booker', EntityType::class, [
                'class' => CpBooker::class,
                'choice_label' => 'lastName'
            ])
            ->add('hall', EntityType::class, [
                'class' => CpHall::class,
                'choice_label' => 'name'
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CpConcert::class,
        ]);
    }
}
