<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, ['label'=>'Titre'])
            ->add('description', null, ['label'=>'Description'])
            ->add('surface', null, ['label'=>'Surface'])
            ->add('rooms', null, ['label'=>'Pièces'])
            ->add('bedrooms', null, ['label'=>'Chambres'])
            ->add('floor', null, ['label'=>'Etage'])
            ->add('prix', null, ['label'=>'Prix'])
            ->add('heat', ChoiceType::class, ['choices'=>$this->getChoix(), 'label'=>'Chauffage'])
            ->add('city', null, ['label'=>'Ville'])
            ->add('address', null, ['label'=>'Adresse'])
            ->add('postal_code', null, ['label'=>'Code postale'])
            ->add('sold', null, ['label'=>'Vendu'])

            ->add('pictureFiles', FileType::class, [
                'label'=> 'Images',
                    'required' => false,
                    'multiple' => true
                ])
            // ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }

    private function getChoix()
    {
        $choices = Bien::HEAT;
        $output = [];
        foreach($choices as $k=>$v){
            $output[$v]=$k;
        }
        return $output;
    }

}
