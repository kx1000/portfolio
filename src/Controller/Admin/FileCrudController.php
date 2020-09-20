<?php

namespace App\Controller\Admin;

use App\Entity\File;
use App\Field\VichFileField;
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
          VichFileField::new('file', 'name')
            ->setBasePath($this->urlHelper->getAbsoluteUrl($this->parameterBag->get('files_path')))
        ];
    }
}
