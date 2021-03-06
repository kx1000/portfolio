<?php

namespace App\Controller\Admin;

use App\Entity\Content;
use App\Entity\Page;
use App\Field\TranslationField;
use App\Form\ContentType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Content::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('page')
                ->setFormType(EntityType::class)
                ->setFormTypeOption('class', Page::class),
            TextField::new('name'),
            // because "The Doctrine type of the "translations" field is "4", which is not supported by EasyAdmin yet."
            TranslationField::new('translations', 'value', ContentType::getTranslationsFieldOptions())
                ->hideOnIndex(),
        ];
    }
}
