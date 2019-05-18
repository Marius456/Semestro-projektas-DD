<?php

namespace App\Form;

use App\Entity\Category;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class,  [
            'label' => 'Pavadinimas',
            'attr' => [
                'placeholder' => 'Filtruoti pagal pavadinima',
            ]])
                ->add('category', EntityType::class,
                    [
                        'label' => 'Kategorija',
                        'placeholder' => 'Pasirinkti kategorija',
                        'class' => Category::class
                    ])
                    ->add('description',TextType::class,  [
                        'label' => 'Aprašymas',
                        'attr' => [
                            'placeholder' => 'Filtruoti pagal aprašyma',
                        ]])
                //  ->add('date_from', DateTimeType::class, [
                //     "label" => 'Data nuo',
                //     'attr' => [
                //         'placeholder' => 'Filtruoti pagal data',
                //     ]])
                //  ->add('date_to', DateTimeType::class, [
                //         "label" => 'Data iki',
                //         'attr' => [
                //             'placeholder' => 'Filtruoti pagal data',
                //         ]])
                ->add('price', MoneyType::class, [
                    "label" => 'Kaina',
                    'attr' => [
                        'placeholder' => 'Filtruoti pagal kaina',
                    ]])
                ->add('location',TextType::class,  [
                    'label' => 'Vieta',
                    'attr' => [
                        'placeholder' => 'Filtruoti pagal vieta',
                    ]]);
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
