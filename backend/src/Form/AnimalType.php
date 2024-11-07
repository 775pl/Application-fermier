<?php

namespace App\Form;

use App\Entity\Animal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Nom de l'animal
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'animal',
                'required' => true,
            ])
            // Âge de l'animal
            ->add('age', IntegerType::class, [
                'label' => 'Âge',
                'required' => true,
            ])
            // Type de l'animal (chien, cheval, brebis, cochon, etc.)
            ->add('type', ChoiceType::class, [
                'label' => 'Type',
                'choices' => [
                    'Chien' => 'chien',
                    'Cheval' => 'cheval',
                    'Brebis' => 'brebis',
                    'Cochon' => 'cochon',
                ],
                'required' => true,
            ])
            // Race de l'animal
            ->add('breed', ChoiceType::class, [
                'label' => 'Race',
                'choices' => [
                    'Labrador' => 'labrador',
                    'Frison' => 'frison',
                    'Pottok' => 'pottok',
                    'Irish Cob' => 'irish_cob',
                    'Mérinos' => 'merinos',
                    'Solognotes' => 'solognotes',
                ],
                'required' => true,
            ])
            // Description de l'animal
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
            ])
            // Prix de l'animal (HT)
            ->add('priceHT', NumberType::class, [
                'label' => 'Prix de vente HT',
                'required' => true,
            ])
            // Statut (en vente, vendu)
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'En vente' => 'en_vente',
                    'Vendu' => 'vendu',
                ],
                'required' => true,
            ])
            // Photos de l'animal
            ->add('photos', FileType::class, [
                'label' => 'Photos',
                'mapped' => false, // La photo n'est pas mappée à une entité directement
                'required' => false,
                'multiple' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPEG, PNG)',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
?>