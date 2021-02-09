<?php

namespace App\Form;
use App\Entity\Famille;
use App\Entity\Produit;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class, array(
                'label' =>'Libelle Produit'))
            
            ->add('pa', TextType::class, array(
                'label' =>'Prix Achat'))
            ->add('pv', TextType::class, array(
                'label' =>'Prix De Vente'))
            ->add('tva', TextType::class, array(
                'label' =>'Tva Produit'))
            ->add('stock', TextType::class, array(
                'label' =>'Stock'))
            ->add('stkinit', TextType::class, array(
                'label' =>'Stock Initiale'))
            ->add('id_famille', EntityType::class, 
            array('class' => Famille::class,'choice_label' =>'libelle'))
            ->add('image', FileType::class, array('data_class' => null,'required' => false))
             ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
