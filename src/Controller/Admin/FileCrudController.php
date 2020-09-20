<?php

namespace App\Controller\Admin;

use App\Entity\File;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\UrlHelper;
use Vich\UploaderBundle\Form\Type\VichFileType;

class FileCrudController extends AbstractCrudController
{
    private $parameterBag;
    private $urlHelper;

    public function __construct(ParameterBagInterface $parameterBag, UrlHelper $urlHelper)
    {
        $this->parameterBag = $parameterBag;
        $this->urlHelper = $urlHelper;
    }

    public static function getEntityFqcn(): string
    {
        return File::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
                ->formatValue(function($value) {
                    return $this->urlHelper->getAbsoluteUrl($this->parameterBag->get('files_path') . $value);
                })
                ->hideOnForm(),
            ImageField::new('file')
                ->setFormType(VichFileType::class)
                ->setFormTypeOptions([
                    'required' => true,
                    'allow_delete' => false,
                ])
                ->hideOnIndex()
                ->hideOnDetail(),
        ];
    }
}
