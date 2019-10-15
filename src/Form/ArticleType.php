<?php

namespace App\Form;

use App\Entity\Article;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle',
            TextType::class, 
            $this->getConfiguration("Libelle","Tapez un super libelle pour votre article"))

            ->add('prix', 
            MoneyType::class, 
            $this->getConfiguration("Prix par article","Indiquez le prix de votre article"))

            ->add('description', 
            TextareaType::class, 
            $this->getConfiguration("Description detaille","tapez une description qui donne vraiment envie de lire votre article"))

            ->add('image',
            UrlType::class, 
            $this->getConfiguration("URL de l'image principale","Donnez l'adresse d'une image qui donne vraiment envie !"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
