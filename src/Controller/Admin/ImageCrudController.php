<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageCrudController extends AbstractCrudController
{
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('name')
                ->setBasePath($this->parameterBag->get('images_path'))
                ->hideOnForm(),
            ImageField::new('file')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'required' => true,
                    'allow_delete' => false,
                ])
                ->hideOnIndex()
                ->hideOnDetail(),
        ];
    }
}
