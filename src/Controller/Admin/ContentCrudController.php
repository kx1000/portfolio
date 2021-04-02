<?php

namespace App\Controller\Admin;

use App\Entity\Content;
use App\Entity\Page;
use App\Field\TranslationField;
use App\Form\ContentType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Content::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setFormThemes([
                '@A2lixTranslationForm/bootstrap_4_layout.html.twig',
                '@EasyAdmin/crud/form_theme.html.twig',
            ]);
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
