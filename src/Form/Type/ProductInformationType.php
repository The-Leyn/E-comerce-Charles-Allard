<?php 

namespace App\Form\Type;


use App\Entity\ProductImage;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProductInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('key', TextType::class, [
                'required' => true,
            ])
            ->add('value', TextType::class, [
                'required' => true,
            ]);
        
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'empty_data' => [], // Définit le tableau vide comme valeur par défaut
            'allow_add' => true, // Permet d'ajouter des éléments supplémentaires au tableau
            'allow_delete' => true, // Permet de supprimer des éléments du tableau
            'by_reference' => false, // Assure que le tableau est traité comme une nouvelle instance à chaque modification
        ]);
    }
}