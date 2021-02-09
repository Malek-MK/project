<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation', TextType::class, array(
                'attr' =>array('class' =>'form-control'),
            ))
            ->add('RespComm', TextType::class, array(
                'label' =>'Responsable Commerciale'))
            
            ->add('respFinan', TextType::class, array(
                'label' =>'Responsable Financier'))
            ->add('adrLiv', TextType::class, array(
                'label' =>'Adresse Livraison'))
            ->add('adrFacture', TextType::class, array(
                'label' =>'Adresse Facture'))
            ->add('tel')
            ->add('portable')
            ->add('fax')
            ->add('email')
            ->add('soldeInit')
            ->add('solde')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
